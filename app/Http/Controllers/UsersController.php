<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Predis\Client;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'create',
            'login'
        ]]);
    }

    public function showAllUsers()
    {
        return response()->json(User::all());
    }

    public function showOneUser()
    {
        return response()->json(User::find(Auth::id()));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $data = $request->only('username', 'password');

        if (($user = User::where('username', '=', $data['username'])->first()) != []) {
            if (password_verify($data['password'], User::where('username', '=', $data['username'])->value('password'))) {
                $user['auth-token'] = Str::random(60);
                $redis = new Client();
                $redis->setex($user['auth-token'], 60 * 60 * 2, $user['pk_user_id']);

                return response()->json($user);
            } else {
                return response()->json(['Incorrect password' => 406], 406);
            }
        }

        return response()->json(['User not found' => 404], 404);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'username' => 'required'
        ]);

        $data = $request->only('username');

        $redis = new Client();

        if ($request->get('username') === User::where('pk_user_id', $redis->get($request->header('Authorization')))->value('username')) {
            $redis->del($request->header('Authorization'));

            return response()->json([200 => 'Logout successful'], 200);
        }

        return response()->json([406 => 'User information incorrect'], 406);
    }

    public function create(Request $request)
    {
        if ($request->header('Accept-Create') == 'Allowed') {

            $this->validate($request, [
                'username' => 'required|unique:users|max:20',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            $input = $request->all();

            $input['password'] = password_hash($input['password'], PASSWORD_ARGON2I);

            $user = User::create($input);
            return response()->json($user, 201);
        }

        return response()->json(['Not acceptable' => 406], 406);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $this->validate($request, [
            'username' => 'unique:users|max:20',
            'email' => 'email',
            'password' => 'min:6'
        ]);

        if (isset($request['password'])) {
            if (password_verify($request['old_password'], User::where('pk_user_id', '=', Auth::id())->value('password'))) {
                $request['password'] = password_hash($request['password'], PASSWORD_ARGON2I);
                $user->update($request->all());
                return response()->json($user, 200);
            } else {
                return response()->json(['Old password not set or false' => 406], 406);
            }
        } else {
            $user->update($request->all());
            return response()->json($user, 200);
        }
    }

    public function delete()
    {
        User::findOrFail(Auth::id())->delete();

        return response('Deleted Successfully', 200);
    }
}

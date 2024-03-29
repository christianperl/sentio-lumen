<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\User;
use App\Models\UserHousehold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class HouseholdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'household_name' => 'required|max:50'
        ]);

        $household = Household::create($request->only('household_name'));

        $user_household = UserHousehold::create([
            'fk_pk_user_id' => Auth::id(),
            'fk_pk_household_id' => $household->pk_household_id,
            'isAdmin' => true
        ]);

        return response()->json($household, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'household_name' => 'required|max:50',
            'household_id' => 'required'
        ]);

        if ($household = Household::find($request->only('household_id'))->first()) {
            $household->update($request->only('household_name'));

            return response()->json($household, 200);
        } else {
            return response()->json(['Household not found' => 404], 404);
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'household_id' => 'required'
        ]);

        if ($household = Household::find($request->only('household_id'))->first()) {
            if (UserHousehold::where([['fk_pk_user_id', Auth::id()], ['fk_pk_household_id', $request->only('household_id')]])->value('isAdmin')) {
                $household->delete();

                return response(['Deleted Successfully' => 200], 200);
            } else {
                return response()->json(['Not authorized' => 401], 401);
            }
        } else {
            return response()->json(['Household not found' => 404], 404);
        }

    }

    public function getAllHouseholds()
    {
        return response()->json(Household::all());
    }

    public function getOneHousehold($id)
    {
        return response()->json(Household::find($id));
    }

    public function getAllHouseholdsFromCurrentUser()
    {
        $households = DB::table('households')
            ->join('user_households', 'households.pk_household_id', '=', 'user_households.fk_pk_household_id')
            ->where('user_households.fk_pk_user_id', '=', Auth::id())
            ->select('households.household_name', 'households.pk_household_id')
            ->get();

        return response()->json($households);
    }

    public function getAllHouseholdsFromUser($id)
    {
        $households = DB::table('households')
            ->join('user_households', 'households.pk_household_id', '=', 'user_households.fk_pk_household_id')
            ->where('user_households.fk_pk_user_id', '=', $id)
            ->select('households.household_name', 'households.pk_household_id')
            ->get();

        return response()->json($households);
    }

    public function getAllUsersFromHousehold($id)
    {
        $users = DB::table('users')
            ->join('user_households', 'users.pk_user_id', '=', 'user_households.fk_pk_user_id')
            ->where('user_households.fk_pk_household_id', '=', $id)
            ->select('users.username', 'user_households.isAdmin')
            ->get();

        return response()->json($users);
    }

    public function getAdminsFromHousehold($id)
    {
        $admins = DB::table('users')
            ->join('user_households', 'users.pk_user_id', '=', 'user_households.fk_pk_user_id')
            ->where('user_households.fk_pk_household_id', '=', $id)
            ->where('user_households.isAdmin', '=', true)
            ->select('users.username')
            ->get();

        return response()->json($admins);
    }

    public function addAdminToHousehold(Request $request)
    {
        $this->validate($request, [
            'household_id' => 'required|integer',
            'username' => 'required'
        ]);

        if ($id_of_username = User::whereUsername($request->only('username'))->value('pk_user_id')) {
            if (UserHousehold::where([['fk_pk_user_id', Auth::id()], ['fk_pk_household_id', $request->only('household_id')]])->value('isAdmin')) {
                $user_household = UserHousehold::where([
                    ['fk_pk_household_id', $request->only('household_id')],
                    ['fk_pk_user_id', $id_of_username]
                ])->first();

                if (!$user_household['isAdmin']) {
                    $user_household->update(['isAdmin' => true]);

                    return response()->json(['Admin successfully added.' => 200], 200);
                } else {
                    return response()->json(['User already admin.' => 202], 202);
                }
            } else {
                return response()->json(['Not authorized' => 401], 401);
            }
        } else {
            return response()->json(['Given user not found' => 404], 404);
        }
    }

    public function removeAdminFromHousehold(Request $request)
    {
        $this->validate($request, [
            'household_id' => 'required|integer',
            'username' => 'required'
        ]);

        if ($id_of_username = User::whereUsername($request->only('username'))->value('pk_user_id')) {
            if (UserHousehold::where([['fk_pk_user_id', Auth::id()], ['fk_pk_household_id', $request->only('household_id')]])->value('isAdmin')) {
                $user_household = UserHousehold::where([
                    ['fk_pk_household_id', $request['household_id']],
                    ['fk_pk_user_id', $id_of_username]
                ])->first();

                if ($user_household['isAdmin']) {
                    $user_household->update(['isAdmin' => false]);

                    return response()->json(['Admin successfully removed.' => 200], 200);
                } else {
                    return response()->json(['Given user is not an admin.' => 202], 202);
                }
            } else {
                return response()->json(['Not authorized' => 401], 401);
            }
        } else {
            return response()->json(['Given user not found' => 404], 404);
        }
    }

    public function addUserToHousehold(Request $request)
    {
        $this->validate($request, [
            'household_id' => 'required|integer',
            'username' => 'required',
            'asAdmin' => 'bool'
        ]);

        if ($id_of_username = User::whereUsername($request->only('username'))->value('pk_user_id')) {
            if (UserHousehold::where([['fk_pk_user_id', Auth::id()], ['fk_pk_household_id', $request->only('household_id')]])->value('isAdmin')) {
                $user_household = UserHousehold::where([
                    ['fk_pk_household_id', $request['household_id']],
                    ['fk_pk_user_id', $id_of_username]
                ])->first();

                if (!isset($user_household)) {
                    UserHousehold::create([
                        'fk_pk_user_id' => $id_of_username,
                        'fk_pk_household_id' => $request['household_id'],
                        'isAdmin' => isset($request['asAdmin']) ? $request['asAdmin'] : false
                    ]);

                    return response()->json(['User successfully added.' => 200], 200);
                } else {
                    return response()->json(['User already in the household.' => 202], 202);
                }
            } else {
                return response()->json(['Not authorized' => 401], 401);
            }
        } else {
            return response()->json(['Given user not found' => 404], 404);
        }
    }

    public function removeUserFromHousehold(Request $request)
    {
        $this->validate($request, [
            'household_id' => 'required|integer',
            'username' => 'required'
        ]);

        if ($id_of_username = User::whereUsername($request->only('username'))->value('pk_user_id')) {
            if (UserHousehold::where([['fk_pk_user_id', Auth::id()], ['fk_pk_household_id', $request->only('household_id')]])->value('isAdmin')) {
                $user_household = UserHousehold::where([
                    ['fk_pk_household_id', $request['household_id']],
                    ['fk_pk_user_id', $id_of_username]
                ])->first();

                if (isset($user_household)) {
                    $user_household->delete();

                    return response()->json(['User successfully removed.' => 200], 200);
                } else {
                    return response()->json(['User not in the household.' => 202], 202);
                }
            } else {
                return response()->json(['Not authorized' => 401], 401);
            }
        } else {
            return response()->json(['Given user not found' => 404], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'ingredient_name' => 'required|unique:ingredients|max:50'
        ]);

        $ingredient = Ingredient::create($request->only('ingredient_name'));

        return response()->json($ingredient, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'ingredient_id' => 'required|integer',
            'ingredient_name' => 'required|unique:ingredients|max:50'
        ]);

        if ($ingredient = Ingredient::find($request->only('ingredient_id'))->first()) {
            $ingredient->update($request->only('ingredient_name'));

            return response()->json($ingredient, 200);
        } else {
            return response()->json(['Ingredient not found' => 404], 404);
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'ingredient_id' => 'required|integer'
        ]);

        if ($ingredient = Ingredient::find($request->only('ingredient_id'))->first()) {
            $ingredient->delete();

            return response(['Deleted Successfully' => 200], 200);
        } else {
            return response()->json(['Ingredient not found' => 404], 404);
        }
    }

    public function getAllIngredients()
    {
        return response()->json(Ingredient::all());
    }

    public function getOneIngredient($id)
    {
        return response()->json(Ingredient::find($id));
    }
}

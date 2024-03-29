<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'recipe_name' => 'required|unique:stores|max:50',
            'recipe_description' => 'required',
            'recipe_instructions' => 'required'
        ]);

        $recipe = Recipe::create($request->all());

        return response()->json($recipe, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'recipe_id' => 'required|integer',
            'recipe_name' => 'unique:stores|max:50',
            'recipe_description' => 'string',
            'recipe_instructions' => 'string'
        ]);

        if ($recipe = Recipe::find($request->only('recipe_id'))->first()) {
            $recipe->update($request->all());

            return response()->json($recipe, 200);
        } else {
            return response()->json(['Recipe not found' => 404], 404);
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'recipe_id' => 'required|integer'
        ]);

        if ($recipe = Recipe::find($request->only('recipe_id'))->first()) {
            $recipe->delete();

            return response(['Deleted Successfully' => 200], 200);
        } else {
            return response()->json(['Recipe not found' => 404], 404);
        }
    }

    public function getAllRecipes()
    {
        return response()->json(Recipe::all());
    }

    public function getOneRecipe($id)
    {
        return response()->json(Recipe::find($id));
    }
}

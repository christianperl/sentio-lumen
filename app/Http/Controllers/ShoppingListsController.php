<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;

class ShoppingListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function getAllShoppingLists()
    {
        return response()->json(ShoppingList::all());
    }

    public function getOneShoppingList($id)
    {
        return response()->json(ShoppingList::find($id));
    }
}

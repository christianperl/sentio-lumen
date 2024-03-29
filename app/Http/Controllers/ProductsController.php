<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products|max:50',
            'product_company' => 'required',
            'ingredient_name' => 'nullable'
        ]);

        if (isset($request['ingredient_name'])) {
            $ingredient = Ingredient::whereIngredientName($request->only('ingredient_name'))->value('pk_ingredient_id');
            $product = Product::create([
                'product_name' => $request['product_name'],
                'product_company' => $request['product_company'],
                'fk_ingredient_id' => $ingredient,
            ]);
        } else {
            $product = Product::create($request->all());
        }

        return response()->json($product, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|integer',
            'product_name' => 'unique:products|max:50',
            'product_company' => 'string',
            'ingredient_id' => 'integer|nullable'
        ]);

        if ($product = Product::find($request->only('product_id'))->first()) {
            if (isset($request['ingredient_id'])) {
                $request['fk_ingredient_id'] = $request['ingredient_id'];
                unset($request['ingredient_id']);
            }

            $product->update($request->all());

            return response()->json($product, 200);
        } else {
            return response()->json(['Product not found' => 404], 404);
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|integer'
        ]);

        if ($product = Product::find($request->only('product_id'))->first()) {
            $product->delete();

            return response(['Deleted Successfully' => 200], 200);
        } else {
            return response()->json(['Product not found' => 404], 404);
        }
    }

    public function getAllProducts()
    {
        return response()->json(Product::all());
    }

    public function getOneProduct($id)
    {
        return response()->json(Product::find($id));
    }
}

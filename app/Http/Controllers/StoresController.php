<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'store_name' => 'required|unique:stores|max:50'
        ]);

        $store = Store::create($request->only('store_name'));

        return response()->json($store, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'store_id' => 'required|integer',
            'store_name' => 'required|unique:stores|max:50'
        ]);

        if ($store = Store::find($request->only('store_id'))->first()) {
            $store->update($request->only('store_name'));

            return response()->json($store, 200);
        } else {
            return response()->json(['Store not found' => 404], 404);
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'store_id' => 'required|integer'
        ]);

        if ($store = Store::find($request->only('store_id'))->first()) {
            $store->delete();

            return response(['Deleted Successfully' => 200], 200);
        } else {
            return response()->json(['Store not found' => 404], 404);
        }
    }

    public function getAllStores()
    {
        return response()->json(Store::all());
    }

    public function getOneStore($id)
    {
        return response()->json(Store::find($id));
    }

    public function getAllProductsFromStore($id)
    {
        $products = DB::table('products')
            ->join('product_stores', 'products.pk_product_id', '=', 'product_stores.fk_pk_product_id')
            ->where('product_stores.fk_pk_store_id', '=', $id)
            ->select('products.name', 'products.product_company', 'product_stores.product_price')
            ->get();

        return response()->json($products);
    }
}

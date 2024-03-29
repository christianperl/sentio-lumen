<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_product_id', 'fk_ingredient_id', 'product_name', 'product_company'
    ];

    protected $primaryKey = 'pk_product_id';

    public function ingrendient()
    {
        $this->belongsTo('App\Models\Ingredient');
    }

    public function product_store()
    {
        $this->hasMany('App\Models\ProductStore');
    }

    public function shoppingList_product()
    {
        $this->hasMany('App\Models\ShoppingListProduct');
    }
}

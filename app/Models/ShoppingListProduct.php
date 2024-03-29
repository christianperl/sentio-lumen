<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingListProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_pk_shoppingList_id', 'fk_pk_product_id', 'amount'
    ];

    protected $primaryKey = 'fk_pk_shoppingList_id';

    public function shoppingList()
    {
        $this->belongsTo('App\Models\ShoppingList');
    }

    public function product()
    {
        $this->belongsTo('App\Models\Product');
    }
}

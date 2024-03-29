<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_shoppingList_id', 'fk_household_id', 'shoppingList_name', 'completed'
    ];

    protected $primaryKey = 'pk_shoppingList_id';

    public function household()
    {
        $this->belongsTo('App\Models\Household');
    }

    public function shoppingList_product()
    {
        $this->hasMany('App\Models\ShoppingListProduct');
    }
}

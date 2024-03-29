<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_household_id', 'household_name'
    ];

    protected $primaryKey = 'pk_household_id';

    public function user_household()
    {
        $this->hasMany('App\Models\UserHousehold');
    }

    public function shoppingList()
    {
        $this->hasMany('App\Models\ShoppingList');
    }

    public function household_recipe()
    {
        $this->hasMany('App\Models\HouseholdRecipe');
    }
}

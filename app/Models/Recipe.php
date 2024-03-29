<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_recipe_id', 'recipe_name', 'recipe_description', 'recipe_instructions'
    ];

    protected $primaryKey = 'pk_recipe_id';

    public function recipe_ingredient()
    {
        $this->hasMany('App\Models\RecipeIngredient');
    }

    public function household_recipe()
    {
        $this->hasMany('App\Models\HouseholdRecipe');
    }
}

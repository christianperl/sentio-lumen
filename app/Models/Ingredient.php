<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_ingredient_id', 'ingredient_name',
    ];

    protected $primaryKey = 'pk_ingredient_id';

    public function recipe_ingredient()
    {
        $this->hasMany('App\Models\RecipeIngredient');
    }

    public function product()
    {
        $this->hasMany('App\Models\Product');
    }
}

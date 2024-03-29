<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_pk_recipe_id', 'fk_pk_ingredient_id', 'amount'
    ];

    protected $primaryKey = 'fk_pk_recipe_id';

    public function recipe()
    {
        $this->belongsTo('App\Models\Recipe');
    }

    public function ingredient()
    {
        $this->belongsTo('App\Models\Ingredient');
    }
}

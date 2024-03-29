<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseholdRecipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_pk_household_id', 'fk_pk_recipe_id',
    ];

    protected $primaryKey = 'fk_pk_household_id';

    public function household()
    {
        $this->belongsTo('App\Models\Household');
    }

    public function recipe()
    {
        $this->belongsTo('App\Models\Recipe');
    }
}

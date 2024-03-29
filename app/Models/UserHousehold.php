<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHousehold extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_pk_user_id', 'fk_pk_household_id', 'isAdmin'
    ];

    protected $primaryKey = 'fk_pk_user_id';

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }

    public function household()
    {
        $this->belongsTo('App\Models\Household');
    }
}

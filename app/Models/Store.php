<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pk_store_id', 'store_name',
    ];

    protected $primaryKey = 'pk_store_id';

    public function product_store()
    {
        $this->hasMany('App\Models\ProductStore');
    }
}

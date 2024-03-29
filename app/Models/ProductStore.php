<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_pk_product_id', 'fk_pk_store_id', 'product_price'
    ];

    protected $primaryKey = 'fk_pk_product_id';

    public function product()
    {
        $this->belongsTo('App\Models\Product');
    }

    public function store()
    {
        $this->belongsTo('App\Models\Store');
    }
}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'total_product_value',
        'total_shipping_value',
        'client_name',
        'client_address',
    ];

    public $timestamps = false;

    /**
     * Checkout for product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

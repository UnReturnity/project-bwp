<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Link to the Product so we can show its name/price in the cart
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

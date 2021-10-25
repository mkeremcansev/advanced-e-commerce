<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    use HasFactory;
    protected $table = 'variant_values';
    function getVariantMain()
    {
        return $this->hasOne(Variant::class, 'id', 'variant_id');
    }
    function getVariantProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

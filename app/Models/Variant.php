<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $table = 'variants';
    function getVariantValue()
    {
        return $this->hasMany(VariantValue::class, 'variant_id', 'id'); // variantın ürün id si ürünün id sine eşitse gönder
    }
}

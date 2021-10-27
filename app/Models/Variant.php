<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    function getVariantValue()
    {
        return $this->hasMany(VariantValue::class, 'variant_id', 'id');
    }
}

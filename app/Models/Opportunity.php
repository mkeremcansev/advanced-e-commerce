<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;
    function getOpportunityProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

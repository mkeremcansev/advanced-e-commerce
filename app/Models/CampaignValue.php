<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignValue extends Model
{
    use HasFactory;
    function getCampaignValueProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

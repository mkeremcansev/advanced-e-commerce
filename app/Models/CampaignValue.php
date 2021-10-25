<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignValue extends Model
{
    use HasFactory;
    protected $table = 'campaign_values';
    function getCampaignMain()
    {
        return $this->hasOne(Campaign::class, 'id', 'variant_id');
    }
    function getCampaignProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    function getCampaignValueProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

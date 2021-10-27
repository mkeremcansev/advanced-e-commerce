<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    function getCampaignValue()
    {
        return $this->hasMany(CampaignValue::class, 'campaign_id', 'id');
    }
}

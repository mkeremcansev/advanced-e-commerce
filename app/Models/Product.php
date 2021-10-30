<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'discount',
        'category_id',
        'brand_id',
    ];
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
    public function getBuyableDescription($options = null)
    {
        return $this->title;
    }
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }
    function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    function getInformation()
    {
        return $this->hasMany(ProductInformation::class, 'product_id', 'id')->orderBy('id', 'asc');
    }
    function getBrand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
    function getVariant()
    {
        return $this->hasMany(Variant::class, 'product_id', 'id');
    }
    function getProductVariantValue()
    {
        return $this->hasMany(VariantValue::class, 'product_id', 'id');
    }

    function getProductReviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id')->where('status', 1);
    }
}

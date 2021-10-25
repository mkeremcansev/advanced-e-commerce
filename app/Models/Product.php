<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class Product extends Model implements Buyable
{
    use HasFactory;
    protected $table = 'products';
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
        return $this->hasMany(Variant::class, 'product_id', 'id'); // variantın ürün id si ürünün id sine eşitse gönder
    }
    function getProductVariantValue()
    {
        return $this->hasMany(VariantValue::class, 'product_id', 'id'); // variantın ürün id si ürünün id sine eşitse gönder
    }
}

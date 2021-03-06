<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;
    protected $appends = [
        'getParentsTree',
    ];
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('id', 'ASC');
    }
    public static function getParentsTree($category, $title)
    {
        if ($category->parent_id == 0) {
            return $title;
        }
        $parent = Category::findOrFail($category->parent_id);
        $title = $parent->title . ' > ' . $title;

        return Category::getParentsTree($parent, $title);
    }

    function getCategoryProductIndex()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}

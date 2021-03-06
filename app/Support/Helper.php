<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class Helper
{
    public static function imageUpload($file, String $path, $model)
    {
        $name = Str::random(15) . '.' . $file->extension();
        $file->move(public_path($path), $name);
        $model = $path . '/' .  $name;
        return $model;
    }

    public static function desktop()
    {
        Cache::forget('dCategories');
        $categories = Category::where('parent_id', 0)->with('subCategories')->orderBy('id', 'ASC')->get();
        $data = '';
        foreach ($categories as $category) {
            $data .= '<li>';
            if (count($category->subCategories)) {
                $data .= '<ul class="dropdown-c"><li>';
                $data .= '<a class="cwCategoryFontSize85" href="' . route('Web.category.products', $category->slug) . '">' . $category->title . '</a>';
                $data .= '<ul>';
                $data .= self::desktopSubCategory($category);
                $data .= '</ul>';
                $data .= '<li>';
                $data .= '</ul>';
            } else {
                $data .= '<ul class="dropdown-c">';
                $data .= '<li>';
                $data .= '<a class="cwCategoryFontSize85" href="' . route('Web.category.products', $category->slug) . '">' . $category->title . '</a>';
                $data .= '</li>';
                $data .= '</ul>';
            }
            $data .= '</li>';
        }
        Cache::put('dCategories', $data);
    }

    public static function desktopSubCategory(Category $category)
    {
        $data = '';
        foreach ($category->subCategories as $subCategory) {
            if (count($subCategory->subCategories)) {
                $data .= '<li>';
                $data .= '<a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '<i class="fi-rs-angle-right"></i></a>';
                $data .= '<ul class="level-menu level-menu-modify">';
                $data .= self::desktopSubCategory($subCategory);
                $data .= '</ul>';
                $data .= '</li>';
            } else {
                $data .= '<li><a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '</a></li>';
            }
        }
        return $data;
    }

    public static function mobile()
    {
        Cache::forget('mCategories');
        $categories = Category::where('parent_id', 0)->with('subCategories')->orderBy('id', 'ASC')->get();
        $data = '';
        foreach ($categories as $category) {
            if (count($category->subCategories)) {
                $data .= '<li class="menu-item-has-children"><span class="menu-expand"></span>';
                $data .= '<a href="' . route('Web.category.products', $category->slug) . '">' . $category->title . '</a>';
                $data .= '<ul class="dropdown">';
                $data .= self::mobileSubCategory($category);
                $data .= '</ul>';
                $data .= '</li>';
            } else {
                $data .= '<li class="menu-item-has-children"><span class="menu-expand"></span>';
                $data .= '<a href="' . route('Web.category.products', $category->slug) . '">' . $category->title . '</a>';
                $data .= '</li>';
            }
        }
        Cache::put('mCategories', $data);
    }

    public static function mobileSubCategory(Category $category)
    {
        $data = '';
        foreach ($category->subCategories as $subCategory) {
            if (count($subCategory->subCategories)) {
                $data .= '<li class="menu-item-has-children"><span class="menu-expand"></span>';
                $data .= '<a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '</a>';
                $data .= '<ul class="dropdown">';
                $data .= self::mobileSubCategory($subCategory);
                $data .= '</ul>';
                $data .= '</li>';
            } else {
                $data .= '<li><a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '</a></li>';
            }
        }
        return $data;
    }
}

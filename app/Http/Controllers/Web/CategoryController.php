<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function desktop()
    {

        $categories = Category::where('parent_id', 0)->with('subCategories')->orderBy('id', 'ASC')->get();

        $data = '';
        foreach ($categories as $category) {
            $data .= '<li>';
            if (count($category->subCategories)) {
                $data .= '<ul class="dropdown-c"><li>';
                $data .= '<a class="cwCategoryFontSize85" href="' . route('Web.category.products', $category->slug) . '">' . $category->title . '</a>';
                $data .= '<ul>';
                $data .= $this->desktopSubCategory($category);
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

    public function desktopSubCategory(Category $category)
    {
        $data = '';
        foreach ($category->subCategories as $subCategory) {
            if (count($subCategory->subCategories)) {
                $data .= '<li>';
                $data .= '<a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '<i class="fi-rs-angle-right"></i></a>';
                $data .= '<ul class="level-menu level-menu-modify">';
                $data .= $this->desktopSubCategory($subCategory);
                $data .= '</ul>';
                $data .= '</li>';
            } else {
                $data .= '<li><a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '</a></li>';
            }
        }
        return $data;
    }

    public function mobile()
    {
        $categories = Category::where('parent_id', 0)->with('subCategories')->orderBy('id', 'ASC')->get();
        $data = '';
        foreach ($categories as $category) {
            if (count($category->subCategories)) {
                $data .= '<li class="menu-item-has-children"><span class="menu-expand"></span>';
                $data .= '<a href="' . route('Web.category.products', $category->slug) . '">' . $category->title . '</a>';
                $data .= '<ul class="dropdown">';
                $data .= $this->mobileSubCategory($category);
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

    public function mobileSubCategory(Category $category)
    {
        $data = '';
        foreach ($category->subCategories as $subCategory) {
            if (count($subCategory->subCategories)) {
                $data .= '<li class="menu-item-has-children"><span class="menu-expand"></span>';
                $data .= '<a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '</a>';
                $data .= '<ul class="dropdown">';
                $data .= $this->mobileSubCategory($subCategory);
                $data .= '</ul>';
                $data .= '</li>';
            } else {
                $data .= '<li><a href="' . route('Web.category.products', $subCategory->slug) . '">' . $subCategory->title . '</a></li>';
            }
        }
        return $data;
    }
}

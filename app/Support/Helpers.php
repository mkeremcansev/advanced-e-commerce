<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

function blockCategory($id, $subid)
{
    $data = "";
    if ($subid) {
        if ($id == $subid) {
            $data = "disabled";
        }
    }
    return $data;
}

function thisOneItem($return)
{
    $return = mb_strtoupper(Str::random(3), "UTF-8") . "-" . mb_strtoupper(Str::random(3), "UTF-8") . "-" . rand(100, 999);
    return $return;
}

function firstImage($array)
{
    $image = explode(",", $array);
    $image = $image[0];
    return $image;
}
function twoImage($array)
{
    $image = explode(",", $array);
    $image = $image[1];
    return $image;
}

function allItems($array)
{
    $image = explode(",", $array);
    return $image;
}

function discount($price, $discount)
{
    $dataDiscount = $price - $discount;
    $data = $dataDiscount * 100 / $price;
    return round($data);
}

function stringToItems($string, $value)
{
    $arr = explode(' ', trim($string));
    return $arr[$value];
}

function priceToFormat($price)
{
    return number_format($price, 2, '.', '.');
}
function replaceFormat($data)
{
    $return = str_replace(',', '.', $data);
    return $return;
}

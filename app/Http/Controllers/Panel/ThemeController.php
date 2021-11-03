<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function put(Request $request)
    {
        $request->validate(
            [
                'primary' => 'required',
                'secondary' => 'required',
            ],
            [
                'primary.required' => __('words.theme-primary-required'),
                'secondary.required' => __('words.theme-secondary-required')
            ]
        );
        $data = [
            'primary' => $request->primary,
            'secondary' => $request->secondary,
        ];
        setting($data)->save();
        return response()->json(['success' => __('words.theme-update-success')]);
    }
}

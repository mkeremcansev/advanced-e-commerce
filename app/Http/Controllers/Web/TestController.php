<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $request->validate(
            [
                'test1' => 'required',
                'test2' => 'required',
            ],
            [
                'test1.required' => 'Zorunlu input 1',
                'test2.required' => 'Zorunlu input 2',
            ]
        );
        return response()->json(['success' => 'İşlem başarılı bro!'], 200);
    }

    public function index()
    {
        return view('Web.index');
    }
}

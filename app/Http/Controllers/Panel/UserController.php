<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user($id)
    {
        $user = User::where('id', $id)->first() ?? abort(404);
        $user->status = 0;
        $user->save();
        return back()->with('success', __('words.user-update-success'));
    }

    public function admin($id)
    {
        $user = User::where('id', $id)->first() ?? abort(404);
        $user->status = 1;
        $user->save();
        return back()->with('success', __('words.admin-update-success'));
    }

    public function banned($id)
    {
        $user = User::where('id', $id)->first() ?? abort(404);
        $user->status = 2;
        $user->save();
        return back()->with('success', __('words.user-banned-success'));
    }

    public function unbanned($id)
    {
        $user = User::where('id', $id)->first() ?? abort(404);
        $user->status = 0;
        $user->save();
        return back()->with('success', __('words.unbanned-user-update-success'));
    }
}

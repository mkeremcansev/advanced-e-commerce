<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
            ],
            [
                'title.required' => __('words.announcement-title-required'),
                'title.max' => __('words.announcement-title-max', ['max' => ':max']),
            ]
        );
        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->save();
        return response()->json(['success' => __('words.announcement-success')]);
    }

    public function delete($id)
    {
        Announcement::where('id', $id)->delete() ?? abort(404);
        return back()->with('success', __('words.announcement-delete-success'));
    }

    public function update($id)
    {
        $announcement = Announcement::where('id', $id)->first() ?? abort(404);
        return view('Panel.Update.announcement', compact('announcement'));
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
            ],
            [
                'title.required' => __('words.announcement-title-required'),
                'title.max' => __('words.announcement-title-max', ['max' => ':max']),
            ]
        );
        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request->title;
        $announcement->save();
        return response()->json(['success' => __('words.announcement-update-success')]);
    }
}

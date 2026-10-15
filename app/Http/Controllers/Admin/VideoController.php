<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Course $course)
    {
        $videos = $course->videos()->orderBy('order_number')->get();
        return view('admin.videos.index', compact('course', 'videos'));
    }

    public function create(Course $course)
    {
        return view('admin.videos.form', ['course' => $course, 'video' => new Video()]);
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:512000',
            'video_url' => 'nullable|url',
            'order_number' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'video_url', 'order_number']);
        $data['course_id'] = $course->id;
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('video_file')) {
            $data['video_path'] = $request->file('video_file')->store('videos', 'public');
        }

        Video::create($data);

        return redirect()->route('admin.courses.videos.index', $course)
            ->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Course $course, Video $video)
    {
        return view('admin.videos.form', compact('course', 'video'));
    }

    public function update(Request $request, Course $course, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:512000',
            'video_url' => 'nullable|url',
            'order_number' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'video_url', 'order_number']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('video_file')) {
            $data['video_path'] = $request->file('video_file')->store('videos', 'public');
        }

        $video->update($data);

        return redirect()->route('admin.courses.videos.index', $course)
            ->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Course $course, Video $video)
    {
        $video->delete();
        return redirect()->route('admin.courses.videos.index', $course)
            ->with('success', 'Video berhasil dihapus.');
    }
}

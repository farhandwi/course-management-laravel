<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    public function index(Course $course)
    {
        $contents = $course->contents()->paginate(10);
        return view('admin.contents.index', compact('course', 'contents'));
    }

    public function create(Course $course)
    {
        return view('admin.contents.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'step_order' => 'required|integer',
        ]);

        $course->contents()->create($validated);

        return redirect()->route('courses.contents.index', $course->id)->with('success', 'Content created successfully.');
    }

    public function show(CourseContent $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    public function edit(CourseContent $content)
    {
        return view('admin.contents.edit', compact('content'));
    }

    public function update(Request $request, CourseContent $content)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'step_order' => 'required|integer',
        ]);

        $content->update($validated);

        return redirect()->route('courses.contents.index', $content->course_id)->with('success', 'Content updated successfully.');
    }

    public function destroy(CourseContent $content)
    {
        $content->delete();

        return redirect()->route('courses.contents.index', $content->course_id)->with('success', 'Content deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Division;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan query pencarian
        $search = $request->input('search');
        $divisionId = $request->input('division_id');

        // Mengambil data course dengan pagination dan pencarian
        $courses = Course::with('division')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($divisionId, function ($query, $divisionId) {
                return $query->where('division_id', $divisionId);
            })
            ->orderBy('step_order')
            ->paginate(10);

        // Mengambil semua division untuk filter
        $divisions = Division::all();

        return view('admin.courses.index', compact('courses', 'divisions'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('admin.courses.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'division_id' => 'required|exists:divisions,id',
            'step_order' => 'required|integer',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $divisions = Division::all();
        return view('admin.courses.edit', compact('course', 'divisions'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'division_id' => 'required|exists:divisions,id',
            'step_order' => 'required|integer',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}

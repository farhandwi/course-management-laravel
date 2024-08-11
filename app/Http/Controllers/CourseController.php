<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCourseContent;
use App\Models\CourseContent;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();
        
        // Filter by search keyword
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Filter by division
        if ($divisionId = $request->input('division_id')) {
            $query->where('division_id', $divisionId);
        }

        $courses = $query->withCount('contents')->paginate(10);

        $divisions = Division::all();

        $courseCount = Course::count();

        return view('courses.index', compact('courses', 'courseCount', 'divisions'));
    }


    public function myCourses()
    {
        $user = Auth::user();
        $courses = $user->courses()->with('contents')->get(); 

        return view('courses.my-courses', compact('courses'));
    }

    public function registerCourse(Request $request, $courseId)
    {
        $user = Auth::user();

        // Cek apakah pengguna sudah terdaftar di kursus ini
        $existingUserCourse = $user->userCourses()->where('course_id', $courseId)->first();
        if ($existingUserCourse) {
            return redirect()->route('course-detail', $courseId)->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        // Buat entri baru di user_courses
        $userCourse = $user->userCourses()->create([
            'course_id' => $courseId,
        ]);

        // Ambil konten pertama dari kursus
        $firstContent = Course::findOrFail($courseId)->contents()->orderBy('step_order', 'asc')->first();

        if ($firstContent) {
            // Buat entri baru di user_course_contents
            UserCourseContent::create([
                'user_course_id' => $userCourse->id,
                'content_id' => $firstContent->id,
                'progress' => 1,
                'completed' => false,
            ]);
        }

        return redirect()->route('course-detail', $courseId)->with('success', 'Anda berhasil mendaftar di kursus ini.');
    }

    public function courseDetail($courseId)
    {
        $user = Auth::user();

        // Muat kursus dan konten kursus
        $course = $user->courses()->with('contents')->findOrFail($courseId);

        // Ambil user_course yang sesuai
        $userCourse = $user->userCourses()->where('course_id', $courseId)->firstOrFail();

        // Ambil data pivot dari user_course_contents
        $contentsWithPivot = $course->contents->map(function ($content) use ($userCourse) {
            $content->pivot = $userCourse->userCourseContents()
                ->where('content_id', $content->id)
                ->first();
            return $content;
        });

        return view('courses.detail', compact('course', 'contentsWithPivot'));
    }



    public function contentDetail($courseId, $contentId)
    {
        $user = Auth::user();

        $userCourse = $user->userCourses()->where('course_id', $courseId)->firstOrFail();

        $course = $userCourse->course;
        $content = $course->contents()->findOrFail($contentId);

        // Ambil konten sebelumnya dan berikutnya berdasarkan step_order
        $previousContent = $course->contents()->where('step_order', '<', $content->step_order)->orderBy('step_order', 'desc')->first();
        $nextContent = $course->contents()->where('step_order', '>', $content->step_order)->orderBy('step_order', 'asc')->first();

        // Periksa apakah konten sebelumnya sudah selesai
        if ($previousContent) {
            $previousContentStatus = $userCourse->userCourseContents()->where('content_id', $previousContent->id)->first();
            if (!$previousContentStatus || !$previousContentStatus->completed) {
                return redirect()->route('course-detail', $courseId)->with('error', 'Anda harus menyelesaikan materi sebelumnya.');
            }
        }

        return view('courses.content_detail', compact('course', 'content', 'previousContent', 'nextContent'));
    }



    public function completeContent(Request $request, $courseId, $contentId)
    {
        $user = Auth::user();

        $userCourse = $user->userCourses()->where('course_id', $courseId)->firstOrFail();

        $userCourseContent = UserCourseContent::where('user_course_id', $userCourse->id)
            ->where('content_id', $contentId)
            ->firstOrFail();

        // Tandai konten ini sebagai selesai
        $userCourseContent->completed = true;
        $userCourseContent->progress = false;
        $userCourseContent->save();

        // dd($userCourseContent->content);
        if ($userCourseContent->content) {
            // Cek apakah konten berikutnya ada
            $nextContent = CourseContent::where('course_id', $courseId)
                ->where('step_order', '>', $userCourseContent->content->step_order)
                ->orderBy('step_order', 'asc')
                ->first();
            if ($nextContent) {
                // Buat data baru di UserCourseContent untuk konten berikutnya
                UserCourseContent::create([
                    'user_course_id' => $userCourse->id,
                    'content_id' => $nextContent->id,
                    'progress' => 0,
                    'completed' => false,
                ]);
            }
        } else {
            return redirect()->route('course-detail', $courseId)->with('error', 'Konten tidak ditemukan.');
        }

        return redirect()->route('course-detail', $courseId)->with('success', 'Konten telah ditandai sebagai selesai.');
    }




}

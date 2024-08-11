<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUsers(){
        return view('admin.users.index');
    }


    public function showDashboard(){
        return view('admin.dashboard');
    }


    public function showCourses(){
        return view('admin.courses.index');
    }
}

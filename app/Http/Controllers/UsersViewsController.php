<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersViewsController extends Controller
{
    public function indexLogin() {
        return view('Users.login');
    }

    public function indexRegister() {

        return view('Users.register');
    }

    public function indexDashboard() {
      
        return view('Users.dashboard');
    }

    public function indexUsers() {

        return view('Users.users');
    }

    public function indexCourses() {

        return view('Users.courses');
    }

    public function indexCalendar() {

        return view('Users.calendar');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //__index
    public function index() {
    $doctor = Doctor::all();
    $post = Post::all();
    if(Auth::user()) {
        if(Auth::user()->is_admin) {
            return view('admin.home',['doctor' => $doctor, 'posts' => $post]);
        }
        return view('user.home',['doctor' => $doctor,'posts' => $post]);
    }
        return view('user.home',['doctor' => $doctor, 'posts' => $post]);
    }


    //__store
    public function store(Request $request) {
        //
    }
}

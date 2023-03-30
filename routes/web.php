<?php

use App\Http\Controllers\Admin\{DoctorController, PostController, };
use App\Http\Controllers\HomeController;
use App\Models\Doctor;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $doctor = Doctor::all();
    $post = Post::all();
    return view('user.home', ['doctor' => $doctor,'posts' => $post]);
});

Route::get('/home', [HomeController::class,'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// ___Route for Admin only 
Route::middleware(['auth'])->group(function() {
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('create.doctor');
    Route::post('/doctors/store', [DoctorController::class, 'store'])->name('store.doctor');
    Route::delete('/doctors/delete/{doctor}', [DoctorController::class, 'destroy'])->name('destroy.doctor');

    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create.post');
    Route::post('/posts/store', [PostController::class, 'store'])->name('store.post');
    Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('destroy.post');

});
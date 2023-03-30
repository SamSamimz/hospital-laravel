<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

use function Pest\version;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor = Doctor::all();
        return view('admin.doctors',compact('doctor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = Post::all();
        return view('admin.createdoctor',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->image);
        //__validation
        $request->validate([
            'name' => 'required',
            'post' => 'required',
            'image' => 'required',
        ]);

        //__store doctor image
        if($request->hasFile('image')) {  
            $image = $request->file('image');
            $image_name = time().'_IMG_.'.$image->getClientOriginalExtension();
            $request->file('image')->storeAs('public/doctors/',$image_name);

        }

        $request->user()->doctor()->create([
            'name' => $request->name,
            'post_id' => $request->post,
            'image' => $image_name,

        ]);

        return redirect()->back()->with('success', 'A doctor has been added !');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //delete the image form storage
        $image = $doctor->image;
        if(file_exists(public_path('storage/doctors/'.$image))) {
            unlink(public_path('storage/doctors/'.$image));
        }
        //delete the data from database
        $doctor->delete();
        return redirect()->back()->with('delete','A doctor has been deleted !');
    }
}

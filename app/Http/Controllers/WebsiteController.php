<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBlog()
    {
        $blogs = Blog::paginate(2); // Adjust the number per page as needed
        // $blogs = Blog::all();
        return view('website.blog.index', compact('blogs'));
    }

    public function showBlog($id)
    {
        $blogPost = Blog::find($id);

        return view('website.blog.single', ['blogPost' => $blogPost]);
    }

    public function indexlandingPage()
    {
       

        // Tampilkan halaman blog
        return view('website.landingpage.index');
    }

    public function indexAktivitas()
    {
       

        // Tampilkan halaman blog
        return view('website.aktivitas.index');
    }

    public function indexKelas()
    {
       

        // Tampilkan halaman blog
        return view('website.kelas.index');
    }

    public function indexTestimoni()
    {
       

        // Tampilkan halaman blog
        return view('website.testimoni.index');
    }
    public function indexAboutUs()
    {
       

        // Tampilkan halaman blog
        return view('website.aboutus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

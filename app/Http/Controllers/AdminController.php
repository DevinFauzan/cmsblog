<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Media;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Halaman Blog

    public function showBlog()
    {
        // Ambil data blog dari database
        $blogs = Blog::all();

        // Tampilkan halaman blog
        return view('website.blog.admin.blog.blog', compact('blogs'));
    }

    public function showBlogForm()
    {
        // Tampilkan halaman formulir blog
        return view('website.blog.admin.blog.form_blog');
    }

    public function submitNewBlog(Request $request)
    {
        // Validasi formulir, termasuk validasi file
        $request->validate([
            'media_nama' => 'required|mimes:jpeg,png,jpg,gif,mp4,avi,wmv|max:10240',
            'deskripsi'  => 'required',
            'judul'      => 'required',
            'created_at' => 'required|date',
        ]);

        // Generate unique media ID
        $mediaId = 'MD' . str_pad(Media::count() + 1, 4, '0', STR_PAD_LEFT);

        // Simpan file
        $mediaPath = $request->file('media_nama')->store('media', 'public');

        // Simpan data ke tabel Media
        $media = Media::create([
            'media_id'   => $mediaId,
            'media_nama' => $mediaPath,
            'created_at' => now(),
        ]);

        // Create a new blog using the Blog model
        $blog = Blog::create([
            'deskripsi'   => $request->input('deskripsi'),
            'judul'       => $request->input('judul'),
            'created_at'  => $request->input('created_at'),
            'media_id'    => $media->id,
            'media_nama'  => $media->media_nama,
            'user_id'     => auth()->user()->id,
        ]);

        // Redirect atau kirim respons sesuai kebutuhan
        return redirect()->route('blog')->with('success', 'Blog berhasil disubmit.');
    }


    public function fetchBlogData()
    {
        // Fetch all blogs, you may need to adjust this based on your requirements
        $blogs = Blog::with('user')->get();
        return response()->json($blogs);
    }

    // Landing Page Section
    public function showLandingPage()
    {
        return view('website.blog.admin.landing_page.landing_page');
    }

    public function showLandingPageForm()
    {
        return view('website.blog.admin.landing_page.form_landing_page');
    }

    // Aktivitas Section
    public function showAktivitas()
    {
        return view('website.blog.admin.aktivitas.aktivitas');
    }

    public function showAktivitasForm()
    {
        return view('website.blog.admin.aktivitas.form_aktivitas');
    }

    // Kelas Section
    public function showKelas()
    {
        return view('website.blog.admin.kelas.kelas');
    }

    public function showKelasForm()
    {
        return view('website.blog.admin.kelas.form_kelas');
    }

    // Testimoni Section
    public function showTestimoni()
    {
        return view('website.blog.admin.tetstimoni.testimoni');
    }

    public function showTestimoniForm()
    {
        return view('website.blog.admin.tetstimoni.form_testimoni');
    }

    // About Us Section
    public function showAboutUs()
    {
        return view('website.blog.admin.about_us.about_us');
    }

    public function showAboutUsForm()
    {
        return view('website.blog.admin.about_us.form_about_us');
    }

    // Pendaftaran Section
    public function showPendaftaran()
    {
        return view('website.blog.admin.pendaftaran.pendaftaran');
    }
}

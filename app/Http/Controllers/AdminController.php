<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Roles;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // $mediaPath = $request->file('media_nama')->store('media', 'public');
        $mediaPath = $request->file('media_nama')->storeAs('media', $request->file('media_nama')->getClientOriginalName(), 'public');


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
        return redirect()->route('form_blog')->with('success', 'Blog submitted successfully!');
    }

    public function fetchBlogData()
    {
        // Fetch all blogs, you may need to adjust this based on your requirements
        $blogs = Blog::with('user')->get();
        return response()->json($blogs);
    }

    public function showBlogDetail($id)
    {
        $blog = Blog::find($id);
        return view('website.blog.admin.blog.blog_detail', compact('blog'));
    }

    public function showEditBlogForm($id)
    {
        $blog = Blog::find($id);
        // Add any other necessary data to pass to the view
        return view('website.blog.admin.blog.blog_detail', compact('blog'));
    }

    public function submitEditBlog(Request $request, $id)
    {
        $blog = Blog::find($id);

        // Validate the form data
        $request->validate([
            'media_nama' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,avi,wmv|max:10240',
            'deskripsi'  => 'required',
            'judul'      => 'required',
            'created_at' => 'required|date',
        ]);

        // Update the existing blog data
        $blog->deskripsi = $request->input('deskripsi');
        $blog->judul = $request->input('judul');
        $blog->created_at = $request->input('created_at');

        // Update media if a new file is provided
        if ($request->hasFile('media_nama')) {
            $request->validate([
                'media_nama' => 'mimes:jpeg,png,jpg,gif,mp4,avi,wmv|max:10240',
            ]);

            // Delete the old media file
            Storage::disk('public')->delete($blog->media_nama);

            // Store the new media file
            $mediaPath = $request->file('media_nama')->storeAs('media', $request->file('media_nama')->getClientOriginalName(), 'public');

            // Update media data
            $media = Media::create([
                'media_id'   => 'MD' . str_pad(Media::count() + 1, 4, '0', STR_PAD_LEFT),
                'media_nama' => $mediaPath,
                'created_at' => now(),
            ]);

            $blog->media_id = $media->id;
            $blog->media_nama = $media->media_nama;
        }

        // Save the changes
        $blog->save();

        // Redirect or send a response as needed
        // return redirect()->route('blog')->with('success', 'Blog successfully updated.');
        return redirect()->back()->with('success', 'Blog updated successfully!');
    }


    public function deleteBlog($id)
    {
        $blog = Blog::find($id);

        if ($blog) {
            // Retrieve the related media record
            $media = Media::find($blog->media_id);

            // Delete the blog record
            $blog->delete();

            // Delete the related media record
            if ($media) {
                $media->delete();
            }

            return redirect()->route('blog')->with('success', 'Blog berhasil dihapus');
        } else {
            return redirect()->route('blog')->with('error', 'Blog tidak ditemukan');
        }
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

    public function editrms()
    {
        $users = User::all();
        return view('website.blog.admin.roleManagement.form_role_management', compact('users'));
    }

    public function showRolemanagement()
    {
        $roles = Roles::all();
        return view('website.blog.admin.roleManagement.role_management', compact('roles'));
    }

    // Controller
    public function submitRole(Request $request)
    {
        // Validate the form data
        $request->validate([
            'role' => 'required|string', // Update to 'role'
            'akses_halaman' => 'required|array', // Update to 'pages'
            // Add other validation rules as needed
        ]);

        // Create a new role_management instance
        $roleManagement = Roles::create([
            'user_id' => auth()->user()->id,
            'role' => $request->input('role'),
            'akses_halaman' => implode(', ', $request->input('akses_halaman')),
            // Set other fields as needed
        ]);

        // Redirect to a success page or return a response
        return redirect()->route('showRolemanagement')->with('success', 'Role berhasil disubmit.');
    }

    public function updateRoleAkses(Request $request, $id)
    {
        $request->validate([
            'akses_halaman' => 'required|array', // Add any other validation rules
        ]);

        // Find the role by ID
        $role = Roles::findOrFail($id);

        // Update the akses_halaman field with the selected checkboxes
        $role->update([
            'akses_halaman' => implode(', ', $request->input('akses_halaman')),
            // Add other fields as needed
        ]);

        return redirect()->route('showRolemanagement')->with('success', 'Role akses updated successfully.');
    }

    public function showUsermanagement()
    {
        $users = User::all();
        $roles = Roles::all();
        return view('website.blog.admin.user_management.user_management', compact('users', 'roles'));
    }

    public function editUserManagement()
    {
        $users = User::all();
        return view('website.blog.admin.user_Management.form_user_management', compact('users'));
    }

    public function showUserManagementDetail($id)
    {
        $users = User::find($id);
        $roles = Roles::all();
        return view('website.blog.admin.user_management.user_management_detail', compact('users', 'roles'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,role',
            // Add other validation rules as needed
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'role' => $request->input('role'),
            // Update other fields as needed
        ]);

        return redirect()->route('showUserManagement')->with('success', 'User role updated successfully.');
    }


    public function fetchUserManagementData()
    {
        // Fetch all blogs, you may need to adjust this based on your requirements
        $users = User::select(['name', 'role'])->get();
        return response()->json($users);
    }

    public function fetchRoleManagementData()
    {
        // Fetch all blogs, you may need to adjust this based on your requirements
        $users = User::select(['name', 'role'])->get();
        return response()->json($users);
    }

    public function showRoleManagementDetail($id)
    {
        $role = Roles::find($id);
        return view('website.blog.admin.roleManagement.role_management_detail', compact('role'));
    }
}

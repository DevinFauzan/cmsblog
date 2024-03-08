<!DOCTYPE html>
<html lang="en">
@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <!-- Adjust the path based on your project structure -->
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

</head>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/blog" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    Blog Edit
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="editBlog" action="{{ route('blog.edit.submit', $blog->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST') <!-- Add this line for Laravel to recognize the form method as POST -->
                                @if ($blog->media_nama)
                                    <div class="form-group">
                                        <img src="{{ asset('storage/' . $blog->media_nama) }}" alt="Current Media"
                                            width="100">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleTextarea1">Input Foto atau Video</label>
                                    <input type="file" class="form-control" name="media_nama" accept="image/,video/">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Judul</label>
                                    <input type="text" class="form-control" id="exampleInputSubject"
                                        placeholder="Judul Blog" name="judul" required
                                        value="{{ old('judul', $blog->judul) }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi', $blog->deskripsi) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Tanggal Submit</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="created_at"
                                        placeholder="date" required
                                        value="{{ old('created_at', $blog->created_at->format('Y-m-d')) }}" readonly>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit Changes</button>
                                </div>
                            </form>
                            <script>
                                tinymce.init({
                                    selector: 'textarea',
                                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                    tinycomments_mode: 'embedded',
                                    tinycomments_author: 'Author name',
                                    mergetags_list: [{
                                            value: 'First.Name',
                                            title: 'First Name'
                                        },
                                        {
                                            value: 'Email',
                                            title: 'Email'
                                        },
                                    ],
                                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                                        "See docs to implement AI Assistant")),

                                    // Added image upload configuration
                                    images_upload_url: 'public/storage/media',
                                    images_upload_credentials: true,
                                    paste_data_images: true,
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success'
                }).then(function() {
                    window.location.href = '{{ route('blog') }}';
                });
            });
        </script>
    @endif

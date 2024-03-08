@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="deskripsi" required>{{ old('deskripsi', $blog->deskripsi) }}</textarea>
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

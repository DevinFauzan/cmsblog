@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/role_management" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    Role Management
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('updateRoleAkses', $role->id) }}" method="post">
                                @csrf
                                @method('PUT') {{-- Use the correct method for updating --}}
                                <div class="form-group">
                                    <label for="exampleInputName1">Role</label>
                                    <input type="text" value="{{ $role->role }}" class="form-control"
                                        id="exampleInputName1" placeholder="Name" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleCheckbox">Akses Halaman</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                    value="Landing Page" {{ in_array('Landing Page', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="landingPage">Landing Page</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                    value="Aktivitas" {{ in_array('Aktivitas', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="aktivitas">Aktivitas</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                    value="Pendaftaran" {{ in_array('Pendaftaran', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pendaftaran">Pendaftaran</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                    value="Blog" {{ in_array('Blog', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="blog">Blog</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                    value="Kelas" {{ in_array('Kelas', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="kelas">Kelas</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                    value="Testimoni" {{ in_array('Testimoni', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="testimoni">Testimoni</label>
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                        value="About Us" {{ in_array('About Us', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="aboutUs">About Us</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                        value="Role Management" {{ in_array('Role Management', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="rms ">Role Management </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="akses_halaman[]"
                                                        value="User Management" {{ in_array('User Management', explode(', ', $role->akses_halaman)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="um ">User Management </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

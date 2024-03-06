@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header d-flex justify-content-between align-items-center mb-5">
                                <h4 class="card-title mb-0">Blog</h4>
                                <div class="d-flex">
                                    <a href="{{ route('form_blog') }}" class="btn btn-sm btn-primary ms-2">
                                        <span class="mdi mdi-plus mdi-18px me-1"></span>
                                        New Submit
                                    </a>
                                </div>
                            </div>
                            <div class="">
                                <table id="blogTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Foto atau Video</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Di Submit oleh</th>
                                            <th>Tanggal Submit</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>
                                                <img src="/storage/{{ $blog->media_nama }}" alt="Media" width="50">
                                            </td>
                                            <td>{{ $blog->judul }}</td>
                                            <td>{{ strlen($blog->deskripsi) > 50 ? substr($blog->deskripsi, 0, 50) . '...' : $blog->deskripsi }}
                                            </td>
                                            <td>{{ $blog->user ? $blog->user->name : 'N/A' }}</td>
                                            <td>{{ $blog->created_at }}</td>
                                            <td>
                                                <a href="{{ route('blog.edit', $blog->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    @section('scripts')
        {{-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                var table = $('#blogTable').DataTable({
                    columnDefs: [{
                            width: '100px',
                            targets: 0
                        },
                        {
                            width: '300px',
                            targets: 1
                        },
                        {
                            width: '700px',
                            targets: 2
                        },
                        {
                            width: '150px',
                            targets: 3
                        },
                        {
                            width: '120px',
                            targets: 4
                        }
                    ],
                    columns: [
                        null, // First column (Foto atau Video)
                        null, // Second column (Judul)
                        {
                            render: function(data, type, row) {
                                return data.length > 50 ? data.substr(0, 50) + '...' : data;
                            },
                            targets: 2
                        }, // Third column (Deskripsi)
                        null, // Fourth column (Di Submit oleh)
                        null,
                        null // Fifth column (Tanggal Submit)
                    ]
                });
            });
        </script> --}}
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#blogTable').DataTable(); // Inisialisasi DataTable                
            });
        </script>
    @endsection

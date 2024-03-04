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
                                        </tr>
                                    </thead>
                                    <tbody id="blogTableBody">
                                        <!-- Table body content will be loaded dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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
                        null // Fifth column (Tanggal Submit)
                    ]
                });

                // Fetch data using AJAX
                $.ajax({
                    url: '{{ route('blog.fetch') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Clear existing rows
                        table.clear().draw();

                        // Add fetched data to the table
                        $.each(data, function(index, blog) {
                            table.row.add([
                                '<img src="/storage/' + blog.media_nama +
                                '" alt="Media" width="50">',
                                blog.judul,
                                blog.deskripsi,
                                blog.user ? blog.user.name :
                                'N/A', // Access the user's name through the relationship
                                blog.created_at,
                            ]).draw();
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        </script>
    @endsection

@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body ">
                            <div class="card-header d-flex justify-content-between align-items-center mb-5">
                                <h4 class="card-title mb-0">Landing Page</h4>
                                <div class="d-flex">
                                    <a href="{{ route('form_landing_page') }}" class="btn btn-sm btn-primary ms-2">
                                        <span class="mdi mdi-plus mdi-18px me-1"></span>
                                        New Submit
                                    </a>
                                </div>
                            </div>
                            <h4 class="card-title mb-0">Video Table</h4>
                            <div class="table-responsive">
                                <table id="landingPageVideoTable" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> Video </th>
                                            <th> Deskripsi </th>
                                            <th> Di Submit oleh </th>
                                            <th> Tanggal Submit </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <h4 class="card-title mb-0">Tagline Table</h4>
                            <div class="table-responsive">
                                <table id="landingPageTaglineTable" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> Foto Tagline </th>
                                            <th> Tagline </th>
                                            <th> Di Submit oleh </th>
                                            <th> Tanggal Submit </th>
                                        </tr>
                                    </thead>
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
                $('#landingPageVideoTable').DataTable();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#landingPageTaglineTable').DataTable();
            });
        </script>
    @endsection

@extends('layouts.auth')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/aktivitas" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    Form Aktivitas
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitAboutUs" action=""
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleTextarea1">Input Video</label>
                                    <input type="file" class="form-control" name="video" accept="video/*" required>
                                </div> 
                                <div class="form-group">
                                    <label for="exampleTextarea1">Deskripsi</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" required></textarea>
                                </div>  
                                {{-- <div class="form-group">
                                    <label for="exampleInputName1">di Submit oleh</label>
                                    <input type="text" class="form-control" id="exampleInputSubject"
                                        placeholder="Nama" name="Nama" required>
                                </div>  --}}
                                <div class="form-group">
                                    <label for="exampleInputName1">Tanggal Submit</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="complained_date"
                                        placeholder="date" required value="{{ now()->format('Y-m-d') }}" readonly>
                                </div>                                
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if (session('newTicketInfoUser'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Show SweetAlert when the page is loaded
                            const sweetAlert = Swal.fire({
                                icon: 'success',
                                title: 'Ticket submitted successfully!',
                                html: `
                        <p>Ticket ID: {{ session('newTicketInfoUser')['ticket_id'] }}</p>
                        <p>Name: {{ session('newTicketInfoUser')['name_user'] }}</p>
                        <p>Email: {{ session('newTicketInfoUser')['email'] }}</p>                        
                    `,
                            });
                        });
                    </script>
                @endif
            @endsection

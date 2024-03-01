@extends('layouts.auth')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/kelas" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    Form Kelas
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
                                    <label for="exampleSelectKelas">Kelas</label>
                                    <select class="form-control" id="exampleSelectKelas" name="kelas" required>
                                        <option disabled selected>Pilih Kelas</option>
                                        <option value="0">Playgroup</option>
                                        <option value="1">TK A</option>
                                        <option value="2">TK B</option>                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Input Foto atau Video</label>
                                    <input type="file" class="form-control" name="media" accept="image/*,video/*" required>
                                </div>  
                                <div class="form-group">
                                    <label for="exampleTextarea1">Deskripsi</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" required></textarea>
                                </div>                                                                                                                                                          
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

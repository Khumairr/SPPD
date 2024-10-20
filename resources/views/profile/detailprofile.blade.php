@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
        background-color: #f8f9fa;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .min-vh-100 {
        padding: 40px 0;
    }
</style>
<a href="{{ route('dashboard') }}" class="btn btn-secondary mt-2">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h5>Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $username }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_tim" class="form-label">Nama Tim</label>
                            <input type="text" class="form-control" id="nama_tim" name="nama_tim" value="{{ $nama_tim }}" readonly>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ubah Password Section -->
            <!-- <div class="card">
                <div class="card-header text-center">
                    <h5>Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="password_sekarang" class="form-label">Password Sekarang</label>
                            <input type="password" class="form-control" id="password_sekarang" name="password_sekarang" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_baru" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                        </div>
                        <div class="mb-3">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan Password</button>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

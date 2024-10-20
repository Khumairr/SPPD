@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .card-header {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 15px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    .dropdown-menu {
        border-radius: 10px;
    }
    h5 {
        font-size: 1.5rem;
    }
    .card-body {
        padding: 1.5rem;
    }
    .dropdown-item:hover {
        background-color: #f0f0f0;
        color: #333;
    }
</style>

<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mt-2">Anggaran Tahun {{ $tahun_anggaran }}</h3>
        <div class="dropdown">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle fs-5" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $roleName }}
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="{{ route('profile.detailprofile') }}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                @if($roleName === 'Super Admin')
                    <li><a class="dropdown-item" href="{{ route('superadmin.datauser') }}">Data User</a></li>
                    <li><a class="dropdown-item" href="{{ route('superadmin.datatimkerja') }}">Data Tim Kerja</a></li>
                    <li><a class="dropdown-item" href="{{ route('superadmin.datakantor') }}">Data Kantor</a></li>
                    <li><a class="dropdown-item" href="{{ route('superadmin.datapegawai') }}">Data Pegawai</a></li>
                @endif
            </ul>
        </div>
    </div>
    <hr>

    <div class="row g-4 mt-4">
        <div class="col-md-6">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-header text-center">ANGGARAN AWAL</div>
                <div class="card-body">
                    <h5 class="card-title text-center">Rp. {{ number_format($anggaran_awal, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-header text-center">ANGGARAN SUDAH KEPAKAI</div>
                <div class="card-body">
                    <h5 class="card-title text-center">Rp. {{ number_format($sisa_anggaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-8 mx-auto">
            <div class="card bg-dark text-white shadow-sm">
                <div class="card-header text-center">SISA ANGGARAN</div>
                <div class="card-body">
                    <h5 class="card-title text-center">Rp. {{ number_format($anggaran_awal + $sisa_anggaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Tombol Back di Pojok Kiri Atas -->
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
        <h3 class="text-center flex-grow-1">Data Tim Kerja</h3>
    </div>

    <hr class="border-2 mb-4" style="border-top: 2px solid #007bff;">

    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('adddatatimkerja') }}" class="btn btn-secondary text-white mb-3" style="transition: 0.3s;">+ Tambah Tim Kerja</a>
    
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>Tim Kerja</th>
                <th>Anggaran Awal</th>
                <th>Anggaran Sudah Kepakai</th>
                <th>Tahun Anggaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($timkerja as $key => $tim)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $tim->nama_tim }}</td>
                <td>{{ number_format($tim->anggaran_awal) }}</td>
                <td>{{ number_format($tim->sisa_anggaran) }}</td>
                <td>{{ $tim->tahun_anggaran }}</td>
                <td>
                    <a href="{{ route('editdatatimkerja', ['id' => $tim->id_tim_kerja]) }}" class="btn btn-secondary text-white" style="transition: 0.3s;">EDIT</a> |
                    <form action="{{ route('deletetimkerja', ['id' => $tim->id_tim_kerja]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white" style="transition: 0.3s;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">HAPUS</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

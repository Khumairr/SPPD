@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Tombol Back di Pojok Kiri Atas -->
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
        <h3 class="text-center flex-grow-1">Data Kantor</h3>
    </div>

    <hr class="border-2 mb-4" style="border-top: 2px solid #007bff;">

    <!-- Tampilkan Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('adddatakantor') }}" class="btn btn-secondary text-white mb-3" style="transition: 0.3s;">+ Tambah Kantor</a>
    
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>Nama Kantor</th>
                <th>Alamat</th>
                <th>Uang Harian</th>
                <th>Transport</th>
                <th>Akomodasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kantor as $key => $k)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $k->nama_kantor }}</td>
                <td>{{ $k->alamat_kantor }}</td>
                <td>{{ number_format($k->uang_harian) }}</td>
                <td>{{ number_format($k->transport) }}</td>
                <td>{{ number_format($k->akomodasi) }}</td>
                <td>
                    <a href="{{ route('editdatakantor', ['id' => $k->id_kantor]) }}" class="btn btn-secondary text-white" style="transition: 0.3s;">EDIT</a> |
                    <form action="{{ route('deletekantor', ['id' => $k->id_kantor]) }}" method="POST" style="display:inline;">
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

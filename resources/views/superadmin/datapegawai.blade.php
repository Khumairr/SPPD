@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Tombol Back di Pojok Kiri Atas -->
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
        <h3 class="text-center flex-grow-1">Data Pegawai</h3>
    </div>

    <hr class="border-2 mb-4" style="border-top: 2px solid #007bff;">

    <!-- Tampilkan Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('adddatapegawai') }}" class="btn btn-secondary text-white mb-3" style="transition: 0.3s;">+ Tambah Pegawai</a>
    
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Golongan</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($karyawans as $karyawan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $karyawan->nip }}</td>
                <td>{{ $karyawan->nama_staff }}</td>
                <td>{{ $karyawan->golongan }}</td>
                <td>{{ $karyawan->jabatan }}</td>
                <td>
                    <a href="{{ route('editdatapegawai', $karyawan->id_staff) }}" class="btn btn-secondary text-white mb-3" style="transition: 0.3s;">EDIT</a> <br>
                    <form action="{{ route('deletepegawai', $karyawan->id_staff) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white" style="transition: 0.3s;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">HAPUS</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Data Pegawai tidak ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

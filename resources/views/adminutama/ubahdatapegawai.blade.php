@extends('adminutama.navbar.admin')

@section('content')
<div class="mt-3">
    <h2 class="text-center">Edit Data Pegawai</h2>
    <form action="{{ route('ubahPegawai', $pegawai->id_staff) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip', $pegawai->nip) }}" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $pegawai->nama_staff) }}" required>
        </div>
        <div class="form-group">
            <label for="golongan">Golongan:</label>
            <input type="text" name="golongan" id="golongan" class="form-control" value="{{ old('golongan', $pegawai->golongan) }}" required>
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan:</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
        </div>
        <button type="submit" class="btn btn-primary mr-5">Simpan</button>
        <a href="{{ route('adminutama.datapegawai') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
    </form>
</div>
@endsection
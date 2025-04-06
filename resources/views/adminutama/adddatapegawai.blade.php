@extends('adminutama.navbar.admin')

@section('content')
<div class="container">
    <div class="mt-3">
        <h3 class="text-center">Tambah Data Pegawai</h3>
        <hr class="border-2" style="border-top: 2px solid;">
        <form action="{{ route('tambahdatapegawai') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" required autocomplete='off'>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required autocomplete='off'>
            </div>
            <div class="mb-3">
                <label for="golongan" class="form-label">Golongan</label>
                <input type="text" class="form-control" id="golongan" name="golongan" required autocomplete='off'>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required autocomplete='off'>
            </div>
            <button type="submit" class="btn btn-primary text-white mr-5" style="transition: 0.3s;">Simpan</button>
            <a href="{{ route('adminutama.datapegawai') }}" class="btn btn-secondary">
                <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
                Back
            </a>
        </form>
    </div>
</div>
@endsection
@extends('adminutama.navbar.admin')

@section('content')
<div class="container">
    <div class="mt-3">
        <h3 class="text-center">Edit Data Kantor</h3>
        <form action="{{ route('ubahkantor', ['id' => $kantor->id_kantor]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_kantor">Nama Kantor:</label>
                <input type="text" name="nama_kantor" id="nama_kantor" class="form-control" value="{{ $kantor->nama_kantor }}" required>
            </div>
            <div class="form-group">
                <label for="alamat_kantor">Alamat:</label>
                <input type="text" name="alamat_kantor" id="alamat_kantor" class="form-control" value="{{ $kantor->alamat_kantor }}" required>
            </div>
            <div class="form-group">
                <label for="uang_harian">Uang Harian:</label>
                <input type="text" name="uang_harian" id="uang_harian" class="form-control" value="{{ $kantor->uang_harian }}" required>
            </div>
            <div class="form-group">
                <label for="transport">Transport:</label>
                <input type="text" name="transport" id="transport" class="form-control" value="{{ $kantor->transport }}" required>
            </div>
            <div class="form-group">
                <label for="akomodasi">Akomodasi:</label>
                <input type="text" name="akomodasi" id="akomodasi" class="form-control" value="{{ $kantor->akomodasi }}" required>
            </div>
            <button type="submit" class="btn btn-primary mr-5">Simpan</button>
            <a href="{{ route('adminutama.datakantor') }}" class="btn btn-secondary">
                <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
                Back
        </a>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('sppd.index') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
    </div>

    <h2 class="mt-3 text-center">Detail SPT</h2>
    <hr class="border-2" style="border-top: 2px solid;">

    <!-- Detail SPT Fields -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <label for="noSpt"><h6>No. SPT :</h6></label>
                <input type="text" id="noSpt" class="form-control" value="{{ $sppd->no_spt }}" readonly>
            </div>
        </div>
    </div>

    <!-- Tanggal SPT and PPK Sejajar -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tgl_spt"><h6>Tanggal SPT :</h6></label>
                <input type="text" id="tgl_spt" class="form-control" value="{{ \Carbon\Carbon::parse($sppd->tgl_spt)->locale('id')->translatedFormat('d F Y') }}" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="ppk"><h6>PPK :</h6></label>
                <input type="text" id="ppk" class="form-control" value="{{ $sppd->ppk }}" readonly>
            </div>
        </div>
    </div>

    <!-- Perihal (Tetap Sendiri) -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <label for="perihal"><h6>Perihal :</h6></label>
                <textarea id="perihal" class="form-control" rows="3" readonly>{{ $sppd->perihal_sppd }}</textarea>
            </div>
        </div>
    </div>


    <!-- Angkutan and Tujuan Sejajar -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="angkutan"><h6>Angkutan :</h6></label>
                <input type="text" id="angkutan" class="form-control" value="{{ $sppd->angkutan }}" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tujuan"><h6>Tujuan :</h6></label>
                <input type="text" id="tujuan" class="form-control" value="{{ $sppd->tujuan }}" readonly>
            </div>
        </div>
    </div>

    <!-- Tanggal Berangkat, Tanggal Kembali, dan Lama Perjalanan Sejajar -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="form-group">
                <label for="tgl_berangkat"><h6>Tanggal Berangkat :</h6></label>
                <input type="text" id="tgl_berangkat" class="form-control" value="{{ \Carbon\Carbon::parse($sppd->tgl_berangkat)->locale('id')->translatedFormat('d F Y') }}" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tgl_kembali"><h6>Tanggal Kembali :</h6></label>
                <input type="text" id="tgl_kembali" class="form-control" value="{{ \Carbon\Carbon::parse($sppd->tgl_kembali)->locale('id')->translatedFormat('d F Y') }}" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="lama_perjalanan"><h6>Lama Perjalanan :</h6></label>
                <input type="text" id="lama_perjalanan" class="form-control" value="{{ $sppd->lama_perjalanan }}" readonly>
            </div>
        </div>
    </div>

    <!-- Employee Data Section -->
    <h5 class="mt-4">Data Pegawai</h5>
@foreach($pegawaiList as $index => $pegawai)
    <div class="card mb-3">
        <div class="card-body">
            <h6 class="card-title">Pegawai {{ $index + 1 }}</h6>
            
            <!-- Baris untuk Nama dan NIP -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namaPegawai{{ $index + 1 }}">Nama:</label>
                        <input type="text" id="nama_pegawai{{ $index + 1 }}" class="form-control" value="{{ $pegawai->nama_staff }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nip_pegawai{{ $index + 1 }}">NIP:</label>
                        <input type="text" id="nip_pegawai{{ $index + 1 }}" class="form-control" value="{{ $pegawai->nip }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Baris untuk Golongan dan Jabatan -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="golongan_pegawai{{ $index + 1 }}">Golongan:</label>
                        <input type="text" id="golongan_pegawai{{ $index + 1 }}" class="form-control" value="{{ $pegawai->golongan }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jabatan_pegawai{{ $index + 1 }}">Jabatan:</label>
                        <input type="text" id="jabatan_pegawai{{ $index + 1 }}" class="form-control" value="{{ $pegawai->jabatan }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Action Buttons -->
    <div class="text-center mt-4">
        <a href="{{ route('sppd.editsppd', $sppd->id_sppd) }}" class="btn btn-primary">Edit</a>
    </div>
    <br>
    <div class="d-flex justify-content-around mt-4">
        <a href="{{ route('sppd.cetak-spt', $sppd->id_sppd) }}" target="_blank" class="btn btn-danger">
            <img src="{{ asset('img/download.png') }}" alt="Download" style="width: 16px; height: 17px; margin-right: 5px;">
            Download SPT
        </a>
        <a href="{{ route('sppd.cetak-spd', $sppd->id_sppd) }}" target="_blank" class="btn btn-danger">
            <img src="{{ asset('img/download.png') }}" alt="Download" style="width: 16px; height: 16px; margin-right: 5px;">
            Download SPD
        </a>
        <a href="{{ route('sppd.cetak-ttd', $sppd->id_sppd) }}" target="_blank" class="btn btn-danger">
            <img src="{{ asset('img/download.png') }}" alt="Download" style="width: 16px; height: 16px; margin-right: 5px;">
            Download TTD
        </a>
    </div>
    <br>
</div>
@endsection

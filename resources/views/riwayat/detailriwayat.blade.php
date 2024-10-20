@extends('layouts.app')

@section('content')
<div class="container">
        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('riwayat.riwayatsppd') }}" class="btn btn-secondary">
                <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
                Back
            </a>
        </div>
    <h3 class="mt-4 text-center">Riwayat</h3>
    <hr class="border-2">

    <div class="form-group">
        <label for="no_spt" class="font-weight-bold">No SPT :</label>
        <input type="text" id="no_spt" class="form-control" value="{{ $details->first()->no_spt }}" readonly>
    </div>

    <div class="form-group">
        <label for="no_kwitansi" class="font-weight-bold">No Kwitansi :</label>
        <input type="text" id="no_kwitansi" class="form-control" value="{{ $details->first()->no_kwitansi }}" readonly>
    </div>

    <div class="form-group">
        <label for="perihal_laporan" class="font-weight-bold">Perihal Laporan :</label>
        <textarea id="perihal_laporan" class="form-control" rows="3" readonly>{{ $details->first()->laporan }}</textarea>
    </div>

    <hr class="border-2">

    @foreach ($details as $detail)
        <div class="border p-3 mb-4 rounded shadow-sm bg-light">
            <h6 class="mt-4 font-weight-bold">Pegawai {{ $loop->iteration }} :</h6>
            
            <h6>NIP : <span class="font-italic">{{ $detail->nip }}</span></h6>
            <h6>Nama Pegawai : <span class="font-italic">{{ $detail->nama_staff }}</span></h6>

            <div class="form-row">
    <div class="col-md-4 mb-3">
        <label for="uang_hari" class="font-weight-bold">Uang Harian: (Rp.)</label>
        <input type="text" id="uang_hari" class="form-control" value="{{ $detail->uang_hari }}" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label for="lama_perjalanan" class="font-weight-bold">Lama Perjalanan:</label>
        <input type="text" id="lama_perjalanan" class="form-control" value="{{ $detail->lama_perjalanan }}" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label for="total_harian" class="font-weight-bold">Total Harian : (Rp.)</label>
        <input id="total_harian" class="form-control" value="{{ $detail->total_harian }}" readonly>
    </div>
</div>

<div class="form-row">
    <div class="col-md-4 mb-3">
        <label for="uang_transport" class="font-weight-bold">Transport: (Rp.)</label>
        <input type="text" id="uang_transport" class="form-control" value="{{ $detail->uang_transport }}" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label for="biaya_transport" class="font-weight-bold">Biaya Transport:</label>
        <input type="text" id="biaya_transport" class="form-control" value="{{ $detail->biaya_transport }}" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label for="total_transport" class="font-weight-bold">Total Transport : (Rp.)</label>
        <input id="total_transport" class="form-control" value="{{ $detail->total_transport }}" readonly>
    </div>
</div>

<div class="form-row">
    <div class="col-md-4 mb-3">
        <label for="uang_akomodasi" class="font-weight-bold">Akomodasi:(Rp.)</label>
        <input type="text" id="uang_akomodasi" class="form-control" value="{{ $detail->uang_akomodasi }}" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label for="lama_akomodasi" class="font-weight-bold">Lama Akomodasi:</label>
        <input type="text" id="lama_akomodasi" class="form-control" value="{{ $detail->lama_akomodasi }}" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label for="total_akomodasi" class="font-weight-bold">Total Akomodasi :(Rp.)</label>
        <input id="total_akomodasi" class="form-control" value="{{ $detail->total_akomodasi }}" readonly>
    </div>
</div>


            <div class="form-group">
                <label for="total_kwitansi" class="font-weight-bold">Total Kwitansi : (Rp.)</label>
                <input id="total_kwitansi" class="form-control total_kwitansi" value="{{ $detail->total_kwitansi }}" readonly>
            </div>
        </div>
        <hr class="border-2">
    @endforeach

    <form action="{{ route('dashboard.updateAnggaran') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="total_keseluruhan" class="font-weight-bold">Total Keseluruhan :</label>
            <input id="total_keseluruhan" name="total_keseluruhan" class="form-control" readonly>
        </div>

        <h5 class="text-center mt-4">Jika sudah yakin dan benar perhitungannya silahkan klik
        <button id="submitButton" type="submit" class="btn btn-primary">Kirim</button>
        </form>
        untuk 1 kali saja, namun bila belum 
        <button type="button" class="ml-2 btn btn-warning">
            <a href="{{ route('editdetailriwayat', $details->first()->no_kwitansi) }}" style="color: white;">EDIT-></a>
        </button>
        </h5>

        <script>
            window.onload = function() {
                let totalKeseluruhan = 0;
                const totalKwitansiFields = document.querySelectorAll('.total_kwitansi');

                totalKwitansiFields.forEach(function(input) {
                    totalKeseluruhan += parseFloat(input.value) || 0;
                });

                document.getElementById('total_keseluruhan').value = Math.round(totalKeseluruhan);
            };
        </script>

        <div class="d-flex justify-content-between mt-4">
            @foreach ([
                ['route' => 'download.spt', 'label' => 'Download SPT'],
                ['route' => 'download.spd', 'label' => 'Download SPD'],
                ['route' => 'download.ttd', 'label' => 'Download TTD'],
                ['route' => 'cetakLaporan', 'label' => 'Download Laporan'],
                ['route' => 'download.kwitansi', 'label' => 'Download Kwitansi'],
            ] as $item)
                <button type="button" class="btn btn-danger">
                    <a href="{{ route($item['route'], $details->first()->no_kwitansi) }}" target="_blank" style="color: white; display: flex; align-items: center;">
                        <img src="{{ asset('img/download.png') }}" alt="Download" style="width: 16px; height: 16px; margin-right: 5px;">
                        {{ $item['label'] }}
                    </a>
                </button>
            @endforeach
        </div>

        <br><br>
    </div>
@endsection

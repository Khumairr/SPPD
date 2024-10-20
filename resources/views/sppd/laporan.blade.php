@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Flex container for title and button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Back Button -->
            <a href="{{ route('sppd.index') }}" class="btn btn-secondary">
                <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 15px; height: 15px; margin-right: 5px;">
                Back
            </a>
            <!-- Title -->
            <h3 class="text-center w-100">Form Laporan</h3>
        </div>
        <hr class="border-2" style="border-top: 2px solid;">
        
        <form action="{{ route('sppd.storeLaporan', $sppd->id_sppd) }}" method="POST">
            @csrf
            
            <!-- Deskripsi Laporan -->
            <div class="mb-4">
                <label for="laporan" class="form-label fw-bold">Deskripsi Laporan:</label>
                <textarea class="form-control" id="laporan" name="laporan" rows="3" required></textarea>
            </div>

            <h4 class="mt-4">Data Kwitansi</h4>

            <!-- No. Kwitansi -->
            <div class="mb-4">
                <label for="no_kwitansi" class="form-label fw-bold">No. Kwitansi:</label>
                <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" required autocomplete='off'>
            </div>

            <!-- Pegawai Section -->
            @foreach($pegawai as $index => $p)
            <div class="employee-section mb-4 p-3 border rounded">
                <h5 class="fw-bold">Pegawai {{ $index + 1 }}</h5>
                <h6>(NIP: {{ $p->nip }}) (Nama: {{ $p->nama_staff }})</h6>
                <input type="hidden" name="id_staff[]" value="{{ $p->id_staff }}">
                
                <hr class="border-2" style="border-top: 1px solid;">

                <!-- Uang Harian dan Lama Perjalanan -->
<!-- Uang Harian, Lama Perjalanan, dan Total Harian (Sejajar) -->
<div class="row mb-3">
    <div class="col">
        <label for="uang_hari_{{ $index }}" class="form-label">Uang Harian: (Rp.)</label>
        <input type="text" id="uang_hari_{{ $index }}" name="total_harian[]" class="form-control uang_hari" value="{{ $kantor->uang_harian }}" oninput="calculateTotal({{ $index }})" required>
    </div>
    <div class="col">
        <label for="lama_perjalanan_{{ $index }}" class="form-label">Lama Perjalanan:</label>
        <input type="text" id="lama_perjalanan_{{ $index }}" name="lama_perjalanan[]" class="form-control lama_perjalanan" oninput="calculateTotal({{ $index }})" required autocomplete='off'>
    </div>
    <div class="col">
        <label for="total_harian_{{ $index }}" class="form-label">Total Harian: (Rp.)</label>
        <input type="text" id="total_harian_{{ $index }}" class="form-control total_harian" readonly required>
    </div>
</div>

<!-- Transport, Biaya Transport, dan Total Transport (Sejajar) -->
<div class="row mb-3">
    <div class="col">
        <label for="transport_{{ $index }}" class="form-label">Transport: (Rp.)</label>
        <input type="text" id="transport_{{ $index }}" name="total_transport[]" class="form-control" value="{{ $kantor->transport }}" required>
    </div>
    <div class="col">
        <label for="biayaTransport_{{ $index }}" class="form-label">Biaya Transport:</label>
        <input type="text" id="biayaTransport_{{ $index }}" name="biaya_transport[]" class="form-control biayaTransport" oninput="calculateTransport({{ $index }})" required autocomplete='off'>
    </div>
    <div class="col">
        <label for="totalTransport_{{ $index }}" class="form-label">Total Transport: (Rp.)</label>
        <input type="text" id="totalTransport_{{ $index }}" class="form-control totalTransport" readonly required>
    </div>
</div>

<!-- Akomodasi, Lama Akomodasi, dan Total Akomodasi (Sejajar) -->
<div class="row mb-3">
    <div class="col">
        <label for="akomodasi_{{ $index }}" class="form-label">Akomodasi: (Rp.)</label>
        <input type="text" id="akomodasi_{{ $index }}" name="total_akomodasi[]" class="form-control" value="{{ $kantor->akomodasi }}" required>
    </div>
    <div class="col">
        <label for="lamaAkomodasi_{{ $index }}" class="form-label">Lama Akomodasi:</label>
        <input type="text" id="lamaAkomodasi_{{ $index }}" name="lama_akomodasi[]" class="form-control lamaAkomodasi" oninput="calculateAkomodasi({{ $index }})" required autocomplete='off'>
    </div>
    <div class="col">
        <label for="totalAkomodasi_{{ $index }}" class="form-label">Total Akomodasi: (Rp.)</label>
        <input type="text" id="totalAkomodasi_{{ $index }}" class="form-control totalAkomodasi" readonly required>
    </div>
</div>


                <!-- Total Biaya -->
                <div class="mb-3">
                    <label for="total_biaya_{{ $index }}" class="form-label">Total Biaya: (Rp.)</label>
                    <input type="text" id="total_biaya_{{ $index }}" name="total_biaya[]" class="form-control totalKwitansi" readonly required>
                </div>
            </div>
            @endforeach

            <!-- Simpan -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-danger m-2">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function calculateTotal(index) {
            var uang_hari = parseFloat(document.getElementById('uang_hari_' + index).value) || 0;
            var lama_perjalanan = parseFloat(document.getElementById('lama_perjalanan_' + index).value) || 0;
            var total_harian = uang_hari * lama_perjalanan;
            document.getElementById('total_harian_' + index).value = total_harian;

            calculateOverallTotal(index);
        }

        function calculateTransport(index) {
            var transport = parseFloat(document.getElementById('transport_' + index).value) || 0;
            var biayaTransport = parseFloat(document.getElementById('biayaTransport_' + index).value) || 0;
            var totalTransport = transport * biayaTransport;
            document.getElementById('totalTransport_' + index).value = totalTransport;

            calculateOverallTotal(index);
        }

        function calculateAkomodasi(index) {
            var akomodasi = parseFloat(document.getElementById('akomodasi_' + index).value) || 0;
            var lamaAkomodasi = parseFloat(document.getElementById('lamaAkomodasi_' + index).value) || 0;
            var totalAkomodasi = akomodasi * lamaAkomodasi;
            document.getElementById('totalAkomodasi_' + index).value = totalAkomodasi;

            calculateOverallTotal(index);
        }

        function calculateOverallTotal(index) {
            var total_harian = parseFloat(document.getElementById('total_harian_' + index).value) || 0;
            var totalTransport = parseFloat(document.getElementById('totalTransport_' + index).value) || 0;
            var totalAkomodasi = parseFloat(document.getElementById('totalAkomodasi_' + index).value) || 0;

            var totalKwitansi = total_harian + totalTransport + totalAkomodasi;
            document.getElementById('total_biaya_' + index).value = totalKwitansi;
        }
    </script>
@endsection

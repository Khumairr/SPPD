@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold">Edit Detail Riwayat</h2>
    </div>

    <form action="{{ route('updatedetailriwayat', ['no_kwitansi' => $details->first()->no_kwitansi]) }}" method="POST">
        @csrf
        
        <!-- Main Kwitansi Details -->
        <div class="card shadow-sm p-4 mb-4">

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="no_kwitansi" class="font-weight-bold">No Kwitansi:</label>
                    <input type="text" id="no_kwitansi" name="no_kwitansi" class="form-control" value="{{ $details->first()->no_kwitansi }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="laporan" class="font-weight-bold">Perihal Laporan:</label>
                    <textarea id="laporan" name="laporan" class="form-control" rows="3" required>{{ $details->first()->laporan }}</textarea>
                </div>
            </div>
        </div>

        <!-- Employee Sections -->
        @foreach ($details as $detail)
            <div class="card shadow-sm p-4 mb-4">
                <h5>Pegawai {{ $loop->iteration }}</h5>
                <hr class="mb-4">
                
                <input type="hidden" name="id_tr_sppd_pegawai[]" value="{{ $detail->id_tr_sppd_pegawai }}">
                
                <!-- Employee Info -->
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <p><strong>NIP:</strong> {{ $detail->nip }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nama Pegawai:</strong> {{ $detail->nama_staff }}</p>
                    </div>
                </div>

                <!-- Uang Harian & Total Calculation -->
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="uang_hari_{{ $loop->iteration }}" class="font-weight-bold">Uang Harian (Rp.):</label>
                        <input type="text" id="uang_hari_{{ $loop->iteration }}" name="uang_hari[]" class="form-control" value="{{ $detail->uang_hari }}" oninput="calculateTotals(this)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lama_perjalanan_{{ $loop->iteration }}" class="font-weight-bold">Lama Perjalanan:</label>
                        <input type="text" id="lama_perjalanan_{{ $loop->iteration }}" name="lama_perjalanan[]" class="form-control" value="{{ $detail->lama_perjalanan }}" oninput="calculateTotals(this)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Total Harian (Rp.):</label>
                        <input type="text" name="total_harian[]" class="form-control total_harian" value="{{ $detail->total_harian }}" readonly>
                    </div>
                </div>

                <!-- Uang Transport & Total Calculation -->
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="uang_transport_{{ $loop->iteration }}" class="font-weight-bold">Transport (Rp.):</label>
                        <input type="text" id="uang_transport_{{ $loop->iteration }}" name="uang_transport[]" class="form-control" value="{{ $detail->uang_transport }}" oninput="calculateTotals(this)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="biaya_transport_{{ $loop->iteration }}" class="font-weight-bold">Biaya Transport:</label>
                        <input type="text" id="biaya_transport_{{ $loop->iteration }}" name="biaya_transport[]" class="form-control" value="{{ $detail->biaya_transport }}" oninput="calculateTotals(this)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Total Transport (Rp.):</label>
                        <input type="text" name="total_transport[]" class="form-control total_transport" value="{{ $detail->total_transport }}" readonly>
                    </div>
                </div>

                <!-- Uang Akomodasi & Total Calculation -->
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="uang_akomodasi_{{ $loop->iteration }}" class="font-weight-bold">Akomodasi (Rp.):</label>
                        <input type="text" id="uang_akomodasi_{{ $loop->iteration }}" name="uang_akomodasi[]" class="form-control" value="{{ $detail->uang_akomodasi }}" oninput="calculateTotals(this)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lama_akomodasi_{{ $loop->iteration }}" class="font-weight-bold">Lama Akomodasi:</label>
                        <input type="text" id="lama_akomodasi_{{ $loop->iteration }}" name="lama_akomodasi[]" class="form-control" value="{{ $detail->lama_akomodasi }}" oninput="calculateTotals(this)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Total Akomodasi (Rp.):</label>
                        <input type="text" name="total_akomodasi[]" class="form-control total_akomodasi" value="{{ $detail->total_akomodasi }}" readonly>
                    </div>
                </div>

                <!-- Total Kwitansi -->
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Total Kwitansi (Rp.):</label>
                        <input type="number" name="total_kwitansi[]" class="form-control total_kwitansi" value="{{ $detail->total_kwitansi }}" readonly>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
        </div>
    </form>
    <br>
</div>

<script>
    function calculateTotals(element) {
        const parent = element.closest('.card');

        // Calculate Total Harian
        const uangHari = parseFloat(parent.querySelector('input[name="uang_hari[]"]').value) || 0;
        const lamaPerjalanan = parseFloat(parent.querySelector('input[name="lama_perjalanan[]"]').value) || 0;
        const totalHarian = uangHari * lamaPerjalanan;
        parent.querySelector('input[name="total_harian[]"]').value = totalHarian;

        // Calculate Total Transport
        const uangTransport = parseFloat(parent.querySelector('input[name="uang_transport[]"]').value) || 0;
        const biayaTransport = parseFloat(parent.querySelector('input[name="biaya_transport[]"]').value) || 0;
        const totalTransport = uangTransport * biayaTransport;
        parent.querySelector('input[name="total_transport[]"]').value = totalTransport;

        // Calculate Total Akomodasi
        const uangAkomodasi = parseFloat(parent.querySelector('input[name="uang_akomodasi[]"]').value) || 0;
        const lamaAkomodasi = parseFloat(parent.querySelector('input[name="lama_akomodasi[]"]').value) || 0;
        const totalAkomodasi = uangAkomodasi * lamaAkomodasi;
        parent.querySelector('input[name="total_akomodasi[]"]').value = totalAkomodasi;

        // Calculate Total Kwitansi
        const totalKwitansi = totalHarian + totalTransport + totalAkomodasi;
        parent.querySelector('input[name="total_kwitansi[]"]').value = totalKwitansi;
    }
</script>
@endsection

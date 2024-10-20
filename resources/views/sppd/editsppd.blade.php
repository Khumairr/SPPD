@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-center text-primary mb-4">Edit SPT</h3>
        <hr class="mb-4">
        
        <form action="{{ route('sppd.update', $sppd->id_sppd) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- No. SPT -->
            <div class="form-floating mb-4">
                <input type="text" id="noSpt" name="no_spt" class="form-control" value="{{ $sppd->no_spt }}" placeholder="No. SPT">
                <label for="noSpt"><i class="fas fa-file-alt me-2"></i>No. SPT</label>
            </div>

            <!-- Tanggal SPT -->
            <div class="form-floating mb-4">
                <input type="date" id="tgl_spt" name="tgl_spt" class="form-control" value="{{ $sppd->tgl_spt }}" placeholder="Tanggal SPT">
                <label for="tgl_spt"><i class="fas fa-calendar-alt me-2"></i>Tanggal SPT</label>
            </div>

            <!-- Perihal -->
            <div class="form-floating mb-4">
                <textarea id="perihal" name="perihal" class="form-control" placeholder="Perihal" style="height: 100px">{{ $sppd->perihal_sppd }}</textarea>
                <label for="perihal"><i class="fas fa-info-circle me-2"></i>Perihal</label>
            </div>

            <!-- Angkutan and Tujuan -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-floating">
                        <div class="form-group">
                            <h6 class="text-muted mb-3">Angkutan</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="angkutan" value="Darat" {{ $sppd->angkutan == 'Darat' ? 'checked' : '' }}>
                                <label class="form-check-label" for="angkutanDarat"><i class="fas fa-car me-1"></i>Darat</label>
                            </div>
                            <div class="form-check form-check-inline ms-4">
                                <input class="form-check-input" type="radio" name="angkutan" value="Udara" {{ $sppd->angkutan == 'Udara' ? 'checked' : '' }}>
                                <label class="form-check-label" for="angkutanUdara"><i class="fas fa-plane-departure me-1"></i>Udara</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <select id="tujuan" name="tujuan" class="form-select">
                            @foreach($kantorList as $kantor)
                                <option value="{{ $kantor->nama_kantor }}" {{ $sppd->tujuan == $kantor->nama_kantor ? 'selected' : '' }}>
                                    {{ $kantor->nama_kantor }}
                                </option>
                            @endforeach
                        </select>
                        <label for="tujuan"><i class="fas fa-map-marker-alt me-2"></i>Tujuan</label>
                    </div>
                </div>
            </div>

            <!-- Tanggal Berangkat, Tanggal Kembali, and Lama Perjalanan -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="date" id="tgl_berangkat" name="tgl_berangkat" class="form-control" value="{{ $sppd->tgl_berangkat }}" placeholder="Tanggal Berangkat">
                        <label for="tgl_berangkat"><i class="fas fa-calendar-day me-2"></i>Tanggal Berangkat</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="date" id="tgl_kembali" name="tgl_kembali" class="form-control" value="{{ $sppd->tgl_kembali }}" placeholder="Tanggal Kembali">
                        <label for="tgl_kembali"><i class="fas fa-calendar-check me-2"></i>Tanggal Kembali</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" id="lama_perjalanan" name="lama_perjalanan" class="form-control" value="{{ $sppd->lama_perjalanan }}" readonly placeholder="Lama Perjalanan">
                        <label for="lama_perjalanan"><i class="fas fa-hourglass-half me-2"></i>Lama Perjalanan (Hari)</label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary shadow-sm"><i class="fas fa-save me-2"></i>Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function calculateLamaPerjalanan() {
        const tglBerangkat = new Date(document.getElementById('tgl_berangkat').value);
        const tglKembali = new Date(document.getElementById('tgl_kembali').value);

        if (!isNaN(tglBerangkat.getTime()) && !isNaN(tglKembali.getTime())) {
            const diffTime = Math.abs(tglKembali - tglBerangkat);
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            diffDays = diffDays === 0 ? 1 : diffDays;
            document.getElementById('lama_perjalanan').value = `${diffDays} hari`;
        }
    }

    document.getElementById('tgl_berangkat').addEventListener('change', calculateLamaPerjalanan);
    document.getElementById('tgl_kembali').addEventListener('change', calculateLamaPerjalanan);
</script>

@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">Formulir SPD</h3>
                </div>
                <div class="card-body">
                    <!-- Form for number of employees input -->
                    <div class="form-group">
                        <label for="jumlah_pegawai" class="form-label">Jumlah Pegawai:</label>
                        <input type="number" id="jumlah_pegawai" class="form-control" placeholder="Masukkan jumlah pegawai" min="1">
                        <button type="button" class="btn btn-success mt-3" onclick="generateForms()">Submit</button>
                    </div>

                    <form action="{{ route('storeSPPD') }}" method="POST" class="mt-4">
                        @csrf
                        <div id="pegawai_forms"></div>

                        <!-- Section SPT -->
                        <h5 class="mt-4">Informasi SPT</h5>
                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="no_spt">No. SPT:</label>
                                    <input type="text" name="no_spt" id="no_spt" class="form-control" required autocomplete='off'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal_spt">Tanggal SPT:</label>
                                    <input type="date" name="tanggal_spt" id="tanggal_spt" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="ppk">PPK:</label>
                                    <select name="ppk" id="ppk" class="form-control" required>
                                        @foreach($karyawans as $karyawan)
                                            @if($karyawan->id_staff == 1)
                                                <option value="{{ $karyawan->nama_staff }}">{{ $karyawan->nama_staff }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="perihal">Perihal:</label>
                                    <textarea name="perihal" id="perihal" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="angkutan">Angkutan:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="angkutan" id="angkutan_darat" value="Darat" required>
                                <label class="form-check-label" for="angkutan_darat">Darat</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="angkutan" id="angkutan_udara" value="Udara" required>
                                <label class="form-check-label" for="angkutan_udara">Udara</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tujuan">Tujuan:</label>
                            <select name="tujuan" id="tujuan" class="form-control" required>
                                @foreach($kantors as $kantor)
                                    <option value="{{ $kantor->nama_kantor }}">{{ $kantor->nama_kantor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tgl_berangkat">Tgl Berangkat:</label>
                                    <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tgl_kembali">Tgl Kembali:</label>
                                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="lama_perjalanan">Lama Perjalanan:</label>
                            <input type="text" name="lama_perjalanan" id="lama_perjalanan" class="form-control" required readonly >
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function generateForms() {
        const jumlahPegawai = document.getElementById('jumlah_pegawai').value;
        const pegawaiForms = document.getElementById('pegawai_forms');
        pegawaiForms.innerHTML = '';

        for (let i = 1; i <= jumlahPegawai; i++) {
            const form = `
                <div class="pegawai-section mb-4">
                    <h5>Pegawai ${i}:</h5>
                    <button type="button" class="btn btn-danger btn-sm mb-2" onclick="this.parentElement.remove()">Remove</button>
                    <div class="form-group mb-3">
                        <label for="nama_staff_${i}">Nama Staff:</label>
                        <select name="nama_staff[]" id="nama_staff_${i}" class="form-control" required onchange="getKaryawanData(${i}, this.value)">
                            <option value="">-- Pilih Nama --</option>
                            @foreach($karyawans as $karyawan)
                                <option value="{{ $karyawan->nama_staff }}">{{ $karyawan->nama_staff }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group mb-3">
                            <label for="nip_${i}">NIP:</label>
                            <input type="text" name="nip_${i}" id="nip_${i}" class="form-control" readonly required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="golongan_${i}">Golongan:</label>
                            <input type="text" name="golongan_${i}" id="golongan_${i}" class="form-control" readonly required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jabatan_${i}">Jabatan:</label>
                            <input type="text" name="jabatan_${i}" id="jabatan_${i}" class="form-control" readonly required>
                        </div>
                    </div>
                <hr class="border-secondary">
            `;
            pegawaiForms.innerHTML += form;
        }
    }

    function getKaryawanData(index, nama_staff) {
        if (nama_staff) {
            fetch(`/get-karyawan/${nama_staff}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById(`nip_${index}`).value = data.nip;
                        document.getElementById(`golongan_${index}`).value = data.golongan;
                        document.getElementById(`jabatan_${index}`).value = data.jabatan;
                    } else {
                        alert('Data karyawan tidak ditemukan!');
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById(`nip_${index}`).value = '';
            document.getElementById(`golongan_${index}`).value = '';
            document.getElementById(`jabatan_${index}`).value = '';
        }
    }

    // Calculate lama perjalanan
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

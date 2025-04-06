@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('riwayat.riwayatsppd') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
    </div>

    <!-- Page Title -->
    <h3 class="text-center text-uppercase font-weight-bold" style="letter-spacing: 2px; color: #333;">Upload SPJ</h3>
    <hr class="mb-5" style="border-top: 3px solid #8B4513; width: 50%; margin: 0 auto;">

    <!-- Upload Form -->
    <form action="{{ route('spj.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <input type="hidden" name="no_kwitansi" value="{{ $no_kwitansi }}" readonly>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 20px;">
                    <div class="card-body p-4 bg-light">
                        @php
                            $files = [
                                ['name' => 'SPT', 'file' => 'file_spt'],
                                ['name' => 'SPD', 'file' => 'file_spd'],
                                ['name' => 'Visum', 'file' => 'file_visum'],
                                ['name' => 'Laporan', 'file' => 'file_laporan'],
                                ['name' => 'Kwitansi', 'file' => 'file_kwitansi'],
                                ['name' => 'Foto', 'file' => 'file_poto', 'accept' => '.jpg,.jpeg,.png'],
                                ['name' => 'Nota Bensin', 'file' => 'file_notabensin'],
                            ];
                        @endphp

                        @foreach($files as $file)
                        <div class="form-group row align-items-center mb-4">
                            <label class="col-md-4 font-weight-bold text-dark">{{ $file['name'] }}:</label>
                            <div class="col-md-8 d-flex align-items-center">
                                <input type="file" name="{{ $file['file'] }}" 
                                       class="form-control border-0 shadow-sm" 
                                       accept="{{ $file['accept'] ?? '.pdf' }}" 
                                       style="padding: 12px; width: 100%;"
                                       @if(!$spj || !$spj->{$file['file']}) required @endif>

                                @if($spj && $spj->{$file['file']})
                                    <a href="{{ Storage::url($spj->{$file['file']}) }}" 
                                       class="btn btn-success btn-sm ml-3 shadow-sm" 
                                       style="border-radius: 50px; padding: 8px 16px;" 
                                       download>
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm ml-3 shadow-sm" 
                                            style="border-radius: 50px; padding: 8px 16px;" 
                                            disabled>
                                        <img src="{{ asset('img/folder.png') }}" alt="Folder Icon" 
                                             style="width: 16px; height: 16px; margin-right: 5px; vertical-align: middle;">
                                        Download
                                    </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 py-2" style="background-color: #8B4513; border-radius: 50px; font-size: 18px; letter-spacing: 1px;">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@extends('adminutama.navbar.admin')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-md-6">
        <h2 class="text-center">FORM TAMBAH DATA USER</h2>
        <hr>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tambahdatauser') }}" method="POST">
            @csrf
            <div class="form-group">
                <label><i class="fa fa-user"></i> Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autocomplete='off'>
            </div>
            <div class="form-group">
                <label><i class="fa fa-key"></i> Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label><i class="fa fa-users"></i> Nama Tim Kerja</label>
                <select name="nama_tim" id="nama_tim" class="form-control" required>
                    @foreach($tim_kerja as $tim)
                        <option value="{{ $tim->id_tim_kerja }}">{{ $tim->nama_tim }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label><i class="fa fa-user-tag"></i> Nama Role</label>
                <select name="nama_role" id="nama_role" class="form-control" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i> Tambah</button>
        </form>

        <!-- Back Button Centered -->
        <div class="text-center mt-3">
            <a href="{{ route('adminutama.datauser') }}" class="btn btn-secondary">
                <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
                Back
            </a>
        </div>

        <hr>
    </div>
</div>
@endsection

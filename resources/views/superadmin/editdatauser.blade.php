@extends('layouts.app')

@section('content')
<div class="mt-3">
    <h2 class="text-center">Edit Data User</h2>
    <form action="{{ route('updateDataUser', $user->id_user) }}" method="POST">
    @csrf
    @method('PUT') <!-- Menggunakan PUT untuk update data -->
    
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
    </div>
    <div class="form-group">
        <label for="nama_tim">Tim Kerja:</label>
        <select name="nama_tim" id="nama_tim" class="form-control" required>
            @foreach($tim_kerja as $tim)
                <option value="{{ $tim->id_tim_kerja }}" {{ $user->nama_tim == $tim->id_tim_kerja ? 'selected' : '' }}>
                    {{ $tim->nama_tim }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="role">Role:</label>
        <select name="nama_role" id="nama_role" class="form-control" required>
            @if($roles->isEmpty())
                <option value="">No roles available</option>
            @else
                @foreach($roles as $role)
                    <option value="{{ $role->id_role }}" {{ $user->nama_role == $role->id_role ? 'selected' : '' }}>
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
    
    <!-- Tambahkan bagian untuk edit password -->
    <div class="form-group">
        <label for="password">Password (Kosongkan jika tidak ingin diubah):</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    
    <br>
    <button type="submit" class="btn btn-primary mr-5">Simpan</button> 
    <a href="{{ route('datauser') }}" class="btn btn-secondary">
        <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
        Back
    </a>
</form>
</div>
@endsection

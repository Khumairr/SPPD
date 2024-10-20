@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Tombol Back di Pojok Kiri Atas -->
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
        <h3 class="text-center flex-grow-1">Data User</h3>
    </div>
    
    <hr class="border-2 mb-4" style="border-top: 2px solid #007bff;">
    
    <a href="{{ route('adddatauser') }}" class="btn btn-secondary mb-3">+ Tambah User</a>
    
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>ID Tim Kerja</th>
                <th>ID Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->nama_tim }}</td>
                <td>{{ $user->nama_role }}</td>
                <td>
                    <a href="{{ route('editdatauser', $user->id_user) }}" class="btn btn-secondary text-white" style="transition: 0.3s;">EDIT</a> |
                    <form action="{{ route('deleteuser', $user->id_user) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white" style="transition: 0.3s;" onclick="return confirm('Are you sure you want to delete this user?')">HAPUS</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

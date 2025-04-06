<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPD Admin Dashboard</title>
    <link rel="icon" href="{{ asset('img/logoutama.png') }}" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Sidebar Styles */
        .sidebar {
            background-color: #ffc107;
            min-height: 100vh;
            width: 250px;
            padding: 20px 10px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            width: 60px;
        }
        .sidebar .logo h5 {
            font-weight: bold;
            margin-top: 10px;
            color: #000;
        }
        .sidebar .nav-link {
            color: #333;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px 15px;
            text-align: center;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #ffd966;
            color: #000;
            text-decoration: none;
        }
        .sidebar .nav-link.active {
            background-color: #ffa000;
            color: #fff;
        }

        /* Topbar Styles */
        .topbar {
            background-color: #343a40;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .topbar h5 {
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Content Styles */
        .content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column align-items-center">
        <div class="logo">
            <img src="{{ asset('img/logoutama.png') }}" alt="Logo">
            <h5>SPPD</h5>
            <hr class="border-2" style="border-top: 2px solid;">
        </div>
        <a href="{{ route('adminutama.datauser') }}" class="nav-link {{ request()->routeIs('adminutama.datauser') ? 'active' : '' }}">Data User</a>
        <a href="{{ route('adminutama.datatimkerja') }}" class="nav-link {{ request()->routeIs('adminutama.datatimkerja') ? 'active' : '' }}">Data Tim Kerja</a>
        <a href="{{ route('adminutama.datakantor') }}" class="nav-link {{ request()->routeIs('adminutama.datakantor') ? 'active' : '' }}">Data Kantor</a>
        <a href="{{ route('adminutama.datapegawai') }}" class="nav-link {{ request()->routeIs('adminutama.datapegawai') ? 'active' : '' }}">Data Pegawai</a>
    </div>

    <!-- Content Area -->
    <div class="flex-grow-1">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between">
            <h5>Admin Dashboard</h5>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

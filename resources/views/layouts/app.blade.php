<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPD</title>
    <link rel="icon" href="{{ asset('img/logoutama.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .bg-custom-aqua {
            background-color: #abdbe3 !important;
        }

        .sidebar {
            height: 100vh;
            background-color: #e2f0f0;
            position: fixed;
            transition: all 0.3s;
            border-right: 2px solid #007bff;
        }

        .sidebar .nav-link {
            margin-bottom: 15px;
            border-radius: 10px;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: #87d7ea;
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        .sidebar h4 {
            font-weight: bold;
            color: #333;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #4CAF50;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                height: auto;
                border-right: none;
            }

            .sidebar .nav-link {
                text-align: center;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body class="bg-light text-dark">
    <div class="container-fluid">
        <div class="row">
            @if (Request::path() !== 'login' && Request::path() !== 'register') 
            <!-- Sidebar -->
            <div class="col-md-2 d-flex flex-column justify-content-between sidebar">
                <div>
                    <div class="text-center mt-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('img/logoutama.png') }}" alt="Logo Tanggerang" style="width: 50px; height: auto;" class="mr-2">
                        <h4 class="ml-1 mt-1 mb-1">SPPD</h4>
                    </div>          
                    <hr class="border-2" style="border-top: 2px solid;">
                    <ul class="nav flex-column mt-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'text-dark' }}" href="{{ route('dashboard') }}">
                                <img src="{{ asset('img/dashboard.png') }}" alt="Dashboard Icon" style="width: 24px; height: auto; margin-right: 8px;">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('inputSPPD') ? 'active' : 'text-dark' }}" href="{{ route('inputSPPD') }}">
                                <img src="{{ asset('img/typing.png') }}" alt="Input SPPD Icon" style="width: 24px; height: auto; margin-right: 8px;">
                                Input SPPD
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('sppd.index') ? 'active' : 'text-dark' }}" href="{{ route('sppd.index') }}">
                                <img src="{{ asset('img/activities.png') }}" alt="SPPD Aktif Icon" style="width: 24px; height: auto; margin-right: 8px;">
                                SPPD Aktif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('riwayat-sppd') ? 'active' : 'text-dark' }}" href="{{ route('riwayat.riwayatsppd') }}">
                                <img src="{{ asset('img/file.png') }}" alt="Riwayat SPPD Icon" style="width: 24px; height: auto; margin-right: 8px;">
                                Riwayat SPPD
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mb-4 text-center">
                    <label class="switch">
                        <input type="checkbox" id="toggle-aqua-mode">
                        <span class="slider round"></span>
                    </label>
                    <br>
                    <hr class="border-2" style="border-top: 2px solid;">
                    <a class="btn btn-dark mt-3" href="{{ route('actionlogout') }}">Log Out</a>
                </div>
            </div>
            @endif

            <div class="@if(Request::path() !== 'login' && Request::path() !== 'register') col-md-10 offset-md-2 @else col-md-12 @endif">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            const toggleAquaMode = document.getElementById('toggle-aqua-mode');
            console.log("Page loaded, Aqua Mode script running...");

            if (localStorage.getItem('aqua-mode') === 'enabled') {
                toggleAquaMode.checked = true;
                document.body.classList.add('bg-custom-aqua', 'text-dark');
                console.log("Aqua Mode enabled.");
            }

            let totalKeseluruhan = 0;
            const totalKwitansiFields = document.querySelectorAll('.total_kwitansi');

            totalKwitansiFields.forEach(function(input) {
                totalKeseluruhan += parseFloat(input.value) || 0;
            });

            document.getElementById('total_keseluruhan').value = Math.round(totalKeseluruhan);
        };

        const toggleAquaMode = document.getElementById('toggle-aqua-mode');
        toggleAquaMode.addEventListener('change', function() {
            document.body.classList.toggle('bg-light');
            document.body.classList.toggle('bg-custom-aqua');

            const isAquaEnabled = document.body.classList.contains('bg-custom-aqua');

            if (isAquaEnabled) {
                localStorage.setItem('aqua-mode', 'enabled');
                console.log("Aqua Mode preference saved.");
            } else {
                localStorage.setItem('aqua-mode', 'disabled');
                console.log("Aqua Mode preference cleared.");
            }
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>

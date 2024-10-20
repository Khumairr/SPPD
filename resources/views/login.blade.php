<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SPPD</title>
    <link rel="icon" href="{{ asset('img/logoutama.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('img/blue.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .login-card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header img {
            width: 50px;
            height: 50px;
        }

        .alert-dismissible .btn-close {
            padding: 0.5rem;
        }

        .footer-text {
            margin-top: 1.5rem;
            font-size: 0.8rem;
        }
    </style>
</head>

<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card login-card">
                    <div class="card-body">
                        <div class="login-header">
                            <img src="{{ asset('img/logoutama.png') }}" alt="Logo" class="me-2">
                            <h3>Login</h3>
                        </div>

                        <!-- Error Alert -->
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ route('actionlogin') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label"><strong>Username</strong></label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required autocomplete='off'>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><strong>Password</strong></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            </div><br>
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

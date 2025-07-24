<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - SIAKAD Pesantren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://source.unsplash.com/1920x1080/?islamic,mosque') no-repeat center center fixed;
            background-size: cover;
        }
        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-header img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<div class="overlay">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-dark text-white">
                <img src="uploads/logo.jpg" alt="Logo Pesantren">
                <h4 class="mb-0">SIAKAD Pesantren</h4>
                <small>Login Admin</small>
            </div>
            <div class="card-body p-4">

                {{-- Form Login --}}
                <form action="{{ route('login.admin') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="text"
                               class="form-control @error('username') is-invalid @enderror"
                               name="username" value="{{ old('username') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-link mt-3 w-100">
                        ← Kembali ke Beranda
                    </a>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>

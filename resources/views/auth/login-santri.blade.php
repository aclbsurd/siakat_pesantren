<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Santri - SIAKAD Pesantren</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-dark text-white">
                <h4 class="mb-0">SIAKAD Pesantren</h4>
                <small>Login Santri</small>
            </div>
            <div class="card-body p-4">

                {{-- Pesan sukses & error dari session --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- FORM LOGIN --}}
                <form method="POST" action="{{ route('login.santri.post') }}">
    @csrf

    <div class="mb-3">
        <label for="username" class="form-label">NIS</label>
        <input type="text" name="username" id="username"
               class="form-control @error('username') is-invalid @enderror"
               value="{{ old('username') }}" required autofocus>
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password"
               class="form-control @error('password') is-invalid @enderror"
               required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-success">Masuk</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>

</body>
</html>

@extends('layouts.app')

@section('content')
<style>
    .card-modern { border: none !important; border-radius: 16px !important; box-shadow: 0 10px 30px rgba(30, 58, 138, 0.08) !important; overflow: hidden; background: #fff; }
    .header-modern { background: linear-gradient(135deg, #1e3a8a, #3b82f6); padding: 25px; text-align: center; color: white; }
    .header-modern h4 { font-weight: 700; margin: 0; letter-spacing: 1px; font-size: 1.25rem; }
    .form-control { border-radius: 8px !important; padding: 10px 15px !important; border: 1px solid #cbd5e1 !important; }
    .btn-modern { background: linear-gradient(135deg, #1e3a8a, #3b82f6) !important; color: white !important; font-weight: 600 !important; border: none !important; border-radius: 8px !important; transition: all 0.2s ease !important; }
    .btn-modern:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3) !important; }
    .link-modern { color: #3b82f6 !important; font-weight: 600; text-decoration: none; }
</style>

@section('content')
<div class="container pt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-modern">
                <div class="header-modern">
                    <h4>DAFTAR AKUN BARU</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="name" class="form-label small fw-bold" style="color: #1e3a8a;">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama lengkap">
                            @error('name')
                                <small class="text-danger d-block mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold" style="color: #1e3a8a;">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com">
                            @error('email')
                                <small class="text-danger d-block mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <!-- Kata Sandi -->
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold" style="color: #1e3a8a;">Kata Sandi</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                            @error('password')
                                <small class="text-danger d-block mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <!-- Konfirmasi Kata Sandi -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label small fw-bold" style="color: #1e3a8a;">Konfirmasi Kata Sandi</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi">
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-modern w-100 py-2.5">
                            DAFTAR AKUN
                        </button>
                    </form>

                    <!-- Navigasi Kembali ke Login -->
                    <div class="text-center mt-4 pt-3 border-top" style="border-color: #f1f5f9 !important;">
                        <small class="text-muted">
                            Sudah punya akun? <a href="{{ route('login') }}" class="link-modern">Masuk di sini</a>
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
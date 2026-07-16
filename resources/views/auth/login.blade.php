@extends('layouts.app')

@section('content')
<style>
    body { background-color: #f8fafc !important;}  
    .card-modern { border: none !important; border-radius: 16px !important; box-shadow: 0 10px 30px rgba(30, 58, 138, 0.08) !important; overflow: hidden; background: #ffffff; }
    .header-modern { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);padding: 25px;text-align: center;color: white;}
    .header-modern h4 { font-weight: 700;margin: 0;letter-spacing: 1px;font-size: 1.25rem; }
    .form-control { border-radius: 8px !important; padding: 10px 15px !important; border: 1px solid #cbd5e1 !important;}
    .form-control:focus { border-color: #3b82f6 !important; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;}
    .btn-modern { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%) !important; color: white !important; font-weight: 600 !important; border: none !important; border-radius: 8px !important;transition: all 0.2s ease !important;}
    .btn-modern:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3) !important; opacity: 0.95;}
    .link-modern { color: #3b82f6 !important;font-weight: 600;text-decoration: none;}
    .link-modern:hover { text-decoration: underline;}
</style>

<div class="container pt-5">
    <div class="row justify-content-center mt-4">
        <div class="col-md-5">
            <div class="card card-modern">
                <div class="header-modern">
                    <h4>MASUK KE MADING</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Kolom Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold" style="color: #1e3a8a;">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email anda">
                            
                            @error('email')
                                <small class="text-danger d-block mt-1">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <!-- Kolom Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold" style="color: #1e3a8a;">Kata Sandi</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
                            
                            @error('password')
                                <small class="text-danger d-block mt-1">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <!-- Checkbox Remember Me -->
                        <div class="mb-4 form-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="border-color: #cbd5e1; cursor: pointer;">
                            <label class="form-check-label small fw-semibold ms-2" for="remember" style="color: #495057; cursor: pointer; user-select: none;">
                                Ingat Saya
                            </label>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-modern w-100 py-2.5">
                            MASUK
                        </button>
                    </form>

                    <!-- Navigasi ke Daftar -->
                    <div class="text-center mt-4 pt-3 border-top" style="border-color: #f1f5f9 !important;">
                        <small class="text-muted">
                            Belum punya akun? <a href="{{ route('register') }}" class="link-modern">Daftar terlebih dahulu di sini</a>
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

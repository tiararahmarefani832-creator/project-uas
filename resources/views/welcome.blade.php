<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .hero-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 80px 0;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.15);
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        .btn-custom-primary {
            background-color: #ffffff;
            color: #1e3a8a;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .btn-custom-primary:hover {
            background-color: #f1f5f9;
            transform: scale(1.03);
            color: #1d4ed8;
        }
        .btn-custom-outline {
            border: 2px solid #ffffff;
            color: #ffffff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .btn-custom-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: scale(1.03);
        }
    </style>
</head>
<body>

    <!-- Navbar Atas -->
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/posts') }}" class="btn btn-sm btn-custom-primary px-3 py-2">Buka Mading</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-link text-white text-decoration-none fw-semibold me-3">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm btn-custom-primary px-3 py-2">Daftar Akun</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center text-md-start d-flex align-items-center pt-5 mt-4">
        <div class="container pt-5">
            <div class="row align-items-center">
                <div class="col-md-7 mb-4 mb-md-0 pt-3">
                    <span class="badge bg-white text-primary mb-3 fw-bold px-3 py-2" style="border-radius: 20px;">Platform Informasi Kampus</span>
                    <h1 class="display-4 fw-bold mb-3">Mading Digital Kampus, Informasi dalam Genggaman!</h1>
                    <p class="lead text-white-50 mb-4">
                        info akademis terkini, pengumuman penting, agenda seru, dan ruang diskusi interaktif antar mahasiswa dan admin.
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                        <a href="{{ route('posts.index') }}" class="btn btn-custom-primary btn-lg px-4 shadow">
                            Lihat Mading Publik
                        </a>
                        @if (!Auth::check())
                            <a href="{{ route('login') }}" class="btn btn-custom-outline btn-lg px-4">
                                Berikan Komentar
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 text-center d-none d-md-block">
                    <!-- Icon dekoratif menggunakan SVG bawaan browser agar ringan -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-white-50 opacity-75" style="width: 70%; max-width: 300px;">
                        <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-1.5V9a3 3 0 00-3-3h-3V4.5a3 3 0 00-3-3H4.5a3 3 0 00-3 3V18a3 3 0 003 3h15zM6 7.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 4.5a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 12zm.75 3a.75.75 0 000 1.5h10.5a.75.75 0 000-1.5H6.75z" />
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <!-- Tiga Kartu Fitur Unggulan -->
    <main class="container my-5 flex-grow-1">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Mengapa Menggunakan Mading Digital?</h2>
            <p class="text-muted">Fitur utama yang kami sediakan untuk kenyamanan civitas akademik</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4 text-center shadow-sm">
                    <div class="text-primary mb-3 fs-1">📢</div>
                    <h5 class="fw-bold text-dark">Informasi Up-to-Date</h5>
                    <p class="text-muted small mb-0">Dapatkan pengumuman dan berita terbaru seputar kampus langsung dari admin secara real-time.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4 text-center shadow-sm">
                    <div class="text-primary mb-3 fs-1">📂</div>
                    <h5 class="fw-bold text-dark">Filter Kategori Berita</h5>
                    <p class="text-muted small mb-0">Cari informasi jadi lebih mudah lewat sistem kategori otomatis (Pengumuman, Beasiswa, Kegiatan, dll).</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4 text-center shadow-sm">
                    <div class="text-primary mb-3 fs-1">💬</div>
                    <h5 class="fw-bold text-dark">Kolom Komentar Aktif</h5>
                    <p class="text-muted small mb-0">Tanyakan atau diskusikan detail berita langsung di bawah postingan mading bersama mahasiswa lainnya.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Standar Kampus -->
    <footer class="bg-dark text-white-50 text-center py-3 border-top border-secondary">
        <div class="container">
            <p class="small mb-0">&copy; 2026 Mading Digital Kampus. Dibuat untuk Memenuhi Tugas UAS Pengembangan Web.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
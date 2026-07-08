@extends('layouts.app')

@section('content')

<style>
    .hero-banner { background: linear-gradient(135deg, #1e3a8a, #3b82f6); border-radius: 16px !important; }
    .card-mading { border-radius: 16px !important; transition: transform 0.2s; }
    .card-mading:hover { transform: translateY(-4px); }
</style>

<div class="container mt-4">

    <!-- Hero Banner -->
    <div class="p-5 mb-4 text-white hero-banner shadow-sm">
        <div class="container-fluid py-2 text-center text-md-start">
            <h1 class="display-6 fw-bold text-uppercase" style="letter-spacing: 1px;">Mading Digital</h1>
            <p class="col-md-10 fs-6 text-white-50 mb-0 mt-2">Pusat informasi akademis, agenda kegiatan mahasiswa, dan pengumuman penting seputar civitas akademik. Tetap update, jangan sampai ketinggalan info!</p>
        </div>
    </div>

    <!-- Flash Message Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
            🎉 <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter Kategori -->
    <div class="mb-4 p-3 bg-white shadow-sm rounded-3">
        <span class="d-block fw-bold mb-2 text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Filter Kategori:</span>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('posts.index') }}" class="btn {{ !request('category_id') ? 'btn-primary' : 'btn-outline-primary' }} btn-sm px-4 rounded-pill fw-semibold">Semua Berita</a>
            @foreach($categories as $category)
                <a href="{{ route('posts.index', ['category_id' => $category->id]) }}" class="btn {{ request('category_id') == $category->id ? 'btn-primary' : 'btn-outline-primary' }} btn-sm px-4 rounded-pill fw-semibold">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>

    <!-- Judul & Tombol Tambah (Satu Baris) -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h4 class="fw-bold m-0" style="color: #1e293b;">Berita Terbaru</h4>
        </div>
        
        @if(Auth::check() && Auth::user()->isAdmin())
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('posts.create') }}" class="btn btn-success fw-bold px-4 rounded-pill shadow-sm">
                    + Tambah Mading Baru
                </a>
            </div>
        @endif
    </div>

    <!-- Konten Utama -->
    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 card-mading bg-white">
                    @if($post->image)
                        <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="Foto" style="border-top-left-radius: 16px; border-top-right-radius: 16px; height: 180px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column p-4">
                        <span class="badge bg-warning text-dark align-self-start mb-2 fw-bold px-2 py-1 rounded-2">{{ $post->category->name ?? 'Umum' }}</span>
                        <h5 class="card-title fw-bold text-dark mb-2">{{ $post->title }}</h5>
                        <p class="card-text text-muted small mb-4">{{ Str::limit($post->description, 90, '...') }}</p>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm px-3 fw-semibold rounded-2">Baca Lengkap</a>
                            
                            <!-- Aksi Admin -->
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <div class="d-flex gap-1">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-warning text-dark fw-bold px-2 rounded-2">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="m-0">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-bold px-2 rounded-2">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center border-0 shadow-sm rounded-3">Belum ada mading di kategori ini.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection
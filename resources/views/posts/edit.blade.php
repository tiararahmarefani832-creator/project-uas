@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold m-0">Edit Postingan</h4>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm px-3">Batal</a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted">Judul Postingan</label>
                            <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted">Isi Konten</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required>{{ old('content', $post->description) }}</textarea>
                        </div>

                        <div class="row g-4"> <!-- g-4 memberi jarak antar kolom -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}" {{ $post->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Foto Baru (Opsional)</label>
                                <input type="file" name="image" class="form-control">
                                <small class="text-muted d-block mt-2">Foto saat ini: <strong>{{ $post->image ?? 'Tidak ada' }}</strong></small>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-warning w-100 fw-bold py-2 rounded-3 shadow-sm text-white">Update Postingan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
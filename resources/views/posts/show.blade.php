@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm mb-3">← Kembali</a>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <span class="badge bg-warning text-dark align-self-start mb-3 px-3 py-2 rounded-pill">{{ $post->category->name ?? 'Umum' }}</span>
                <h2 class="fw-bold text-dark mb-2">{{ $post->title }}</h2>
                <small class="text-muted d-block mb-4">👤 Admin | 📅 {{ $post->created_at->format('d M Y, H:i') }} WIB</small>
                
                @if($post->image)
                    <img src="{{ asset('images/' . $post->image) }}" class="img-fluid rounded-4 mb-4 shadow-sm">
                @endif
                
                <div class="post-content text-secondary lh-lg" style="white-space: pre-line;">{{ $post->description }}</div>
            </div>

            <!-- Kolom Komentar -->
            <div class="card shadow-sm border-0 rounded-4 mt-4 p-4">
                <h5 class="fw-bold mb-3">Kolom Komentar</h5>
                <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mb-4">
                    @csrf
                    <textarea name="content" class="form-control mb-2 @error('content') is-invalid @enderror" rows="3" placeholder="Tulis tanggapan..." required></textarea>
                    <button type="submit" class="btn btn-primary px-4 rounded-pill btn-sm">Kirim Komentar</button>
                </form>

                <div class="comments-list">
                    @forelse($post->comment as $c)
                        <div class="p-3 bg-light rounded-3 mb-2 border-start border-primary border-3">
                            <div class="d-flex justify-content-between">
                                <strong class="text-primary small">{{ $c->user->name }}</strong>
                                <small class="text-muted" style="font-size: 10px;">{{ $c->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="text-secondary small">{{ $c->content }}</div>
                        </div>
                    @empty
                        <p class="text-center text-muted small py-2">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
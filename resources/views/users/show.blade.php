@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Profil</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-3 font-weight-bold text-secondary">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <h5>{{ $user->name }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-3 font-weight-bold text-secondary">Alamat Email</label>
                        <div class="col-sm-9">
                            <p class="lead">{{ $user->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-3 font-weight-bold text-secondary">Hak Akses / Role</label>
                        <div class="col-sm-9">
                            <span class="badge bg-success text-capitalize fs-6">
                                {{ $user->role->name ?? 'Mahasiswa' }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-3 font-weight-bold text-secondary">Terdaftar Sejak</label>
                        <div class="col-sm-9">
                            <p class="text-muted">{{ $user->created_at->format('d F Y (H:i)') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
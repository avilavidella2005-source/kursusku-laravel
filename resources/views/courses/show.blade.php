@extends('layouts.app')

@section('title', 'Detail Kursus')

@section('content')
<div class="container py-4" style="max-width: 800px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1">Detail Kursus</h1>
            <p class="text-muted mb-0">{{ $course->code }} - {{ $course->name }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <dl class="row mb-0">
                <dt class="col-sm-3">Kode</dt>
                <dd class="col-sm-9 fw-bold">{{ $course->code }}</dd>

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $course->name }}</dd>

                <dt class="col-sm-3">Deskripsi</dt>
                <dd class="col-sm-9">{{ $course->description ?: '-' }}</dd>

                <dt class="col-sm-3">Biaya</dt>
                <dd class="col-sm-9">Rp {{ number_format($course->fee, 0, ',', '.') }}</dd>

                <dt class="col-sm-3">Kuota</dt>
                <dd class="col-sm-9">{{ $course->quota }} peserta</dd>

                <dt class="col-sm-3">Tanggal Mulai</dt>
                <dd class="col-sm-9">{{ $course->start_date->format('d-m-Y') }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge {{ $course->status == 'open' ? 'bg-success' : ($course->status == 'closed' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </dd>
            </dl>
        </div>
    </div>
</div>
@endsection
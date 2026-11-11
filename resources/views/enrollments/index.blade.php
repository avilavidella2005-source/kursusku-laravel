@extends('layouts.app')

@section('title', 'Laporan Enrollment')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Laporan Enrollment KursusKu</h1>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary shadow-sm">+ Tambah Enrollment</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3 px-3">Participant</th>
                        <th class="py-3 px-3">Course</th>
                        <th class="py-3 px-3">Start Date</th>
                        <th class="py-3 px-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enrollments as $enrollment)
                        <tr>
                            <td class="px-3">{{ $enrollment->participant->name }}</td>
                            <td class="px-3">{{ $enrollment->course->name }}</td>
                            <td class="px-3">{{ $enrollment->course->start_date->format('d-m-Y') }}</td>
                            <td class="px-3">{{ ucfirst($enrollment->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada enrollment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
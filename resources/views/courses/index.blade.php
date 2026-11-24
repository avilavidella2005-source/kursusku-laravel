@extends('layouts.app')

@section('title', 'Daftar Kursus')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1">Daftar Kursus</h1>
            <p class="text-muted mb-0">Data diambil dari MySQL melalui Eloquent.</p>
        </div>
        <a href="{{ route('courses.create') }}" class="btn btn-primary shadow-sm">+ Tambah Kursus</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ===== FORM SEARCH & FILTER ===== --}}
    <form method="GET" action="{{ route('courses.index') }}" class="row g-2 mb-3" id="filter-form">
        <div class="col-md-6">
            {{-- Tambahan ID: live-search --}}
            <input type="search" name="q" id="live-search" value="{{ $search ?? '' }}"
                   class="form-control" placeholder="Cari kode atau nama kursus">
        </div>

        <div class="col-md-3">
            {{-- Tambahan ID: status-filter --}}
            <select name="status" id="status-filter" class="form-select">
                <option value="">Semua status</option>
                <option value="open"   @selected(($status ?? '') === 'open')>Open</option>
                <option value="closed" @selected(($status ?? '') === 'closed')>Closed</option>
                <option value="draft"  @selected(($status ?? '') === 'draft')>Draft</option>
            </select>
        </div>

        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary">Cari</button>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            {{-- Memanggil file partial yang sudah dibuat di Langkah 2 --}}
            @include('courses._results')
        </div>
    </div>
</div>
@endsection

{{-- SCRIPT AJAX (LANGSUNG DITEMPEL DI SINI) --}}
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        let searchTimer;

        function loadCourses(url = '{{ route('courses.index') }}') {
            const q = $('#live-search').val();
            const status = $('#status-filter').val();

            // Efek loading transparan
            $('#course-results').css('opacity', '0.5');

            $.get(url, { q: q, status: status, partial: 1 })
                .done(function(html) {
                    $('#course-results').replaceWith(html);
                    $('#course-results').css('opacity', '1');
                })
                .fail(function() {
                    console.error('Gagal memuat hasil course.');
                    $('#course-results').css('opacity', '1');
                });
        }

        // 1. Live search (Debounce 300ms)
        $(document).on('input', '#live-search', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() {
                loadCourses();
            }, 300);
        });

        // 2. Filter status (Langsung jalan saat diganti)
        $(document).on('change', '#status-filter', function() {
            loadCourses();
        });

        // 3. Pagination Ajax (Klik page 2 tanpa reload)
        $(document).on('click', '#course-results .pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            loadCourses(url);
        });
    });
</script>
@endpush
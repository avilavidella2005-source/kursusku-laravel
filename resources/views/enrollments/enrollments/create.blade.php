@extends('layouts.app')

@section('title', 'Pendaftaran Kursus')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h1 class="h3 fw-bold mb-3">Pendaftaran Kursus</h1>
                <p class="text-secondary">Pilih kursus. Jumlah kursi akan dicek tanpa reload halaman.</p>

                <!-- Pesan Sukses -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Pesan Error Validasi -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('enrollments.preview') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Pilih Kursus</label>
                        <select id="course_id" name="course_id" class="form-select" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach ($courses as $id => $course)
                                <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>
                                    {{ $course['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Area untuk menampilkan hasil Ajax nanti -->
                    <div id="availability" class="alert alert-secondary">
                        Pilih kursus untuk melihat sisa kursi.
                    </div>

                    <button type="submit" class="btn btn-success w-100">Daftar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
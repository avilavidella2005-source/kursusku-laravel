@extends('layouts.app')

@section('title', 'Tambah Enrollment')

@section('content')
<div class="container py-4" style="max-width: 760px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Tambah Enrollment</h1>
    </div>

    <form method="POST" action="{{ route('enrollments.store') }}" class="card shadow-sm border-0">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label for="participant_id" class="form-label fw-bold">Participant</label>
                <select name="participant_id" id="participant_id" class="form-select @error('participant_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Participant --</option>
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}" @selected(old('participant_id') == $participant->id)>
                            {{ $participant->name }} - {{ $participant->email }}
                        </option>
                    @endforeach
                </select>
                @error('participant_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="course_id" class="form-label fw-bold">Course</label>
                <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Course --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                            {{ $course->code }} - {{ $course->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Simpan Enrollment</button>
                <a href="{{ route('enrollments.index') }}" class="btn btn-outline-primary">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
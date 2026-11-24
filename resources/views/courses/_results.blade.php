<div id="course-results">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="py-3 px-3">Kode</th>
                    <th class="py-3 px-3">Nama</th>
                    <th class="py-3 px-3">Biaya</th>
                    <th class="py-3 px-3">Kuota</th>
                    <th class="py-3 px-3">Mulai</th>
                    <th class="py-3 px-3">Status</th>
                    <th class="py-3 px-3 text-center" style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td class="px-3 fw-bold">{{ $course->code }}</td>
                        <td class="px-3">{{ $course->name }}</td>
                        <td class="px-3">Rp {{ number_format($course->fee, 0, ',', '.') }}</td>
                        <td class="px-3">{{ $course->quota }}</td>
                        <td class="px-3">{{ $course->start_date->format('d/m/Y') }}</td>
                        <td class="px-3">
                            <span class="badge {{ $course->status == 'open' ? 'bg-success' : ($course->status == 'closed' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </td>
                        <td class="px-3 text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Hapus kursus ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Tidak ada kursus yang sesuai pencarian/filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination juga dimasukkan ke dalam partial --}}
    <div class="mt-3 px-3 pb-3">
        {{ $courses->links() }}
    </div>
</div>
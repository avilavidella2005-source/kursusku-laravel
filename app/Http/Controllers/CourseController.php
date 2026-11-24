<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Menampilkan daftar kursus dari database.
     * Mendukung search q + filter status + pagination 10/page + withQueryString.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $status = trim((string) $request->query('status'));
        $allowedStatuses = ['open', 'closed', 'draft'];

        $courses = Course::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, $allowedStatuses, true),
                fn ($query) => $query->where('status', $status))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // JIKA REQUEST BERASAL DARI AJAX (partial=1), KEMBALIKAN HANYA TABEL
        if ($request->boolean('partial')) {
            return view('courses._results', compact('courses'));
        }

        // JIKA REQUEST NORMAL, KEMBALIKAN HALAMAN PENUH
        return view('courses.index', compact('courses', 'search', 'status'));
    }

    /**
     * Menampilkan form untuk membuat kursus baru.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Menyimpan kursus baru ke database (Validasi via StoreCourseRequest).
     */
    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu kursus (Route Model Binding).
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Menampilkan form edit kursus.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Menyimpan perubahan data kursus (Validasi via UpdateCourseRequest).
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return to_route('courses.show', $course)
            ->with('success', 'Kursus berhasil diperbarui.');
    }

    /**
     * Menghapus kursus dari database.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}
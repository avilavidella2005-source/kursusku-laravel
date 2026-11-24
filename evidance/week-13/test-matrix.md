# Test Matrix - Pertemuan 13 (Data Discovery)

Berikut adalah tabel pengujian fungsional untuk fitur pencarian, filter, dan pagination server-side pada proyek KursusKu.

| No | Skenario | Input / Langkah | Expected Result | Hasil Aktual | Status | Evidence |
|:---:|:---|:---|:---|:---|:---:|:---|
| 1 | 0 Hasil (Empty State) | Cari keyword `xyz123` | Empty state tampil, tanpa error. | URL `?q=xyz123` menampilkan pesan "Tidak ada kursus yang sesuai pencarian/filter." | **Pass** | `02-search-zero-result.png` |
| 2 | 1 Hasil (Spesifik) | Cari kode `UI-101` | Tepat 1 Course tampil. | Menampilkan 1 baris data (Bootstrap UI) dan info "Menampilkan 1-1 dari 1 data". | **Pass** | `05-search-single-result.png` |
| 3 | Lebih dari 10 Hasil | Buka halaman utama `/courses` | Page 1 max 10 data + pagination. | Menampilkan 10 data dan tombol pagination (1, 2, 3) di kanan bawah. | **Pass** | `01-course-index-normal.png` |
| 4 | Keyword dengan Spasi | Cari `Kursus Dummy` | Keyword terbaca benar. | URL ter-encode menjadi `?q=Kursus+Dummy` dan data berhasil muncul. | **Pass** | `06-search-space-keyword.png` |
| 5 | Filter + Page 2 | Pilih status `Open`, lalu klik page 2 | Query state (q/status) tetap terjaga. | URL tetap membawa `?q=Kursus+Dummy&status=open&page=2` dan data halaman 2 muncul. | **Pass** | `03-pagination-query-filter.png` |
| 6 | Ajax Live Search *(Opsional)* | Mengetik di kolom search (tanpa klik Cari) | Request berjalan via background, hasil terupdate. | Request terkirim via AJAX (terlihat di tab Network), data terupdate tanpa reload. | **Pass** | `07-Network-Evidence-Ajax.png` |

## Catatan:
- Seluruh pengujian di atas dilakukan pada environment lokal menggunakan database MySQL dan server Laravel.
- Kolom "Actual" diisi berdasarkan observasi langsung pada browser.
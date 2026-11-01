// Baris import './bootstrap'; SUDAH DIHAPUS karena file-nya tidak ada
import 'bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;

// --- KODE AJAX UNTUK CEK KETERSEDIAAN KURSI ---
$(document).ready(function() {
    // Ketika dropdown #course_id berubah nilainya
    $('#course_id').on('change', function() {
        const id = $(this).val(); // Ambil ID kursus yang dipilih
        const availabilityBox = $('#availability');

        // Jika belum ada kursus yang dipilih
        if (!id) {
            availabilityBox
                .removeClass('alert-success alert-danger')
                .addClass('alert-secondary')
                .text('Pilih kursus untuk melihat sisa kursi.');
            return;
        }

        // Tampilkan loading sementara
        availabilityBox
            .removeClass('alert-success alert-danger')
            .addClass('alert-secondary')
            .text('Memuat ketersediaan...');

        // Proses Ajax
        $.ajax({
            url: `/courses/${id}/availability`, // URL dari route JSON kita
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Jika berhasil, tampilkan sisa kursi
                availabilityBox
                    .removeClass('alert-secondary alert-danger')
                    .addClass('alert-success')
                    .text(`${data.remaining} kursi tersisa untuk ${data.course}.`);
            },
            error: function() {
                // Jika gagal (misal server mati atau route salah)
                availabilityBox
                    .removeClass('alert-secondary alert-success')
                    .addClass('alert-danger')
                    .text('Gagal memuat ketersediaan kursus.');
            }
        });
    });
});
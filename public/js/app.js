$(document).ready(function () {
    // Fungsi untuk memuat konten halaman saat tautan di sidebar diklik
    $('.menu-link').click(function (e) {
        e.preventDefault(); // Mencegah default action dari tautan
        var url = $(this).attr('href'); // Ambil URL dari tautan yang diklik

        // Menyimpan status dropdown sebelum memuat halaman baru
        var $menuToggle = $(this).closest('.menu-toggle');
        var isOpen = $menuToggle.hasClass('menu-open');

        // Memuat konten halaman ke dalam konten utama (bagian yang berubah)
        $('#main-content').load(url, function () {
            // Mengatur ulang status dropdown setelah halaman dimuat
            if (isOpen) {
                $menuToggle.addClass('menu-open');
            } else {
                $menuToggle.removeClass('menu-open');
            }
        });
    });

    // Fungsi untuk menangani klik pada menu-toggle (dropdown)
    $('.menu-toggle').click(function () {
        $(this).toggleClass('menu-open');
    });
});

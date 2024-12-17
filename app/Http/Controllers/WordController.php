<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WordController extends Controller
{
    public function generateWordCloud()
    {
        try {
            // Jalankan skrip Python untuk menghasilkan word cloud
            $output = shell_exec('python ' . base_path('app/Scripts/word_data.py'));

            // Mendapatkan path gambar word cloud dari output skrip Python
            $wordcloudImagePath = trim($output);

            // Tentukan path tujuan untuk penyimpanan gambar word cloud
            $destinationPath = public_path('wordclouds');
            // Pastikan direktori penyimpanan word cloud ada, jika tidak, buat direktori baru
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Pindahkan gambar word cloud ke direktori yang diinginkan
            $newWordcloudImagePath = $destinationPath . '/wordcloud.png';
            rename($wordcloudImagePath, $newWordcloudImagePath);

            // Tampilkan pesan sukses dan redirect ke halaman hasil
            return redirect()->route('dashboard.word.index')->with('success', 'Word cloud berhasil dibuat.');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->route('dashboard.word.index')->with('error', 'Gagal membuat word cloud: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessController extends Controller
{
   public function preprocessReviews()
    {
        // Ambil data review dari tabel
        $reviews = DB::table('trainings')->pluck('review');

        // Ubah koleksi dari database menjadi array PHP
        $reviewsArray = $reviews->toArray();

        // Ubah array PHP menjadi string dengan format yang sesuai untuk proses preprocessing
        $documents = implode("\n", $reviewsArray);

        // Simpan data ke dalam file sementara
        $tmpFile = tempnam(sys_get_temp_dir(), 'preprocessed_data');
        file_put_contents($tmpFile, $documents);

        // Jalankan skrip Python preprocessing
        $command = 'python ' . base_path('app/Scripts/preprocess_data.py') . ' ' . escapeshellarg($tmpFile);
        $preprocessedData = shell_exec($command);

        // Hapus file sementara setelah selesai
        unlink($tmpFile);

        // Misalnya, inisialisasi data hasil preprocessing dengan data yang diperoleh dari hasil pemrosesan
        $preprocessedData = [
            "preprocessed_data" => json_decode($preprocessedData, true)
        ];

        // Mengarahkan ke view dan mengirim data JSON sebagai variabel
        return view('dashboard.prepocessing.index')->with('preprocessedData', $preprocessedData);
    }
    
}

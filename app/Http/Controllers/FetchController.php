<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FetchController extends Controller
{
    public function fetchScript()
    {
        // Ambil data dari tabel datasets
        $datasets = DB::table('datasets')->get();

        // Ubah koleksi dari database menjadi array PHP
        $datasetsArray = $datasets->toArray();

        // Simpan data ke dalam file sementara dengan format JSON
        $tmpFile = tempnam(sys_get_temp_dir(), 'datasets_data');
        file_put_contents($tmpFile, json_encode($datasetsArray));

        // Kirim path file sementara ke skrip Python
        $scriptPath = base_path('app/Scripts/fetch_data.py');
        $command = 'python ' . $scriptPath . ' ' . escapeshellarg($tmpFile);
        $output = shell_exec($command);

        // Hapus file sementara setelah selesai
        unlink($tmpFile);

        // Mengecek apakah script berhasil dijalankan
        if ($output === null) {
            throw new ProcessFailedException('Python script execution failed.');
        }

        // Anda bisa menyesuaikan respon di sini
        return redirect()->back()->with('message', 'Python script executed successfully! Output: ' . $output);
    }
}

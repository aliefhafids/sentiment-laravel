<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassificationController extends Controller
{
    public function preprocessReviewsAndClassify()
    {
        try {
            // Ambil data review dari tabel
            $reviews = Training::all();

            // Simpan data review ke dalam array
            $reviewData = [];
            foreach ($reviews as $review) {
                $reviewData[] = [
                    'review' => $review->review,
                    'rating_id' => $review->rating_id,
                    'classification_id' => $review->classification_id
                ];
            }

            // Simpan data review ke dalam file sementara
            $tmpFile = tempnam(sys_get_temp_dir(), 'review_data');
            file_put_contents($tmpFile, json_encode($reviewData));

            // Kirim path file sementara ke skrip Python
            $command = 'python ' . base_path('app/Scripts/class_data.py') . ' ' . escapeshellarg($tmpFile);
            $output = shell_exec($command);

            // Hapus file sementara setelah selesai
            unlink($tmpFile);

            // Tampilkan pesan sukses dan redirect ke halaman hasil
            return redirect()->route('dashboard.klasifikasi.result')->with('success', 'Data berhasil diproses dan disimpan.');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->route('dashboard.klasifikasi.result')->with('error', $e->getMessage());
        }
    }

   public function showResults()
    {
        try {
            // Ambil data hasil klasifikasi dari tabel results dengan pagination
            $results = Result::paginate(20);

            // Hitung jumlah sysclassification_id
            $positifCount = Result::where('sysclassification_id', 1)->count();
            $netralCount = Result::where('sysclassification_id', 2)->count();
            $negatifCount = Result::where('sysclassification_id', 3)->count();

            // Hitung confusion matrix
            $confusionMatrix = $this->calculateConfusionMatrix();

            // Hitung precision
            $precision = $this->calculatePrecision();

            // Hitung recall
            $recall = $this->calculateRecall();

            // Hitung akurasi
            $accuracy = $this->calculateAccuracy();

            // Kirim data ke view
            return view('dashboard.klasifikasi.result', compact('results', 'positifCount', 'netralCount', 'negatifCount', 'confusionMatrix', 'precision', 'recall', 'accuracy'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // Fungsi untuk menghitung confusion matrix
    private function calculateConfusionMatrix()
    {
        // Ambil hasil klasifikasi dari tabel results
        $classifiedResults = Result::all();

        // Inisialisasi confusion matrix
        $confusionMatrix = [
            'TP' => 0, // True Positives
            'TN' => 0, // True Negatives
            'FP' => 0, // False Positives
            'FN' => 0, // False Negatives
        ];

        // Hitung confusion matrix
        foreach ($classifiedResults as $result) {
            if ($result->classification_id == 1 && $result->sysclassification_id == 1) {
                $confusionMatrix['TP']++;
            } elseif ($result->classification_id == 1 && $result->sysclassification_id != 1) {
                $confusionMatrix['FN']++;
            } elseif ($result->classification_id != 1 && $result->sysclassification_id == 1) {
                $confusionMatrix['FP']++;
            } else {
                $confusionMatrix['TN']++;
            }
        }

        return $confusionMatrix;
    }

    // Fungsi untuk menghitung precision
    private function calculatePrecision()
    {
        // Ambil hasil klasifikasi dari tabel results
        $classifiedResults = Result::all();

        // Inisialisasi variabel
        $truePositives = 0;
        $falsePositives = 0;

        // Hitung precision
        foreach ($classifiedResults as $result) {
            if ($result->classification_id == 1 && $result->sysclassification_id == 1) {
                $truePositives++;
            } elseif ($result->classification_id != 1 && $result->sysclassification_id == 1) {
                $falsePositives++;
            }
        }

        if ($truePositives + $falsePositives > 0) {
            $precision = $truePositives / ($truePositives + $falsePositives);
        } else {
            $precision = 0;
        }

        // Format hasil dengan dua angka di belakang koma
        return number_format($precision, 2);
    }

    // Fungsi untuk menghitung recall
    private function calculateRecall()
    {
        // Ambil hasil klasifikasi dari tabel results
        $classifiedResults = Result::all();

        // Inisialisasi variabel
        $truePositives = 0;
        $actualPositives = 0;

        // Hitung recall
        foreach ($classifiedResults as $result) {
            if ($result->classification_id == 1 && $result->sysclassification_id == 1) {
                $truePositives++;
            }
            if ($result->classification_id == 1) {
                $actualPositives++;
            }
        }

        if ($actualPositives > 0) {
            $recall = $truePositives / $actualPositives;
        } else {
            $recall = 0;
        }

        // Format hasil dengan dua angka di belakang koma
        return number_format($recall, 2);
    }

    // Fungsi untuk menghitung akurasi
    private function calculateAccuracy()
    {
        // Ambil hasil klasifikasi dari tabel results
        $classifiedResults = Result::all();

        // Inisialisasi variabel
        $correctClassifications = 0;
        $totalClassifications = 0;

        // Hitung akurasi
        foreach ($classifiedResults as $result) {
            if ($result->classification_id == $result->sysclassification_id) {
                $correctClassifications++;
            }
            $totalClassifications++;
        }

        if ($totalClassifications > 0) {
            $accuracy = $correctClassifications / $totalClassifications;
        } else {
            $accuracy = 0;
        }

        // Format hasil dengan dua angka di belakang koma
        return number_format($accuracy, 2);
    }

    public function hilangData()
    {
        try {
            // Hapus semua data dari tabel Training
            Result::truncate();

            return redirect()->back()->with('success', 'Semua data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}


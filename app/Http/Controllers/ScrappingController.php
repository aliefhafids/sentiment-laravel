<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use Goutte\Client;

class ScrappingController extends Controller
{
    // public function scrapeReviews()
    // {
    //     try {
    //         // Buat instance Client Goutte
    //         $client = new Client();

    //         // Buat request ke URL target (ganti dengan URL Tokopedia yang sesuai)
    //         $crawler = $client->request('GET', 'https://www.tokopedia.com/laily0205/lipstik-implora-urban-lip-cream-matte-01-02-03-04-06-08-09-10-11-01-nude/review');

    //         // Debugging: Tambahkan pernyataan dd() atau var_dump() untuk melihat isi crawler
    //         dd($crawler);

    //         // Ambil teks dari semua elemen dengan class 'css-1k41fl7'
    //         $reviews = $crawler->filter('div.css-1k41fl7')->each(function ($node) {
    //             return $node->text();
    //         });

    //         // Simpan ulasan ke dalam tabel trainings
    //         foreach ($reviews as $review) {
    //             $newTraining = new Training();
    //             $newTraining->review = $review;
    //             $newTraining->classification_id = 4; // Sesuaikan dengan classification_id yang sesuai
    //             $newTraining->save();
    //         }

    //         // Kembalikan ulasan sebagai respons JSON
    //         return response()->json(['reviews' => $reviews]);
    //     } catch (\Exception $exception) {
    //         // Tangani kesalahan jika terjadi
    //         return response()->json(['error' => $exception->getMessage()], 500);
    //     }
    // }

    public function scrapeReviews()
    {
        try {
            // URL dari artikel Wikipedia tentang Laravel
            $url = 'https://www.tokopedia.com/laily0205/lipstik-implora-urban-lip-cream-matte-01-02-03-04-06-08-09-10-11-01-nude/review';

            // Membuat instance dari Client Goutte
            $client = new Client();

            // Mengambil halaman dengan URL yang diberikan
            $crawler = $client->request('GET', $url);
 
            // Memilih elemen yang ingin di-scrape, misalnya judul halaman
            $title = $crawler->filter('title')->text();

            // Memilih isi dari paragraf pertama di artikel Wikipedia
            $firstParagraph = $crawler->filter('.mw-parser-output > p')->eq(0)->text();

            // Simpan hasil scraping ke dalam tabel trainings
            $newTraining = new Training();
            $newTraining->review = $title;
            $newTraining->classification_id = 4; // Sesuaikan dengan classification_id yang sesuai
            $newTraining->save();

            // Mengembalikan respons JSON
            return response()->json([
                'title' => $title,
                'first_paragraph' => $firstParagraph
            ]);
        } catch (\Exception $exception) {
            // Tangani kesalahan jika terjadi
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

}

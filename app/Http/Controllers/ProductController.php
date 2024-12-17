<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
     public function saveClassification(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'positif_count' => 'required|integer',
            'netral_count' => 'required|integer',
            'negatif_count' => 'required|integer',
        ]);

        Product::create([
            'product' => $request->product,
            'positif_count' => $request->positif_count,
            'netral_count' => $request->netral_count,
            'negatif_count' => $request->negatif_count,
        ]);

        return redirect()->back()->with('message', 'Klasifikasi berhasil disimpan.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Product;
use App\Models\Testing;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalDatasets = Dataset::count(); // Menghitung jumlah dataset
        $totalLatih = Training::count(); // Menghitung jumlah dataset
        $totalUji = Testing::count(); // Menghitung jumlah dataset

        // Menghitung jumlah masing-masing classification_id
        $positifCount = Dataset::where('classification_id', 1)->count();
        $netralCount = Dataset::where('classification_id', 2)->count();
        $negatifCount = Dataset::where('classification_id', 3)->count();

        return view('dashboard.index', [
            'products' => Product::paginate(15),
            'totalDatasets' => $totalDatasets, // Mengirim jumlah dataset ke view
            'totalLatih' => $totalLatih, // Mengirim jumlah dataset ke view
            'totalUji' => $totalUji, // Mengirim jumlah dataset ke view
            'positifCount' => $positifCount, // Mengirim jumlah positif ke view
            'netralCount' => $netralCount, // Mengirim jumlah netral ke view
            'negatifCount' => $negatifCount // Mengirim jumlah negatif ke view
        ]);
    }

    // Metode lainnya tetap sama
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function delete($id)
    {
        $data = Product::find($id);
        $data->delete();

        return redirect('/dashboard')->with('success', 'New Data has been Deleted!');
    }
}

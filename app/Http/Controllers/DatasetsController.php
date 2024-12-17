<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Http\Controllers\Controller;

class DatasetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view ('dashboard.dataset.index',[
            'datasets' => Dataset::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cls = Classification::all();
        return view('dashboard.dataset.create', compact('cls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'review' => 'required|max:1000',
            'rating_id' => 'required|integer|min:1|max:5',
            'classification_id' => 'required',
        ]);
        
        Dataset::create($validatedData);

        return redirect('/dashboard/dataset')->with('success', 'New review has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Dataset::find($id);
        $data->delete();

        return redirect('/dashboard/dataset')->with('success', 'New Data has been Deleted!');
    }
    
    public function hapusData()
    {
        try {
            // Hapus semua data dari tabel Dataset
            Dataset::truncate();

            return redirect()->back()->with('success', 'Semua data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}

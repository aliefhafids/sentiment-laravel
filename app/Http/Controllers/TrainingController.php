<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Training;
use App\Imports\DataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Models\Classification;
use App\Http\Controllers\Controller;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view ('dashboard.data.index',[
            'trainings' => Training::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cls = Classification::all();
        return view('dashboard.data.create', compact('cls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'review' => 'required|max:1000',
            'rating_id' => 'required',
            'classification_id' => 'required',
        ]);
        
        Training::create($validatedData);

        return redirect('/dashboard/latih')->with('success', 'New review has been added!');
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
    public function update(Request $request, $id)
    {
        //  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Training::find($id);
        $data->delete();

        return redirect('/dashboard/latih')->with('success', 'New Data has been Deleted!');
    }
    
    public function clearData()
    {
        try {
            // Hapus semua data dari tabel Training
            Training::truncate();

            return redirect()->back()->with('success', 'Semua data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

}

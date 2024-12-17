<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\Sysclassification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view ('dashboard.uji.index',[
            'testings' => Testing::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $cls = Classification::all();
         $scls = Sysclassification::all();
        return view('dashboard.uji.create', compact('cls', 'scls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'review' => 'required|max:255',
            'rating_id' => 'required',
            'classification_id' => 'required',
            'sysclassification_id' => '', // pastikan ini tidak diperlukan sebagai required
        ]);

         if (!isset($validatedData['sysclassification_id'])) {
        $validatedData['sysclassification_id'] = Auth::user()->sysclassification_id ?? 4; // Ganti 4 dengan nilai default yang sesuai
    }

        Testing::create($validatedData);

        return redirect('/dashboard/uji')->with('success', 'New review has been added!');
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
        $testing = Testing::findOrFail($id);
        $classifications = Classification::all();
        $sysclassifications = Sysclassification::all();
        return view('dashboard.uji.edit', compact('testing', 'classifications', 'sysclassifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'review' => 'required|max:255',
            'classification_id' => 'required',
            'sysclassification_id' => 'required',
        ]);

        $testing = Testing::findOrFail($id);
        $testing->update($validatedData);

        return redirect('/dashboard/uji')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Testing::find($id);
        $data->delete();

        return redirect('/dashboard/uji')->with('success', 'New Data has been Deleted!');
    }

    public function cleanData()
    {
        try {
            // Hapus semua data dari tabel Training
            Testing::truncate();

            return redirect()->back()->with('success', 'Semua data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}

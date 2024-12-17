<?php

namespace App\Http\Controllers;

use App\Imports\UjiImport;
use App\Imports\DataImport;
use App\Imports\MainImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
     public function importexcel(Request $request)
    {
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('ReviewData', $namafile);

        Excel::import(new DataImport, \public_path('/ReviewData/'.$namafile));
        return \redirect()->back();
    }

     public function importesting(Request $request)
    {
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('ReviewData', $namafile);

        Excel::import(new UjiImport, \public_path('/ReviewData/'.$namafile));
        return \redirect()->back();
    }

    public function importmain(Request $request)
    {
       $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('ReviewData', $namafile);

        Excel::import(new MainImport, \public_path('/ReviewData/'.$namafile));
        return \redirect()->back();
    }
}
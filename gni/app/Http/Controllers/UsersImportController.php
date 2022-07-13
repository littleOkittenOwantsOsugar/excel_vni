<?php

namespace App\Http\Controllers;

use App\Imports\MainImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function show(){
        return view('users.import');
    }
    public function store(Request $request)
    {
        //$file=$request->file('file');

        Excel::import(new MainImport, 'C:\Users\helen\Downloads\Практика ВНИГНИ 2022\ias_uvs_summary.xlsx');

        //return back()->withStatus('Excel file imported succesfully');
    }
}

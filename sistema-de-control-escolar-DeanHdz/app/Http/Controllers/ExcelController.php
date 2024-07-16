<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CalificacionesImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importExcel(Request $request)
    {
        $file = $request->file('file');

        $rows = 
        Excel::import(new CalificacionesImport, $rows);
        return redirect()->back();
    }
}

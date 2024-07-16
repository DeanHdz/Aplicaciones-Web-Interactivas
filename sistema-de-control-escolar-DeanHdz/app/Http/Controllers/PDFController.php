<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    
    public function generatePdf(Request $request)
    {
        $html = $request->input('html');
        $pdf = PDF::loadHTML($html);
        return $pdf->stream();
    }

}

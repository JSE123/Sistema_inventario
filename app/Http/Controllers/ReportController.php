<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function ventasInforme(Request $request) {
        $query = Sale::with('client');
    
        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $query->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin]);
        }
    
        $ventas = $query->orderBy('created_at', 'desc')->get();
    
        return view('reports.saleReport', compact('ventas'));
    }

    public function ventasPDF() {
        $ventas = Sale::with('client')->orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('reports.saleReport', compact('ventas'));
        return $pdf->download('informe_ventas.pdf');
    }

    public function ventasExcel() {
        return Excel::download(new SaleExport, 'informe_ventas.xlsx');
    }
}

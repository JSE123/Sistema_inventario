<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SaleExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sale::select('client_id', 'total', 'created_at')->get()->map(function ($sale) {
            return [
                'Cliente' => $sale->client->name, 
                'Total' => $sale->total,
                'Fecha' => $sale->created_at->format('Y-m-d'),
            ];
        });;
    }

    public function headings(): array
    {
        return [
            'Cliente', 
            'Total', 
            'Fecha'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Encabezados en negrita
        ];
    }
}

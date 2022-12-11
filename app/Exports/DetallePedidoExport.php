<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class DetallePedidoExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable;
    
    /**
    * Para las cabeceras
    * 
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array {
        return [
            "Cantidad de juegos",
            "Nombre del juego",
            "Descripción del juego",
            "Precio por unidad",
            "Fecha de compra",' '
        ];
    }


    /**
    * Para los detalles del pedido exportados
    * 
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        // Pasamos las dos fechas a través de sesiones
        $fechaInicio = Session::get('fechaInicio');
        $fechaFinal = Session::get('fechaFinal');

        $detallesPedido = DB::table('detalle_pedidos')
            ->join('pedidos', 'detalle_pedidos.pedido_id', '=', 'pedidos.id')
            ->join('juegos', 'detalle_pedidos.juego_id', '=', 'juegos.id')
            ->select('detalle_pedidos.cantidad', 'juegos.nombre', 'juegos.descripcion',
                DB::raw('CONCAT(REPLACE(juegos.precio, ".",",")," €") as precio'),
                DB::raw('DATE_FORMAT(pedidos.fechaCompra, "%d/%m/%Y") as fechaCompra'))
            ->where('pedidos.estado', '=', 'Enviado')
            ->whereBetween('pedidos.fechaCompra', [$fechaInicio, $fechaFinal])
            ->get();

        return $detallesPedido;
    }

    //-----------------  Aplicamos los estilos a nuestras filas y columnas ---------------------------

    /**
    * Para las anchuras de nuestras columnas
    * 
    * @return \Illuminate\Support\Collection
    */

    public function columnWidths(): array {
        return [
            'A' => 23,
            'B' => 30,
            'C' => 40,
            'D' => 23,
            'E' => 23,
        ];
    }


    /**
    * Centrado de todos los datos exportados
    * cambiando los estilos de nuestras columnas
    * 
    * @return \Illuminate\Support\Collection
    */

    public function styles(Worksheet $sheet)
    {
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        return [
            1 => ['font' => ['bold' => true, 'size' => 13]],// para toda la primera fila

            'A'  => ['font' => ['size' => 12], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'B'  => ['font' => ['size' => 12], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'C'  => ['font' => ['size' => 12], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'D'  => ['font' => ['size' => 12], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            'E'  => ['font' => ['size' => 12], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']]
        ];
    }
}
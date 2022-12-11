<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaRepartoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas_repartos')->insert(['nombre' => 'Tipsa Puerto Real', 'direccion' => 'Calle Ancha, nº 12, Puerto Real, España',
            'email' => 'ramon.tipsa@gmail.com', 'telefono' => '956922815', 'imagen' => 'images/logos_empresa/tipsa.png',
            'coste_pedido_normal' => 3.55, 'coste_pedido_urgente' => 4.78]);

        DB::table('empresas_repartos')->insert(['nombre' => 'Nacex', 'direccion' => 'C/ Pablo Iglesias, 112-122
            08908 - Hospitalet de Llobregat (Barcelona)', 'email' => 'atencion.cliente@nacex.com', 'telefono' => '900100100',
            'imagen' => 'images/logos_empresa/nacex.png',
            'coste_pedido_normal' => 3.86, 'coste_pedido_urgente' => 5.00]);
        
        DB::table('empresas_repartos')->insert(['nombre' => 'Rapid Express', 'direccion' => 'C/Uruguay 4 CP. 28016 Madrid',
            'email' => 'atencionalcliente@rapidexpress.es', 'telefono' => ' 915103360', 'imagen' => 'images/logos_empresa/rapid_express.png',
            'coste_pedido_normal' => 3.95, 'coste_pedido_urgente' => 4.36]);
    }
}

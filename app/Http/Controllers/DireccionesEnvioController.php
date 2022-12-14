<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DireccionesEnvioController extends Controller
{
     /**
     * Display a añadir dirección de envio of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function aniadirDireccionEnvio(Request $request) {
        $clienteId = auth()->user()->id;// id de cliente actual
        $clienteUsername = auth()->user()->username;

        // Validamos la dirección de envio
        $this->validate($request, [
                'direccion' => 'required|max:140',
                'nombreCalle' => 'required|max:85',
                'portal' => 'required',
                'piso' => 'required|max:20',
                'codigoPostal' => 'required',
                'ciudad' => 'required|max:60',
                'provincia' => 'required|max:80',
                'pais' => 'required|max:70',
                'telefono' => 'required|min:9|max:9|unique:direcciones_envios',
                'observaciones' => 'required|max:120',
                'empresa_reparto_id' => 'required'
            ],
            ['direccion.required' => __("Debe introducir un nombre de cliente")],
            ['direccion.max' => __("La dirección no puede tener más de 140 caracteres")],

            ['nombreCalle.required' => __("Debe introducir unos apellidos de cliente")],
            ['nombreCalle.max' => __("El nombre de calle no puede tener más de 85 caracteres")],

            ['portal.required' => __("Debe introducir un email de cliente")],

            ['piso.required' => __("Debe introducir el número de piso")],
            ['piso.max' => __("Este dato no debe tener más de 20 caracteres")],

            ['codigoPostal.required' => __("Debe introducir su código postal")],

            ['ciudad.required' => __("Debe introducir su ciudad")],
            ['ciudad.max' => __("La ciudad no debe tener más de 60 caracteres")],

            ['provincia.required' => __("Debe introducir la provincia")],
            ['provincia.max' => __("La provincia no debe tener más de 80 caracteres")],

            ['pais.required' => __("Debe introducir el pais")],
            ['pais.max' => __("El país no debe tener más de 70 caracteres")],

            ['telefono.required' => __("Debe introducir su número de teléfono")],
            ['telefono.min' => __("Su número de teléfono debe tener 9 caracteres")],
            ['telefono.max' => __("Su número de teléfono debe tener 9 caracteres")],

            ['observaciones.required' => __("Debe introducir sus observaciones")],
            ['observaciones.max' => __("Sus observaciones no deben tener más de 120 caracteres")],

            ['empresa_reparto_id.required' => __("Debe seleccionar una empresa de envio de las existentes")]
        );

        // Añadimos la nueva dirección de envío
        $data['direccion'] = $request->input('direccion');
        $data['nombreCalle'] = $request->input('nombreCalle');
        $data['portal'] = $request->input('portal');
        $data['piso'] = $request->input('piso');
        $data['codigoPostal'] = $request->input('codigoPostal');
        $data['ciudad'] = $request->input('ciudad');
        $data['provincia'] = $request->input('provincia');
        $data['pais'] = $request->input('pais');
        $data['telefono'] = $request->input('telefono');
        $data['observaciones'] = $request->input('observaciones');

        $empresa_reparto_id = $request->input('empresa_reparto_id');
        $data['empresa_reparto_id'] = intval($empresa_reparto_id);

        $data['cliente_id'] = $clienteId;

        DB::table('direcciones_envios')->insert($data);

        /** Editamos el precio del pedido al introducir el nuevo dato */


        return redirect()->route('cliente.paypal')
            ->with('paymentStatus', ['primary', __("Dirección de envio añadida correctamente para $clienteUsername")]);
    }
}

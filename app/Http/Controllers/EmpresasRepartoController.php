<?php

namespace App\Http\Controllers;

use App\EmpresasReparto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmpresasRepartoController extends Controller {
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        // Mostramos las empresas de mesa en orden descendente
        $empresas = EmpresasReparto::orderBy('id', 'DESC')->paginate(5);
        return view('empresas_reparto.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Para mostrar el formulario de añadir de los juegos
        return view('empresas_reparto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        // Para la validación de la nueva empresa de reparto
        $this->validate($request, [
                'nombre' => 'required|max:50|unique:empresas_repartos',
                'direccion' => 'required|max:140',
                'email' => 'required|max:100|unique:empresas_repartos',
                'telefono' => 'required|min:9|max:9|unique:empresas_repartos',
                'imagen' => 'required|mimes:png|unique:empresas_repartos',
                'coste_pedido_normal' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
                'coste_pedido_urgente' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
            ],
            ['nombre.required' => __("Debe introducir un nombre de empresa de reparto")],
            ['nombre.max' => __("El nombre debe tener como máximo 50 caracteres")],

            ['direccion.required' => __("Debe introducir una dirección de contacto")],
            ['direccion.max' => __("La dirección debe tener como máximo 140 caracteres")],

            ['email.required' => __("Debe introducir un email de contacto")],
            ['email.max' => __("El email debe tener como máximo 100 caracteres")],

            ['telefono.required' => __("Debe introducir un teléfono de contacto")],
            ['telefono.min' => __("El télefono debe tener 9 caracteres")],
            ['telefono.max' => __("El télefono debe tener 9 caracteres")],

            ['imagen.required' => __("Debe subir un logo de imágen")],
            ['imagen.mimes' => __("Solo está permitido subir imágenes con extensión .png")],

            ['coste_pedido_normal.required' => __("Debe introducir un coste normal de pedido")],
            ['coste_pedido_normal.regex' => __("El coste normal de pedido debe tener dos decimales")],

            ['coste_pedido_urgente.required' => __("Debe introducir un coste urgente de pedido")],
            ['coste_pedido_urgente.regex' => __("El coste urgente de pedido debe tener dos decimales")]
        );

        /** Añadimos una nueva empresa de reparto junto con su imágen de logo */
        $data['nombre'] = $request->input('nombre');
        $data['direccion'] = $request->input('direccion');
        $data['email'] = $request->input('email');
        $data['telefono'] = $request->input('telefono');
        $data['imagen'] = $request->file('imagen');// después del tratamiento de la imágen

        // Tratamiento de la imágen de logo de la empresa
        if ($request->hasFile('imagen')) {// si es carpeta
            $logoEmpresa = $request->file('imagen');// si es fichero

            $nombreImagen = $logoEmpresa->getClientOriginalName();
            $rutaImagen = 'images/logos_empresa/';// sin la función public_path()

            $logoEmpresa->move($rutaImagen, $nombreImagen);// movemos la imágen a nuestra carpeta images/logos_empresa
            
            $imagen = $rutaImagen.$nombreImagen;
        
            $data['coste_pedido_normal'] = $request->input('coste_pedido_normal');
            $data['coste_pedido_urgente'] = $request->input('coste_pedido_urgente');


            DB::table('empresas_repartos')->insert([
                'nombre' => $data['nombre'],
                'direccion' => $data['direccion'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'imagen' => $imagen,
                'coste_pedido_normal' => $data['coste_pedido_normal'],
                'coste_pedido_urgente' => $data['coste_pedido_urgente']
            ]);
        }

        $nombreEmpresa = $data['nombre'];

        return redirect()->route('empresas_reparto.index')
            ->with('mensaje_empresa', ['success', __("Empresa de reparto $nombreEmpresa añadida correctamente")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $empresa_reparto = EmpresasReparto::find($id);

        $getEmpresa = EmpresasReparto::select('imagen')
            ->where('id', $id)
            ->get();

        foreach ($getEmpresa as $empresa) {
            $imagenActual = $empresa->imagen;
            $request->session()->put('sessionImagen', $imagenActual);
            
            return view('empresas_reparto.edit', compact('empresa_reparto', 'imagenActual'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // Para la validación de la empresa de reparto a editar
        $this->validate($request, [
                'nombre' => 'required|max:50',
                'direccion' => 'required|max:140',
                'email' => 'required|max:100',
                'telefono' => 'required|min:9|max:9',
                'imagen' => 'required|mimes:png',
                'coste_pedido_normal' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
                'coste_pedido_urgente' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
            ],
            ['nombre.required' => __("Debe introducir un nombre de empresa de reparto")],
            ['nombre.max' => __("El nombre debe tener como máximo 50 caracteres")],

            ['direccion.required' => __("Debe introducir una dirección de contacto")],
            ['direccion.max' => __("La dirección debe tener como máximo 140 caracteres")],

            ['email.required' => __("Debe introducir un email de contacto")],
            ['email.max' => __("El email debe tener como máximo 100 caracteres")],

            ['telefono.required' => __("Debe introducir un teléfono de contacto")],
            ['telefono.min' => __("El télefono debe tener 9 caracteres")],
            ['telefono.max' => __("El télefono debe tener 9 caracteres")],

            ['imagen.required' => __("Debe subir un logo de imágen")],
            ['imagen.mimes' => __("Solo está permitido subir imágenes con extensión .png")],

            ['coste_pedido_normal.required' => __("Debe introducir un coste normal de pedido")],
            ['coste_pedido_normal.regex' => __("El coste normal de pedido debe tener dos decimales")],

            ['coste_pedido_urgente.required' => __("Debe introducir un coste urgente de pedido")],
            ['coste_pedido_urgente.regex' => __("El coste urgente de pedido debe tener dos decimales")]
        );

        /* Eliminamos la imágen anterior de la carpeta, enviando la ruta de imágen a través de session */
        $imagenLogo = $request->session()->get('sessionImagen');
        unlink($imagenLogo);

        /** Editamos la empresa de reparto seleccionada junto con su imágen de logo */
        $data['nombre'] = $request->input('nombre');
        $data['direccion'] = $request->input('direccion');
        $data['email'] = $request->input('email');
        $data['telefono'] = $request->input('telefono');

        $data['imagen'] = $request->file('imagen');

        // Tratamiento de la imágen de logo de la empresa
        if ($request->hasFile('imagen')) {// si es carpeta
            $logoEmpresa = $request->file('imagen');// si es fichero

            $nombreImagen = $logoEmpresa->getClientOriginalName();
            $rutaImagen = 'images/logos_empresa/';// sin la función public_path()

            $logoEmpresa->move($rutaImagen, $nombreImagen);// movemos la imágen a nuestra carpeta images/logos_empresa
            $imagen = $rutaImagen.$nombreImagen;

            $data['coste_pedido_normal'] = $request->input('coste_pedido_normal');
            $data['coste_pedido_urgente'] = $request->input('coste_pedido_urgente');


            DB::table('empresas_repartos')->where('id', $id)->update([
                'nombre' => $data['nombre'],
                'direccion' => $data['direccion'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'imagen' => $imagen,
                'coste_pedido_normal' => $data['coste_pedido_normal'],
                'coste_pedido_urgente' => $data['coste_pedido_urgente']
            ]);
        }
        
        $nombreEmpresa = $data['nombre'];

        return redirect()->route('empresas_reparto.index')
            ->with('mensaje_empresa', ['primary', __("Empresa de reparto $nombreEmpresa editada correctamente")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        /** Eliminamos la empresa de reparto aplicando Soft Delete */
        $logoEmpresa = EmpresasReparto::select('imagen')->where('id', $id)->get();

        $imagen = $logoEmpresa->implode('imagen', ',');
        unlink($imagen);// procedemos a eliminar la imágen de la carpeta

        EmpresasReparto::find($id)->delete();// eliminamos toda la empresa seleccionada después de la imágen
        return back()->with('mensaje_empresa', ['danger', __("Empresa de reparto eliminada correctamente")]);
    }    
}

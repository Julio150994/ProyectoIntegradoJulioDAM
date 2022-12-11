<?php

namespace App\Http\Controllers;

use App\ImagenesJuego;
use App\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JuegoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        // Mostramos los juegos de mesa en orden descendente con sus imágenes
        
        $juegos = Juego::orderBy('id', 'DESC')->paginate(5);// paginamos cada 5 juegos
        
        $listaJuegos = ImagenesJuego::orderBy('id', 'ASC')->get();
        
        return view('juegos.index', compact('juegos', 'listaJuegos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Para mostrar el formulario de añadir juegos
        return view('juegos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        // Para la validación del nuevo juego
        // y para subir solamente imágenes con formato PNG y de máximo 2048 bytes
        $this->validate($request, [
                'nombre' => 'required|max:40|unique:juegos',
                'descripcion' => 'required|max:100',
                'precio' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            ],
            ['nombre.required' => __("Debe introducir un nombre de cliente")],
            ['nombre.unique' => __("Este nombre de juego ya existe en la tienda")],
            
            ['descripcion.required' => __("Debe introducir una descripción para el juego de mesa")],
            ['descripcion.max' => __("La descripción debe tener como máximo 100 caracteres")],

            ['precio.required' => __("Debe introducir un precio para el juego de mesa")],
            ['precio.numeric' => __("El precio del juego debe ser numérico")],
            ['precio.regex' => __("El precio del juego debe contener dos decimales")]
        );

        // Añadimos un nuevo juego
        $data['nombre'] = $request->input('nombre');
        $data['descripcion'] = $request->input('descripcion');
        $data['precio'] = $request->input('precio');

        // Acción de añadir nuevo juego
        $juegoId = DB::table('juegos')->insertGetId($data);

        // Tratamiento de nuestras imágenes
        $urlImagenes = [];

        if ($request->hasFile('url')) {// si es carpeta
            $imagenes = $request->file('url');// si es fichero

            foreach ($imagenes as $imagen) {
                // tiempo de la imágen (opcional): time().'_'.
                $nombreImagen = $imagen->getClientOriginalName();
                $rutaUrl = 'images/juegos_mesa/';// sin la función public_path() para poner en la carpeta public.

                $imagen->move($rutaUrl, $nombreImagen);// movemos la imágen a nuestra carpeta images/juego_mesa

                $urlImagenes[]['url'] = $rutaUrl.$nombreImagen;
                $imagen = $rutaUrl.$nombreImagen;
            
                DB::table('imagenes_juegos')->insert([
                    'url' => $imagen,
                    'juego_id' => $juegoId,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }
        }

        $nombreJuego = $data['nombre'];

        return redirect()->route('juegos.index')
            ->with('mensaje_juego_mesa', ['success', __("Juego de mesa $nombreJuego añadido correctamente")]);
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
    public function edit($id) {
        $juegoMesa = Juego::find($id);

        $imagenesJuego = Juego::find($id)->imagenesjuegos;

        return view('juegos.edit', compact('imagenesJuego'), ['juegoMesa' => $juegoMesa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $fileImage = $request->file('imagen');

        if(!empty($fileImage)) {
            // Para la validación del juego a editar
            // y para subir solamente imágenes con formato PNG y de máximo 2048 bytes
            $this->validate($request, [
                    'nombre' => 'required|max:40',
                    'descripcion' => 'required|max:100',
                    'precio' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
                ],
                ['nombre.required' => __("Debe introducir un nombre de cliente")],
                ['nombre.unique' => __("Este nombre de juego ya existe en la tienda")],
                
                ['descripcion.required' => __("Debe introducir la descripción para el juego de mesa")],
                ['descripcion.max' => __("La descripción debe tener como máximo 100 caracteres")],

                ['precio.required' => __("Debe introducir el precio para el juego de mesa")],
                ['precio.numeric' => __("El precio del juego debe ser numérico")],
                ['precio.regex' => __("El precio del juego debe contener dos decimales")]
            );

            // Editamos el juego de mesa seleccionado
            $data['nombre'] = $request->input('nombre');
            $data['descripcion'] = $request->input('descripcion');
            $data['precio'] = $request->input('precio');

            DB::table('juegos')->where('id', $id)->update([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'precio' => $data['precio']
            ]);

            // Tratamiento de nuestras imágenes
            $urlImagenes = [];

            if ($request->hasFile('url')) {// si es carpeta
                
                $imagenes = $request->file('url');// si es fichero
                
                foreach ($imagenes as $imagen) {
                    // tiempo de la imágen (opcional): time().'_'.
                    $nombreImagen = $imagen->getClientOriginalName();
                    $rutaUrl = 'images/juegos_mesa/';

                    // Comprobamos que existen la/s imagen/es anteriores para eliminarlas
                    if ($rutaUrl::exists($rutaUrl.$nombreImagen)) {
                        $rutaUrl::delete($rutaUrl.$nombreImagen);
                    }

                    $imagen->move($rutaUrl, $nombreImagen);// para mover la imágen a nuestra carpeta images

                    $urlImagenes[]['url'] = $rutaUrl.$nombreImagen;
                    $imagen = $rutaUrl.$nombreImagen;
                
                    // Guardamos la url de las imágenes editadas en imagenes_juegos
                    DB::table('imagenes_juegos')->update([
                        'url' => $imagen,
                        'juego_id' => $id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }
        }
        
        $nombreJuego = $data['nombre'];

        return redirect()->route('juegos.index')
            ->with('mensaje_juego_mesa', ['primary', __("Juego de mesa editado como $nombreJuego correctamente")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, $id) {
        // Eliminamos el juego de mesa aplicando Soft Delete
        
        $juegos = Juego::find($id);

        // Seleccionamos las imágenes a eliminar
        $imagenJuego = DB::table('imagenes_juegos')->where('juego_id', '=', $id)->get();
        $formato = $imagenJuego->implode('url', ', ');

        // Lista de urls, separadas por coma
        $imagenes = explode(",", $formato);

        // Tratamiento de nuestras imágenes
        $urlImagenes = [];

        if ($request->hasFile('url')) {
            $images = $request->file('url');// si es fichero

            foreach ($images as $imagen) {
                 // tiempo de la imágen (opcional): time().'_'.
                 $nombreImagen = $imagen->getClientOriginalName();
                 $rutaUrl = 'images/juegos_mesa/';
    
                // Comprobamos que existen la/s imagen/es para eliminarlas
                if ($rutaUrl::exists($rutaUrl.$nombreImagen)) {
                    $rutaUrl::delete($rutaUrl.$nombreImagen);
                }
            }   
        }

        // Eliminamos los datos de la tabla juegos con la función destroy() de Laravel
        Juego::destroy($id);

        // Eliminamos las imágenes del juego que hemos seleccionado (a través del modelo ImagenesJuego)
        $juegos->imagenesjuegos()->delete();

        return back()->with('mensaje_juego_mesa', ['danger', __("Juego de mesa eliminado correctamente")]);
    }

    /**
     * Remove the specified images.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeImages($id) {
        /**
         * Eliminamos las imágenes de un juego de mesa aplicando Soft Delete
         * (sin aplicarlo de momento) 
         */
        
        ImagenesJuego::find($id);

        // Eliminamos la imágen de nuestra carpeta de imágenes (en public)
        $imagenJuego = ImagenesJuego::select('url')->where('id', '=', $id)->get();
        $formato = $imagenJuego->implode('url', ',');
        
        Storage::delete($formato);
        // Proceso de eliminar imágenes con la función destroy() de Laravel
        ImagenesJuego::destroy($id);
        
        return redirect()->route('juegos.edit')
            ->with('imagen_eliminada', ['danger', __("Imágen(es) eliminada(s) correctamente")]);
    }
    
}

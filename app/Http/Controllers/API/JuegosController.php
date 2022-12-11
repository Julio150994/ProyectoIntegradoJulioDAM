<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class JuegosController extends Controller
{
    /** -------------- Solicitudes Http CRUD juegos de mesa ---------------- */
    public $apiStatus = [200, 401, 404];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Obtenemos todas los juegos de mesa, con sus imágenes
    
        $juegosMesa = DB::table('juegos')
            ->join('imagenes_juegos', 'imagenes_juegos.juego_id', '=', 'juegos.id')
            ->select('juegos.id', 'juegos.nombre', 'juegos.descripcion', 'imagenes_juegos.url',
                'juegos.precio', 'juegos.stock')
            ->groupBy('imagenes_juegos.juego_id')
            ->get();


        // Validaciones para los juegos de mesa
        if ($juegosMesa->isEmpty() == true) {
            return response()->json(['error' => 'Empleados no encontrados en Landgame.'], $this->apiStatus[2]);
        }
        
        return response()->json(['success' => $juegosMesa,
            'message' => 'Juegos de mesa mostrados'], $this->apiStatus[0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtenemos un juego seleccionado
        $juego = DB::table('juegos')
            ->join('imagenes_juegos', 'imagenes_juegos.juego_id', '=', 'juegos.id')
            ->select('juegos.id', 'juegos.nombre', 'juegos.descripcion', 'imagenes_juegos.url',
                'juegos.precio', 'juegos.stock')
            ->where('juegos.id', '=', $id)
            ->groupBy('imagenes_juegos.juego_id')
            ->get();

        // Validaciones para los juegos de mesa
        if (is_null($juego)) {
            return response()->json(['error' => 'El juego seleccionado no se ha encontrado'], $this->apiStatus[2]);
        }
        
        return response()->json(['success' => $juego->toArray(), 
            'message' => 'Juego de mesa seleccionado correctamente'], $this->apiStatus[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

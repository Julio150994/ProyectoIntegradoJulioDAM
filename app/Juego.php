<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ImagenesJuego;

class Juego extends Model {

    protected $table = 'juegos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'stock', 'deleted',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];


    /** Relación One To Many entre las tablas juegos e imagenes_juegos */
    public function imagenesjuegos() {
        return $this->hasMany(ImagenesJuego::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Juego;


class ImagenesJuego extends Model {

    protected $table = 'imagenes_juegos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'juego_id', 'deleted',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];


    /** Relación inversa entre las tablas juegos e imagenes_juegos */
    public function juego() {
        return $this->belongsTo(Juego::class);
    }
}

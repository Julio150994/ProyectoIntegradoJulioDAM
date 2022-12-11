<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = 'pedidos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'precioTotal', 'fechaCompra', 'cliente_id', 'estado', 'deleted',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];


    /** Relación One To Many entre las tablas del usuario y los juegos */

    public function user() {
        return $this->hasOne(User::class, 'id', 'cliente_id');
    }

    /** Relación One To Many entre las tablas de los pedidos y los juegos */

    public function juego() {
        return $this->hasOne(Juego::class, 'id', 'juego_id');
    }

    /** Capturamos el valor del precio total de compra */
    public static function getPrecioTotalCompra($total) {
        return $total;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detalle_pedidos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cantidad', 'precioUnitario', 'pedido_id', 'juego_id', 'deleted',
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

    public function pedido() {
        return $this->hasOne(Pedido::class, 'id', 'pedido_id');
    }

    /** Relación One To Many entre las tablas de los pedidos y los juegos */

    public function juego() {
        return $this->hasOne(Juego::class, 'id', 'juego_id');
    }
}

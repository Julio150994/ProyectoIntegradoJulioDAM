<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmpresasReparto;
use App\User;


class DireccionesEnvio extends Model
{
    protected $table = 'direcciones_envios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'direccion', 'nombreCalle', 'portal', 'piso', 'codigoPostal', 'ciudad', 'provincia',
        'pais', 'telefono', 'observaciones', 'empresa_reparto_id', 'cliente_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];



    /** Relacionamos envios con empresas de reparto */
    public function empresasrepartos() {
        return $this->hasMany(EmpresasReparto::class, 'id', 'empresa_reparto_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'id', 'cliente_id');
    }
}

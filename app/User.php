<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use App\Shipping;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellidos', 'email', 'username', 'password', 'role_id', 'deleted',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_logged', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /** Asignamos el id del rol de un usuario con el id del rol asignado (1 usuario tiene 1 rol) */
    public function role() {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relación inversa de empresas de reparto y clientes correspondientes
     * a cada envio
     */
    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }


    /**------- Métodos para recoger los roles de usuario -------- */
    public function getRolAdministrador() {
        return $this->users()->where('role_id', 1)->exists();
        //return $admin;
    }

    public function getRolContable() {
        return $this->users()->where('role_id', 2)->exists();
        //return $contable;
    }

    public function getRolMozo() {
        return $this->users()->where('role_id', 3)->exists();
        //return $mozo;
    }

    public function getRolCliente() {
        return $this->users()->where('role_id', 4)->exists();
        //return $cliente;
    }
}

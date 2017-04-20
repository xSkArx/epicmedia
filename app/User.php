<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const CREATED_AT = 'fecha_registro';

    /**
     * Database table for the User model.
     *
     * @var string
     */
    protected $table = "usuarios";

    protected $primaryKey = "id_usuario";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password', 'celular'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function empresas()
    {
        $empresas = $this->hasMany('App\Empresa', 'id_usuario');

        return $empresas;
    }

    public function paquete()
    {
        return $this->belongsTo('App\Paquete', 'id_paquete');
    }

    public function hasEmpresas(){
        return (bool)$this->empresas;
    }
}

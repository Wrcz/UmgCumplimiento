<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = 'usuarios';

    protected $fillable = [
        'idusuario','nombreusuario','idnivelusuario', 'correoelectronico','estadousuario','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
      return $this->password;
    }

}

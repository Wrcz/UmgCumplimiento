<?php

use Illuminate\Database\Seeder;

class UsuariosEmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      DB::table('usuarios_empresas')->insert([
        ['idusuario' => 1,'idempresa'=> 1,],
        ['idusuario' => 1,'idempresa'=> 2,],
        ['idusuario' => 1,'idempresa'=> 3,],
        ['idusuario' => 2,'idempresa'=> 1,],
        ['idusuario' => 3,'idempresa'=> 1,],
        ['idusuario' => 3,'idempresa'=> 3,]
        ]);
    }
}

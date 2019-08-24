<?php

use Illuminate\Database\Seeder;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('empresas')->delete();
      DB::statement('DBCC CHECKIDENT (empresas, RESEED, 0)');
      DB::table('empresas')->insert([
          ['nombreempresa' => 'EMPRESA 1','tipoindustria'=> 'Alimentos'    ,'direccion'=> 'Guatemala'   ,'correoelectronico'=> 'correo@gmail.com' ,'pais'=>'Guatemala','estadoempresa'=> true],
          ['nombreempresa' => 'EMPRESA 3','tipoindustria'=> 'Tecnologia'   ,'direccion'=> 'Guadalajara' ,'correoelectronico'=> 'correo@gmail.com' ,'pais'=>'Mexico'   ,'estadoempresa'=> true],
          ['nombreempresa' => 'EMPRESA 4','tipoindustria'=> 'Inmobiliaria' ,'direccion'=> 'Bogota'      ,'correoelectronico'=> 'correo@gmail.com' ,'pais'=>'Colombia' ,'estadoempresa'=> true]
    ]);
  }
}

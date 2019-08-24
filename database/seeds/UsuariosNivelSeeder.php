<?php

use Illuminate\Database\Seeder;

class UsuariosNivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios_empresas')->delete();
        DB::table('Usuarios')->delete();
        DB::table('Usuarios_Nivel')->delete();
        
        
        DB::statement('DBCC CHECKIDENT (usuarios_nivel, RESEED, 0)');
        DB::table('Usuarios_Nivel')->insert([
            ['nombrenivelusuario' => 'Administrador'],
            ['nombrenivelusuario' => 'Gerente'],
            ['nombrenivelusuario' => 'Auditor'],
            ['nombrenivelusuario' => 'Consulta']
        ]);

      }
}

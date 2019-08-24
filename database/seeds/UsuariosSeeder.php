<?php

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Usuarios')->delete();
      DB::statement('DBCC CHECKIDENT (Usuarios, RESEED, 0)');
      DB::table('Usuarios')->insert([
          ['idnivelusuario' => 1,'nombreusuario'=> 'william','correoelectronico'=> 'wrcz@hotmail.com' ,'password'=> bcrypt('12345'),'estadousuario'=> true],
          ['idnivelusuario' => 2,'nombreusuario'=> 'michael','correoelectronico'=> 'michael@gmail.com','password'=> bcrypt('12345'),'estadousuario'=> true],
          ['idnivelusuario' => 3,'nombreusuario'=> 'melany' ,'correoelectronico'=> 'melany@gmail.com' ,'password'=> bcrypt('12345'),'estadousuario'=> true],
          ['idnivelusuario' => 4,'nombreusuario'=> 'jose'   ,'correoelectronico'=> 'jose@gmail.com'   ,'password'=> bcrypt('12345'),'estadousuario'=> true],
          ['idnivelusuario' => 4,'nombreusuario'=> 'luis'   ,'correoelectronico'=> 'luis@gmail.com'   ,'password'=> bcrypt('12345'),'estadousuario'=> true]
      ]);
    }
}

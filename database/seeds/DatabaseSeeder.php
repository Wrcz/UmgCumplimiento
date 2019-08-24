<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuariosNivelSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(EmpresasSeeder::class);
        $this->call(UsuariosEmpresasSeeder::class);
    }
}

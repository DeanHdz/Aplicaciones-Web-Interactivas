<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //Crear un usuario de prueba con rol de administrador y de becario
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'role' => 'admin', // 'becario' o 'admin'
            'email' => 'admin@example.com',
            'password' => bcrypt('admin')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User Becario',
            'role' => 'becario', // 'becario' o 'admin'
            'email' => 'becario@example.com',
            'password' => bcrypt('becario')
        ]);
        

        //Crear un libro de prueba y un prestamo de prueba...
        /*
        \App\Models\Libro::factory()->create([
            'name' => 'Test Book'
        ]);

        \App\Models\Prestamo::factory()->create([
            'user_id' => 1,
            'libro_id' => 1
        ]);
        */
    }
}

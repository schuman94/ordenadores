<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aula;
use Illuminate\Support\Facades\DB;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aula::factory()->count(7)->create();

        DB::table('aulas')->insert([
            'codigo' => 'IF0',
            'nombre' => 'Informática',
        ]);
    }
}

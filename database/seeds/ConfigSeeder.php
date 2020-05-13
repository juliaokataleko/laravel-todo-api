<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'url' => 'http://juliaokataleko.github.io',
            'num_pages' => 10,
            'about' => 'Sobre a loja',
            'privacy_policy' => 'Política de Privacidade'
        ]);
    }
}

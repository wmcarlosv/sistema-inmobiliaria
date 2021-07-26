<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name'=>'Ciudad de Mexico'
        ]);

        DB::table('users')->insert([
            'name'=>'administrador',
            'email'=>'administrador@administrador.com',
            'password' => bcrypt('administrador'),
            'phone'=>'00000000000',
            'role'=>'admin'
        ]);
    }
}

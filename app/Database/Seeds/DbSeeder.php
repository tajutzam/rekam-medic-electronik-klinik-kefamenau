<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DbSeeder extends Seeder
{
    public function run()
    {
        //
        // $this->call(UserSeeder::class);
        $this->call(DiagnosaSeeder::class);
        $this->call(PasienSeeder::class);
        $this->call(ObatSeeder::class);
        $this->call(TindakanSeeder::class);
    }
}

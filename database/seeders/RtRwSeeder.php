<?php

namespace Database\Seeders;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Database\Seeder;

class RtRwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rt::create([
            'name' => '001'
        ]);
        Rw::create([
            'name' => '004'
        ]);
    }
}

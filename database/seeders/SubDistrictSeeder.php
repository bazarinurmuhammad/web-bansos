<?php

namespace Database\Seeders;

use App\Models\SubDistrict;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Sidoarjo',
            'Balongbendo',
            'Buduran',
            'Candi',
            'Gedangan',
            'Jabon',
            'Krembung',
            'Krian',
            'Prambon',
            'Porong',
            'Sedati',
            'Sukodono',
            'Taman',
            'Tanggulangin',
            'Tarik',
            'Tulangan',
            'Waru',
            'Wonoayu',
        ];

        foreach ($datas as $data) {
            SubDistrict::create([
                'name' => $data,
                'slug' => Str::slug($data)
            ]);
        }
    }
}

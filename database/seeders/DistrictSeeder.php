<?php

namespace Database\Seeders;

use App\Models\Districts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/mst_district.json');
        $json = File::get($jsonPath);
        $data = json_decode($json, true);

        foreach ($data as $item) {
            Districts::insert(
                [
                    'district_id' => $item['id'],
                    'ref_province_id' => $item['id_province'],
                    'district_name' => $item['district'],
                    'created_at' => now()
                ]
            );
        }
    }
}

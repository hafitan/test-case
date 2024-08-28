<?php

namespace Database\Seeders;

use App\Models\Districts;
use App\Models\Subdistricts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/mst_subdistrict.json');
        $json = File::get($jsonPath);
        $data = json_decode($json, true);

        foreach ($data as $item) {
            Subdistricts::insert(
                [
                    'subdistrict_id' => $item['id'],
                    'ref_district_id' => $item['id_district'],
                    'subdistrict_name' => $item['name'],
                    'created_at' => now()
                ]
            );
        }
    }
}

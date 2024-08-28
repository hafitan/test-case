<?php

namespace Database\Seeders;

use App\Models\ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/mst_ward.json');
        $json = File::get($jsonPath);
        $data = json_decode($json, true);

        foreach ($data as $item) {
            ward::insert(
                [
                    'ward_id' => $item['id'],
                    'ref_subdistrict_id' => $item['subdistrict_id'],
                    'ward_name' => $item['name'],
                    'created_at' => now()
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\File;
use App\Models\Provinces;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/mst_province.json');
        $json = File::get($jsonPath);
        $data = json_decode($json, true);

        foreach ($data as $item) {
            Provinces::insert(
                [
                    'province_id' => $item['id'],
                    'province_name' => $item['name'],
                    'created_at' => now()
                ]
            );
        }
    }
}

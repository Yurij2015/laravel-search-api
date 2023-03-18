<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->truncate();
        $csvData = fopen(base_path('public/files/data.csv'), 'rb');
        $row = true;
        while (($data = fgetcsv($csvData, 0, ',')) !== false) {
            if (!$row) {
                DB::table('hotels')->insert([
                    'name' => $data['0'],
                    'price' => $data['1'],
                    'bedrooms' => $data['2'],
                    'bathrooms' => $data['3'],
                    'storeys' => $data['4'],
                    'garages' => $data['5'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            $row = false;
        }
        fclose($csvData);
    }
}

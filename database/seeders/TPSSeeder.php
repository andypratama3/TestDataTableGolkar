<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TPSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($tpsNumber = 1; $tpsNumber <= 2500; $tpsNumber++) {
            // Cek apakah nomor TPS adalah 100 atau 1000 (atau kondisi lain yang sesuai)
            if ($tpsNumber === 100 || $tpsNumber === 1000) {
                $tpsName = 'TPS Inf'; // Jika ya, beri nama TPS sebagai "TPS Inf"
            } else {
                $tpsName = 'TPS ' . $tpsNumber; // Jika tidak, beri nama TPS sesuai nomornya
            }

            $slug = Str::slug($tpsName);

            DB::table('tps')->insert([
                'id' => Str::uuid(),
                'name' => $tpsName,
                'slug' => $slug,
            ]);
        }
    }
}

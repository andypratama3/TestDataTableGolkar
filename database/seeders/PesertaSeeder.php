<?php

namespace Database\Seeders;

use App\Models\Tps;
use App\Models\Desa;
use App\Models\Peserta;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        // Create 10,000 Peserta records with specified status and warna
        // Create 10,000 Peserta records with specified status and warna
        Peserta::factory()
            ->count(10000)
            ->create()
            ->each(function ($peserta) {
                // Randomly choose status (relawan or simpatisan)
                $status = ['relawan', 'simpatisan'];
                $selectedStatus = $status[rand(0, 1)];

                // Randomly choose one of the specified warna
                $warna = ['kuning', 'abu-abu', 'merah'];
                $selectedWarna = $warna[rand(0, 2)];

                $peserta->status = $selectedStatus;
                $peserta->warna = $selectedWarna;
                $peserta->save();

                // Attach Kecamatan, Desa, and Tps relationships (adjust as needed)
                $kecamatan = Kecamatan::inRandomOrder()->limit(3)->get();
                $desa = Desa::inRandomOrder()->limit(3)->get();
                $tps = Tps::inRandomOrder()->limit(3)->get();

                $peserta->kecamatan_pesertas()->attach($kecamatan);
                $peserta->desa_pesertas()->attach($desa);
                $peserta->tps_pesertas()->attach($tps);
            });
    }
}

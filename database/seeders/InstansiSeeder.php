<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InstansiSeeder extends Seeder
{
    public function run()
    {
        $instansis = [
            'Bina Utama',
            'Sinar Mandiri',
            'Pusaka Sejahtera',
            'Cipta Karya',
            'Artha Mandiri',
            'Tunas Jaya',
            'Mega Solusi',
            'Cahaya Utama',
            'Alam Lestari',
            'Terang Abadi',
        ];

        foreach ($instansis as $instansi) {
            DB::table('instansi')->insert([
                'id' => (string) Str::uuid(),
                'nama_instansi' => $instansi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

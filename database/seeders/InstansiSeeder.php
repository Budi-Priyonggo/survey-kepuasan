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
            'Instansi Pendidikan Nasional',
            'Kementerian Kesehatan Republik Indonesia',
            'Badan Pemeriksa Keuangan (BPK)',
            'Lembaga Ilmu Pengetahuan Indonesia (LIPI)',
            'Universitas Indonesia',
            'Dinas Pendidikan Provinsi Jawa Barat',
            'Bank Negara Indonesia (BNI)',
            'Kantor Pemerintahan Kota Jakarta',
            'Badan Meteorologi, Klimatologi, dan Geofisika (BMKG)',
            'Kementerian Perdagangan Republik Indonesia',
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

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Instansi;

class HasilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua instansi
        $instansis = Instansi::all();

        foreach ($instansis as $instansi) {
            // Menambahkan 10 data hasil untuk setiap instansi
            for ($i = 0; $i < 10; $i++) {
                DB::table('hasil')->insert([
                    'id' => $faker->uuid,
                    'instansi_id' => $instansi->id, // Hubungkan hasil dengan instansi yang sesuai
                    'kepuasan' => $faker->randomElement([
                        'Sangat Puas',
                        'Puas',
                        'Cukup Puas',
                        'Tidak Puas'
                    ]),
                    'pungutan' => $faker->randomElement([
                        'Ada',
                        'Tidak Ada'
                    ]),
                    'saran' => $faker->randomElement([
                        'Meningkatkan kualitas pelayanan.',
                        'Harga lebih terjangkau.',
                        'Perbaiki fasilitas.',
                        'Tambah varian layanan.',
                        'Lebih memperhatikan kebersihan.',
                        'Lebih cepat dalam memberikan layanan.',
                        'Pelayanan pelanggan harus lebih ramah.',
                        'Proses administrasi lebih mudah.',
                        'Fasilitas harus lebih lengkap.',
                        'Layanan harus lebih efisien.'
                    ]),
                    'created_at' => $faker->dateTimeBetween('2025-01-01', '2025-07-01'), 
                    'updated_at' => $faker->dateTimeBetween('2025-01-01', '2025-07-01'), 
                ]);
            }
        }
    }
}

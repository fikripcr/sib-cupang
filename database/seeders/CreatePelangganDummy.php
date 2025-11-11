<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePelangganDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Factory::create();

        // foreach (range(1, 100) as $index) {
        //     DB::table('pelanggan')->insert([
        //         'first_name' => $faker->firstName,
        //         'last_name'  => $faker->lastName,
        //         'birthday'   => $faker->date('Y-m-d', '2005-12-31'),
        //         'gender'     => $faker->randomElement(['Male', 'Female', 'Other']),
        //         'email'      => $faker->unique()->safeEmail,
        //         'phone'      => $faker->phoneNumber,
        //     ]);
        // }

        // 1. Inisialisasi Faker
        // Kita gunakan locale 'id_ID' agar datanya lebih terlihat seperti data Indonesia
        $faker = Faker::create('ar');

        // 2. Siapkan array kosong untuk menampung data
        $pelanggans = [];

        // 3. Tentukan jumlah data yang ingin dibuat (misal: 50)
        $jumlahData = 50;

        // 4. Daftar pilihan untuk gender, sesuai ENUM
        $genderOptions = ['Male', 'Female', 'Other', 'Prefer Not To Say'];

        // 5. Looping untuk membuat data dummy
        for ($i = 0; $i < $jumlahData; $i++) {
            $pelanggans[] = [
                // 'pelanggan_id' dikosongkan karena AUTO_INCREMENT
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'birthday' => $faker->date(), // 80% kemungkinan tidak null
                'gender' => $faker->optional(0.9)->randomElement($genderOptions), // 90% kemungkinan tidak null
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->optional(0.7)->phoneNumber(), // 70% kemungkinan tidak null
                // 'created_at' => Carbon::now(),
                // 'updated_at' => Carbon::now(),
            ];
        }

        // 6. Masukkan semua data ke database sekaligus (lebih efisien)
        // Pastikan nama tabel 'pelanggans' sudah benar
        DB::table('pelanggan')->insert($pelanggans);

    }
}

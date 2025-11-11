<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data['name']     = 'Admin';
        $data['email']    = 'gatot@pcr.ac.id';
        $data['password'] = Hash::make('gatotkaca');
        User::create($data);
    

        // User::create([
        //     'name'     => 'Admin',
        //     'email'    => 'gatot@pcr.ac.id',
        //     'password' => Hash::make('gatotkaca'),
        // ]);
    }
}

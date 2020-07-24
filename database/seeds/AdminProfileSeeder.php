<?php
use App\User;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'mranurag101@gmail.com',
            'password' => Hash::make('1234567890'),
            'status' => 1,
            'role' => 'admin',
            'phone' => '8957369585',
            'address' => 'Delhi',
            'gender' => 'Male',
            'dob' => '1992-09-26',
            'doj' => '2020-07-22',
        ]);
    }
}

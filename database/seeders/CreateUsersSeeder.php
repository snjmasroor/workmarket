<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
               'user_id' => (String) Str::uuid(), 
                'name'=>'Super Admin',
               'email'=>'superadmin@itsolutionstuff.com',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
                'user_id' => (String) Str::uuid(), 
               'name'=>'Admin User',
               'email'=>'admin@itsolutionstuff.com',
               'type'=> 2,
               'password'=> bcrypt('123456'),
            ],
            [
               'user_id' => (String) Str::uuid(), 
               'name'=>'User',
               'email'=>'user@itsolutionstuff.com',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
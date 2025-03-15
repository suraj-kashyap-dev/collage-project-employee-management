<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = [
            [ 'role_id' => 1, 'name' => 'Example', 'email' => 'admin@example.com', 'phone' => '+91 (987) 65-43210', 'status' => 1, 'password' => Hash::make('admin123') ],
            [ 'role_id' => 1, 'name' => 'Priya Verma', 'email' => 'priya.verma@gmail.com', 'phone' => '+91 (876) 54-32109', 'status' => 1, 'password' => Hash::make('admin123') ],
            [ 'role_id' => 2, 'name' => 'Ravi Patel', 'email' => 'ravi.patel@gmail.com', 'phone' => '+91 (765) 43-21098', 'status' => 1, 'password' => Hash::make('ravi@123') ],
            [ 'role_id' => 3, 'name' => 'Sunita Joshi', 'email' => 'sunita.joshi@gmail.com', 'phone' => '+91 (654) 32-10987', 'status' => 1, 'password' => Hash::make('sunita@123') ],
            [ 'role_id' => 3, 'name' => 'Vikas Gupta', 'email' => 'vikas.gupta@gmail.com', 'phone' => '+91 (543) 21-09876', 'status' => 1, 'password' => Hash::make('vikas@123') ],
            [ 'role_id' => 4, 'name' => 'Meera Kapoor', 'email' => 'meera.kapoor@gmail.com', 'phone' => '+91 (432) 10-98765', 'status' => 1, 'password' => Hash::make('meera@123') ],
            [ 'role_id' => 5, 'name' => 'Arjun Mehta', 'email' => 'arjun.mehta@gmail.com', 'phone' => '+91 (321) 09-87654', 'status' => 1, 'password' => Hash::make('arjun@123') ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
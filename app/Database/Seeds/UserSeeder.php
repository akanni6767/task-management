<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            "username" => "Softdeph",
            "email" => "softdephjs@gmail.com",
            "password" => password_hash("1234567", PASSWORD_BCRYPT)
        );

        $this->db->table("users")->insert($data);
    }
}

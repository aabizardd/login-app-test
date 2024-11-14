<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['username', 'password']; // Field yang dapat diakses

    // Fungsi untuk memeriksa kredensial login
    public function checkLogin($username, $password)
    {
        $user = $this->where('username', $username)->first();

        // Jika pengguna ditemukan dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}

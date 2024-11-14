<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->checkLogin($username, $password);

        if ($user) {
            // Simpan data user ke session
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'logged_in' => true
            ]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Login berhasil']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Username atau password salah']);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

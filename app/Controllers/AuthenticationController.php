<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthenticationController extends BaseController
{
    public function index()
    {
        $header['title'] = 'Login Page';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/footer');
        return view('login');
    }

    public function login()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Retrieve the user from the database
        $user = $userModel->getUserByUsername($username);

        // Verify the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Store user data in session
            $sessionData = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ];
            $session->set($sessionData);

            return redirect()->to('/dashboard');
        } else {
            // Authentication failed
            $session->setFlashdata('error', 'login gagal harap cek username atau pasword anda.');
            return redirect()->back();
        }
    }
}

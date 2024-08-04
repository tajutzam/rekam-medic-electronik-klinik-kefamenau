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
        echo view('partial/footer');
        return view('login');
    }

    public function login()
    {
        $session = session();
        $userModel = new UserModel();
        $validation = \Config\Services::validation();
    
        // Set validation rules
        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Check if validation passes
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed
            $session->setFlashdata('error', 'Harap isi username dan password.');
            return redirect()->back()->withInput();
        }
    
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
            $session->setFlashdata('error', 'Login gagal, harap cek username atau password Anda.');
            return redirect()->back();
        }
    }
    


    public function logout()
    {
        $session = session();
        session()->destroy();
        return redirect()->to('/login')->with('success', 'berhasil logout');
    }
}

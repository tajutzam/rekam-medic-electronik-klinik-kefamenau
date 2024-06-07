<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();
        $data['users'] = $users;
        $header['title'] = 'User';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('user/index', $data); // Mengirim data ke view
    }


    public function store()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'role' => 'required',
            'username' => 'required|is_unique[users.username]',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $userModel = new UserModel();
        $password = $this->request->getPost('password');
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'role' => $this->request->getPost('role'),
            'jabatan' => $this->request->getPost('jabatan'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        // Simpan data ke dalam database
        $userModel->insert($data);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }


    public function delete($id)
    {

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            // Tampilkan pesan error jika pengguna tidak ditemukan
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan!');
        }

        // Hapus pengguna dari database
        $userModel->delete($id);

        // Redirect kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }


    public function update()
    {

        // Tampilkan data yang diterima untuk debugging
        var_dump($this->request->getPost());

        // Konfigurasi validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'role' => 'required',
            'username' => 'required',
        ]);

        // Jalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Instansiasi model
        $userModel = new UserModel();

        // Ambil data dari request
        $id = $this->request->getPost('id');
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'role' => $this->request->getPost('role'),
            'jabatan' => $this->request->getPost('jabatan'),
            'username' => $this->request->getPost('username'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Update data di database
        $userModel->update($id, $data);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }
}

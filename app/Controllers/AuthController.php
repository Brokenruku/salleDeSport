<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/client/creneaux');
        }
        return view('auth/login');
    }

    public function loginPost()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user  = $model->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
        }

        session()->set([
            'user_id'   => $user['id'],
            'user_name' => $user['nom'],
            'user_role' => $user['role'],
        ]);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }
        return redirect()->to('/client/creneaux');
    }

    public function register()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/client/creneaux');
        }
        return view('auth/register');
    }

    public function registerPost()
    {
        $rules = [
            'nom'              => 'required|min_length[2]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $model->insert([
            'nom'      => $this->request->getPost('nom'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'client',
        ]);

        return redirect()->to('/login')->with('success', 'Compte créé. Vous pouvez vous connecter.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

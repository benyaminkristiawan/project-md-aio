<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            $sessionData = [
                'id'       => $user['id'],
                'username' => $user['username'],
                'name' => $user['name'],
                'role'     => $user['role'], // superadmin, sellin,spv sell in, sellout, spv sellout
                'isLoggedIn' => true
            ];
            session()->set($sessionData);

            // Redirect based on role
            switch ($user['role']) {
                case 'superadmin':
                    return redirect()->to('/superadmin/dashboard');
                case 'sellin':
                    return redirect()->to('/sellin/dashboard');
                case 'sellout':
                    return redirect()->to('/sellin/dashboard');
                case 'spvsellin':
                    return redirect()->to('/spvsellin/dashboard');
                case 'spvsellout':
                    return redirect()->to('/spvsellout/dashboard');
                default:
                    return redirect()->to('/login')->with('error', 'Invalid role');
            }
        } else {
            // Invalid login
            return redirect()->back()->with('error', 'Invalid credentials')->withInput();
        }
    }
    public function resetPassword()
    {
        return view('reset_password');
    }

    public function updatePassword()
    {
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');

        // Fetch user based on session ID
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('id'));

        // Check if user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Check if current password is correct
        if (!password_verify($current_password, $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Check if new passwords match
        if ($new_password !== $confirm_password) {
            return redirect()->back()->with('error', 'New passwords do not match.');
        }

        // Update the user's password in the database
        $userModel->update($user['id'], ['password' => password_hash($new_password, PASSWORD_DEFAULT)]);

        // Redirect based on user role
        switch ($user['role']) { // Assuming 'role' column exists in your users table
            case 'superadmin':
                return redirect()->to('/superadmin/dashboard')->with('success', 'Password successfully updated.');
            case 'sellin':
                return redirect()->to('/sellin/dashboard')->with('success', 'Password successfully updated.');
            case 'sellout':
                return redirect()->to('/sellin/dashboard')->with('success', 'Password successfully updated.');
            case 'spvsellin':
                return redirect()->to('/spvsellin/dashboard')->with('success', 'Password successfully updated.');
            case 'spvsellout':
                return redirect()->to('/spvsellout/dashboard')->with('success', 'Password successfully updated.');
            default:
                return redirect()->to('/')->with('success', 'Password successfully updated.');
        }
    }


    public function noAccess()
    {
        return view('errors/no-access');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function register()
    {
        // Load the registration form view
        return view('auth/register');
    }

    public function registration()
    {
        helper(['form', 'url']);

        // Load the validation library
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            'name'     => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'phone'    => 'permit_empty|min_length[10]|max_length[15]',
            'address'  => 'permit_empty|max_length[255]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, show the form again with errors
            return view('register_view', ['validation' => $validation]);
        }

        // Get form data
        $name     = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $phone    = $this->request->getPost('phone');
        $address  = $this->request->getPost('address');

        // Prepare data for insertion
        $data = [
            'name'     => $name,
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'phone'    => $phone,
            'address'  => $address,
            'role'     => 'visitor' // Automatically assign "visitor" role
        ];

        // Load the User model and save data
        $userModel = new UserModel();
        $userModel->save($data);

        // Redirect to a success page or login page
        return redirect()->to('/')->with('success', 'Registration successful! Please log in.');
    }
}

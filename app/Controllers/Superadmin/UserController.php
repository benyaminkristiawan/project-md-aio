<?php

namespace App\Controllers\Superadmin;

use App\Models\UserModel;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    // Dashboard view
    public function index()
    {
        $userModel = new UserModel();
        // Get the brand code from the session
        $data['user'] = $userModel->findAll();

        // Pass the brand code to the view
        return view('user/manage_user', $data);
    }

    public function addUser()
    {
        return view('user/add_user');
    }

    public function saveUser()
    {
        // Get the request data
        $data = $this->request->getPost();

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'    => 'required|max_length[255]',
            'username' => 'required|min_length[3]|max_length[255]',
            'email'    => 'required|valid_email|max_length[255]',
            'address'    => 'required|max_length[255]',
            'phone'    => 'required|max_length[255]',
            'password' => 'required|min_length[6]',
            'password-confirm'  => 'required|matches[password]',
            'role'     => 'required|in_list[spvsellin,sellin,spvsellout,sellout]',  // Restrict to 'admin' and 'user'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, return to the form with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Hash the password
        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

        // Save user data to the database
        $userModel = new UserModel();
        $userModel->insert([
            'name' => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => $passwordHash,
            'address' => $data['address'],
            'phone' => $data['phone'],
            'role'     => $data['role'],  // 'admin' or 'user'
        ]);
        // Redirect to the user list or a success page
        return redirect()->to('superadmin/user')->with('success', 'User created successfully');
    }

    public function editUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/superadmin/user')->with('error', 'User not found.');
        }

        return view('user/edit_user', ['user' => $user]);
    }


    public function updateUser($id)
    {
        $userModel = new UserModel();

        // Retrieve input data from the request
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'role' => $this->request->getPost('role'),  // 'admin' or 'user'
        ];

        // Update the user in the database
        if (!$userModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Failed to update User.');
        }

        return redirect()->to('/superadmin/user')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/superadmin/user');
    }

    public function resetPassword($id)
    {
        $userModel = new UserModel();

        // Fetch the user's details
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Generate a temporary password
        $temporaryPassword = bin2hex(random_bytes(4)); // 8-character random string
        $hashedPassword = password_hash($temporaryPassword, PASSWORD_DEFAULT);

        // Update the user's password
        if (!$userModel->update($id, ['password' => $hashedPassword])) {
            return redirect()->back()->with('error', 'Failed to reset password.');
        }

        // Replace (name) with the user's name in the success message
        $userName = $user['name']; // Assuming 'name' is the column for the user's name
        return redirect()->back()->with('success', 'Password User ' . $userName . ' terganti, Password Sementara: ' . $temporaryPassword);
    }
}

<?php

namespace App\Controllers;

use App\Models\ConfirmationModel;

class AdminController extends BaseController
{
    public function dashboard(): string
    {
        if (session()->get('role') !== 'admin' && session()->get('role') !== 'superadmin') {
            return redirect()->to('/no-access'); // Redirect if unauthorized
        }

        //     // Authorized users (admins and superadmins) proceed with fetching the data
        //     $confirmation_model = new ConfirmationModel();

        //                 // Count products by status
        // $data['count_all'] = $confirmation_model->whereIn('status', ['confirmed', 'rejected', 'approved'])->countAllResults();
        // $data['count_confirmed'] = $confirmation_model->where('status', 'confirmed')->countAllResults();
        // $data['count_rejected'] = $confirmation_model->where('status', 'rejected')->countAllResults();
        // $data['count_approved'] = $confirmation_model->where('status', 'approved')->countAllResults();
        //     // Fetch records where the status is either "confirmed", "rejected", or "approved"
        //     $data['all_products'] = $confirmation_model
        //     ->whereIn('status', ['confirmed', 'rejected', 'approved'])
        //     ->orderBy("FIELD(status, 'confirmed', 'approved', 'rejected')") // Ensures 'confirmed' appears first
        //     ->findAll();
        //     // Pass data to the view
        return view('admin/dashboard');
    }


    public function product()
    {
        // Check if the user has the required role (admin or superadmin)
        if (session()->get('role') !== 'admin' && session()->get('role') !== 'superadmin') {
            return redirect()->to('/no-access'); // Redirect if unauthorized
        }

        // Authorized users (admins and superadmins) proceed with fetching the data
        $confirmation_model = new ConfirmationModel();

        // Fetch only records where status is "confirmed"
        $data['confirmed_products'] = $confirmation_model->where('status', 'confirmed')->findAll();

        // Pass data to the view
        return view('admin/list_product', $data);
    }

    public function productDetails($productId)
    {
        $this->confirmationModel = new ConfirmationModel();
        // Fetch product details based on productId
        $product = $this->confirmationModel->find($productId);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Product with ID $productId not found");
        }

        return view('admin/details', [
            'product' => $product
        ]);
    }
}

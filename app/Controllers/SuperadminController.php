<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ConfirmationModel;
use App\Models\MarketplaceModel;

class SuperadminController extends BaseController
{
    public function dashboard(): string
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/no-access'); // Redirect if unauthorized
        }
        // // Authorized users (admins and superadmins) proceed with fetching the data
        // $confirmation_model = new ConfirmationModel();

        //     // Count products by status
        // $data['count_all'] = $confirmation_model->whereIn('status', ['confirmed', 'rejected', 'approved'])->countAllResults();
        // $data['count_confirmed'] = $confirmation_model->where('status', 'confirmed')->countAllResults();
        // $data['count_rejected'] = $confirmation_model->where('status', 'rejected')->countAllResults();
        // $data['count_approved'] = $confirmation_model->where('status', 'approved')->countAllResults();

        // // Fetch records where the status is either "confirmed", "rejected", or "approved"
        // $data['all_products'] = $confirmation_model
        // ->whereIn('status', ['confirmed', 'rejected', 'approved'])
        // ->orderBy("FIELD(status, 'confirmed', 'approved', 'rejected')") // Ensures 'confirmed' appears first
        // ->findAll();
        // Pass data to the view
        return view('superadmin/dashboard');
    }

    // public function product()
    // {
    //     // Check if the user has the required role (admin or superadmin)
    //     if (session()->get('role') !== 'superadmin') {
    //         return redirect()->to('/no-access'); // Redirect if unauthorized
    //     }

    //     // Authorized users (admins and superadmins) proceed with fetching the data
    //     $confirmation_model = new ConfirmationModel();

    //     // Fetch only records where status is "confirmed"
    //     $data['confirmed_products'] = $confirmation_model->where('status', 'confirmed')->findAll();

    //     // Pass data to the view
    //     return view('superadmin/list_product', $data);
    // }

    public function marketplace()
    {
        // Check if the user has the required role (admin or superadmin)
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/no-access'); // Redirect if unauthorized
        }

        // Authorized users (admins and superadmins) proceed with fetching the data
        $marketplace_model = new MarketplaceModel();

        // Fetch only records where status is "confirmed"
        $data['marketplaces'] = $marketplace_model->findAll();

        // Pass data to the view
        return view('superadmin/marketplace', $data);
    }

    public function saveMarketplace()
    {
        $marketplaceModel = new MarketplaceModel();

        $data = [
            'location' => $this->request->getPost('location'),
            'phone' => $this->request->getPost('phone'),
        ];
        if (!$marketplaceModel->save($data)) {
            return redirect()->back()->with('error', 'Failed to add Marketplace.');
        }

        return redirect()->to('/superadmin/marketplace')->with('success', 'Marketplace added successfully.');
    }

    public function updateMarketplace($id)
    {

        $marketplaceModel = new MarketplaceModel();

        $data = [
            'location' => $this->request->getPost('location'),
            'phone' => $this->request->getPost('phone'),
        ];
        // Update the Brand  in the database
        if (!$marketplaceModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Failed to update Marketplace.');
        }

        return redirect()->to('/superadmin/marketplace')->with('success', 'Marketplace  updated successfully.');
    }

    public function deleteMarketplace($id)
    {
        $marketplaceModel = new MarketplaceModel();
        $marketplaceModel->delete($id);
        return redirect()->to('/superadmin/marketplace');
    }
}

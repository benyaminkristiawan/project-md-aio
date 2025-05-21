<?php
namespace App\Controllers\Admin;

use App\Models\BrandModel;
use App\Controllers\BaseController;

class BrandController extends BaseController
{
    // Dashboard view
    public function index()
    {   
        $brandModel = new BrandModel();
        // Get the brand code from the session
        $data['brand'] = $brandModel->findAll();
    
        // Pass the brand code to the view
        return view('brand/brand', $data);
    }

    public function saveBrand()
    {
    $brandModel = new BrandModel();

    $data = [
        'code' => $this->request->getPost('code'),
        'name' => $this->request->getPost('name'),
    ];

    $data['code'] = strtoupper($data['code']);
    $data['name'] = strtoupper($data['name']);

    if (!$brandModel->save($data)) {
        return redirect()->back()->with('error', 'Failed to add Brand.');
    }
    
    
    return redirect()->to('/admin/brand')->with('success', 'Brand added successfully.');
    }

    public function updateBrand($id)
    {

        $brandModel = new BrandModel();

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
        ];

        $data['code'] = strtoupper($data['code']);
        $data['name'] = strtoupper($data['name']);
        // Update the Brand  in the database
        if (!$brandModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Failed to update Brand.');
        }

        return redirect()->to('/admin/brand')->with('success', 'Brand  updated successfully.');
    }

    public function deleteBrand($id)
    {
        $brandModel = new BrandModel();
        
        if (!$brandModel->find($id)) {
            return redirect()->to('/admin/brand')->with('error', 'Subcategory not found.');
        }
        
        
        if (!$brandModel->find($id)) {
            return redirect()->to('/admin/brand')->with('error', 'Subcategory not found.');
        }
        
        $brandModel->delete($id);
        
        return redirect()->to('/admin/brand')->with('success', 'Subcategory deleted successfully.');
        
        return redirect()->to('/admin/brand')->with('success', 'Subcategory deleted successfully.');
    }
}
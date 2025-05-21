<?php
namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Controllers\BaseController;

class KategoriController extends BaseController
{
    // Dashboard view
    public function index()
    {   
        $kategoriModel = new CategoryModel();
        // Get the kategori code from the session
        $data['kategori'] = $kategoriModel->findAll();
    
        // Pass the kategori code to the view
        return view('kategori/kategori', $data);
    }

    public function saveKategori()
    {
    $kategoriModel = new CategoryModel();

    $data = [
        'name' => $this->request->getPost('name'),
    ];
    
    $data['name'] = strtoupper($data['name']);

    if (!$kategoriModel->save($data)) {
        return redirect()->back()->with('error', 'Failed to add Category.');
    }

    $data['name'] = strtoupper($data['name']);
    return redirect()->to('/admin/kategori')->with('success', 'Category added successfully.');
    }

    public function updateKategori($id)
    {

        $kategoriModel = new CategoryModel();

        $data = [
            'name' => $this->request->getPost('name'),
        ];

        $data['name'] = strtoupper($data['name']);
        // Update the Kategori  in the database
        if (!$kategoriModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Failed to update Kategori.');
        }

        return redirect()->to('/admin/kategori')->with('success', 'Kategori updated successfully.');
    }

    public function deleteKategori($id)
    {
        $kategoriModel = new CategoryModel();
        $kategoriModel->delete($id);
        return redirect()->to('/admin/kategori');
    }
}
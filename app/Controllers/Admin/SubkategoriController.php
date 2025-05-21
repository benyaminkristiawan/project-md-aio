<?php
namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use App\Controllers\BaseController;

class SubkategoriController extends BaseController
{
    // Dashboard view
    public function index()
    {
        $subcategoryModel = new SubcategoryModel();
        $categoryModel = new CategoryModel();

        $subcategoryId = $this->request->getVar('id'); // or from URL parameter if passed via URL

    
        // Assuming you're editing an existing subcategory, get the selected category ID
        $selected_category_id = null;
        if ($subcategoryId) {
            $subcategory = $subcategoryModel->find($subcategoryId);
            if ($subcategory) {
                $selected_category_id = $subcategory['category_id']; // Get the category ID
            }
        }
    
        $data['subkategori'] = $subcategoryModel->getSubcategoriesWithCategory(); // Get subcategories with category data
        $data['categories'] = $categoryModel->getCategories(); // Fetch categories for the dropdown
        $data['selected_category_id'] = $selected_category_id; // Pass the selected category ID to the view
        $data['subcategoryId'] = $subcategoryId;

        usort($data['categories'], function ($a, $b) {
            return strcmp($a['name'], $b['name']); // Replace 'category' with the actual column name in your table
        });

        return view('subkategori/subkategori', $data); // Pass the data to the view
    }
    
    public function saveSubkategori()
    {
        $subcategoryModel = new SubcategoryModel();
        
        // Validate input
        $this->validate([
            'name' => 'required',
            'category_id' => 'required|is_not_unique[categories.id]', // Check if category_id exists
        ]);
    
        // Save subcategory with the category_id
        $data = [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'), // Get category_id from the form
        ];
        
        
    $data['name'] = strtoupper($data['name']);
        $subcategoryModel->save($data);
        
        return redirect()->to('/admin/subkategori')->with('success', 'Subcategory added successfully.');
    }
    
    public function updateSubkategori($id)
    {
        $subcategoryModel = new SubcategoryModel();
    
        // Validate input
        $this->validate([
            'name' => 'required',
            'category_id' => 'required|is_not_unique[categories.id]', // Check if category_id exists
        ]);
    
        $data = [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'), // Update category_id
        ];
    
        $data['name'] = strtoupper($data['name']);
        // Update the Subkategori in the database
        if (!$subcategoryModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Failed to update Subkategori.');
        }
    
        return redirect()->to('/admin/subkategori')->with('success', 'Subcategory updated successfully.');
    }
    

    public function deleteSubkategori($id)
    {
        $subcategoryModel = new SubcategoryModel();
        
        if (!$subcategoryModel->find($id)) {
            return redirect()->to('/admin/subkategori')->with('error', 'Subcategory not found.');
        }
        
        $subcategoryModel->delete($id);
        
        return redirect()->to('/admin/subkategori')->with('success', 'Subcategory deleted successfully.');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;




class CategoryController extends Controller
{
    public function index()
    {
        // Fetch categories from the database
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    
    public function show(Category $category)
    {
        // Show a specific category
        return view('dashboard.categories.show', ['category' => $category]);
    }

    public function edit(Category $category)
    {
        // Fetch the category data and pass it to the view
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Update a specific category
        $category->update($request->all());
        return redirect()->route('dashboard.categories');
    }

    public function destroy(Category $category)
    {
    $category->delete();

    return redirect()->route('dashboard.categories')->with('success', 'Category deleted successfully');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'categoryName' => [
                'required',
                'max:255',
                Rule::unique('categories', 'name'), // Ensure 'name' is unique in the 'categories' table
            ],
        ]);

        // Create a new category using the validated data
        $category = Category::create([
            'name' => $validatedData['categoryName'],
            // Add more fields as necessary
        ]);

        // Optionally, redirect back or to a specific page after adding the category
        return redirect()->back()->with('success', 'Category added successfully');
    }
}

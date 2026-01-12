<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index');
    }

public function destroy($id)
{
    $category = Category::findOrFail($id);

    if ($category->patterns()->count() > 0) {
        
        return redirect()->route('categories.index')
                         ->with('error', 'Cannot delete category because it has linked patterns.');
    }

    $category->delete();

    return redirect()->route('categories.index')
                     ->with('success', 'Category deleted successfully.');
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatternController extends Controller
{
    public function index(Request $request)
    {
        $query = Pattern::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'latest') {
                $query->orderBy('created_at', 'desc');
            }
        }

        $patterns = $query->get();
        $categories = Category::all();

        return view('patterns.index', compact('patterns', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('patterns.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'description' => 'nullable|string',
            'preview_image' => 'required|image|max:2048',
            'pattern_pdf' => 'required|mimes:pdf|max:10240',
        ]);

        $pattern = Pattern::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'difficulty' => $request->difficulty,
            'description' => $request->description,
            'preview_image' => $request->file('preview_image')->store('images', 'public'),
            'pattern_pdf' => $request->file('pattern_pdf')->store('pdfs', 'public'),
        ]);

        return redirect()->route('patterns.show', $pattern->slug);
    }

    public function show($slug)
    {
        $pattern = Pattern::where('slug', $slug)
            ->with('sizes', 'category')
            ->firstOrFail();

        return view('patterns.show', compact('pattern'));
    }

    public function edit($slug)
    {
        $pattern = Pattern::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        return view('patterns.edit', compact('pattern', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $pattern = Pattern::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'description' => 'required|string',
        ]);

        $pattern->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'difficulty' => $request->difficulty,
            'description' => $request->description,
        ]);

        return redirect()->route('patterns.show', $pattern->slug);
    }

    public function destroy($slug)
    {
        $pattern = Pattern::where('slug', $slug)->firstOrFail();
        $pattern->delete();

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


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

        if ($request->sort === 'title') {
    $query->orderBy('title');
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
            'preview_image' => 'required|image|max:4096',
            'pattern_pdf' => 'required|mimes:pdf|max:10240',
        ]);

        $blocked = ['random', 'test', 'abc'];
        if (in_array(strtolower($request->title), $blocked)) {
            return back()->withErrors([
                'title' => 'This title is too generic. Please choose a descriptive title.'
            ])->withInput();
        }

        $response = Http::get('https://api.unsplash.com/search/photos', [
            'query' => $request->title . ' sewing pattern',
            'client_id' => config('services.unsplash.key'),
            'per_page' => 1
        ]);


        $results = $response->json('results');

        if ($response->failed() || empty($results)) {
            return back()->withErrors([
                'title' => 'No sewing-related images were found for this pattern title. Please choose a more descriptive title.'
            ])->withInput();
        }

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
            'description' => 'nullable|string',
            'preview_image' => 'nullable|image|max:2048',
            'pattern_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = [
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'category_id' => $request->category_id,
        'difficulty' => $request->difficulty,
        'description' => $request->description,
        ];
        
        if ($request->hasFile('preview_image')) {
            $data['preview_image'] = $request
                ->file('preview_image')
                ->store('images', 'public');
        }

        if ($request->hasFile('pattern_pdf')) {
            $data['pattern_pdf'] = $request
                ->file('pattern_pdf')
                ->store('pdfs', 'public');
        }

        $pattern->update($data);

        return redirect()->route('patterns.show', $pattern->slug)
            ->with('success', 'Pattern updated successfully');
    }

    public function destroy($slug)
    {
        $pattern = Pattern::where('slug', $slug)->firstOrFail();
        $pattern->delete();

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\PatternSize;
use Illuminate\Http\Request;

class PatternSizeController extends Controller
{
    public function store(Request $request, $slug)
    {
        $pattern = Pattern::where('slug', $slug)->firstOrFail();

        $request->validate([
            'size_label' => 'required|string|max:50',
            'measurements' => 'nullable|string',
            'pdf_path' => 'nullable|mimes:pdf|max:10240',
        ]);

        PatternSize::create([
            'pattern_id' => $pattern->id,
            'size_label' => $request->size_label,
            'measurements' => $request->measurements,
            'pdf_path' => $request->file('pdf_path')
                ? $request->file('pdf_path')->store('size_pdfs', 'public')
                : null,
        ]);

        return back();
    }

    public function destroy($id)
{
    $size = PatternSize::findOrFail($id);
    $size->delete();

    return back()->with('success', 'Size deleted successfully.');
}

}

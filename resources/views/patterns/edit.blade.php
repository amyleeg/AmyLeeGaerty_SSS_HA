@extends('layouts.app')

@section('content')
<h1>Edit Pattern</h1>

<form method="POST"
      action="{{ route('patterns.update', $pattern->slug) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <input class="form-control mb-2"
           name="title"
           value="{{ $pattern->title }}">

    <select class="form-control mb-2" name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @selected($pattern->category_id == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select class="form-control mb-2" name="difficulty">
        <option value="beginner" @selected($pattern->difficulty=='beginner')>Beginner</option>
        <option value="intermediate" @selected($pattern->difficulty=='intermediate')>Intermediate</option>
        <option value="advanced" @selected($pattern->difficulty=='advanced')>Advanced</option>
    </select>

    <textarea class="form-control mb-2"
              name="description">{{ $pattern->description }}</textarea>

    <p><strong>Replace Preview Image (optional)</strong></p>
    <input type="file" name="preview_image" class="form-control mb-2">

    <p><strong>Replace PDF (optional)</strong></p>
    <input type="file" name="pattern_pdf" class="form-control mb-2">

    <button class="btn btn-primary">Update Pattern</button>
</form>
@endsection

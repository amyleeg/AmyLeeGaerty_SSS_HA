@extends('layouts.app')

@section('content')
<h1>Submit New Pattern</h1>

<form method="POST" action="{{ route('patterns.store') }}" enctype="multipart/form-data">
    @csrf

    <input class="form-control mb-2" name="title" placeholder="Title">

    <select class="form-control mb-2" name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <select class="form-control mb-2" name="difficulty">
        <option value="beginner">Beginner</option>
        <option value="intermediate">Intermediate</option>
        <option value="advanced">Advanced</option>
    </select>

    <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>

    <input type="file" name="preview_image" class="form-control mb-2">
    <input type="file" name="pattern_pdf" class="form-control mb-2">

    <button class="btn btn-primary">Save Pattern</button>
</form>
@endsection

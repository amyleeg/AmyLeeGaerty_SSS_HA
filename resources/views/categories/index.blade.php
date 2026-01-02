@extends('layouts.app')

@section('content')
<h1>Categories</h1>

<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
    Add New Category
</a>

<ul class="list-group">
@foreach($categories as $category)
    <li class="list-group-item d-flex justify-content-between">
        {{ $category->name }}
        <span class="badge bg-primary">
            {{ $category->patterns->count() }} patterns
        </span>
    </li>
@endforeach
</ul>
@endsection

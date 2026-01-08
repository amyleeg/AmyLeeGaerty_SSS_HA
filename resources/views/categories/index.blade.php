@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center mb-4 justify-content-between">
    <h1 class="mb-0">Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
    Add New Category
</a>
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<ul class="list-group">
@foreach($categories as $category)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $category->name }}

        <div class="d-flex align-items-center">
            <span class="badge bg-primary me-2">
                {{ $category->patterns->count() }} patterns
            </span>

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this category?')"
                    @if($category->patterns->count() > 0) disabled @endif>
                    Delete
                </button>
            </form>
        </div>
    </li>
@endforeach
</ul>
@endsection
@extends('layouts.app')

@section('content')
<h1 class="mb-4">Sewing Patterns</h1>

<a href="{{ route('patterns.create') }}" class="btn btn-primary mb-3">
    Submit New Pattern
</a>

<form method="GET" class="mb-4">
    <div class="row g-2">
        <div class="col-md-3">
            <select name="category" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="difficulty" class="form-control">
                <option value="">All Difficulties</option>
                <option value="beginner" {{ request('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="intermediate" {{ request('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="advanced" {{ request('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-control">
                <option value="">Sort By</option>
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>
    Alphabetical
</option>

            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<div class="row">
    @foreach($patterns as $pattern)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/'.$pattern->preview_image) }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $pattern->title }}</h5>
                    <p>{{ ucfirst($pattern->difficulty) }}</p>
                    <a href="{{ route('patterns.show', $pattern->slug) }}" class="btn btn-primary">
                        View Pattern
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

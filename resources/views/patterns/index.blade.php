@extends('layouts.app')

@section('content')
<div class="container py-4">
<div class="d-flex align-items-center mb-4 justify-content-between">
    <h1 class="mb-0">Sewing Patterns</h1>
    <a href="{{ route('patterns.create') }}" class="btn btn-primary">
        Add New Pattern
    </a>
</div>



    <form method="GET" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="difficulty" class="form-label">Difficulty</label>
                <select id="difficulty" name="difficulty" class="form-select">
                    <option value="">All Difficulties</option>
                    <option value="beginner" {{ request('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ request('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ request('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="sort" class="form-label">Sort By</label>
                <select id="sort" name="sort" class="form-select">
                    <option value="">Sort By</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Alphabetical</option>
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="row">
        @forelse($patterns as $pattern)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/'.$pattern->preview_image) }}" 
     class="card-img-top" 
     style="max-height: 250px; object-fit: contain; width: 100%; background-color: #f8f9fa;">


                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $pattern->title }}</h5>

                        <span class="badge mb-2 
                            @if($pattern->difficulty === 'beginner') bg-success
                            @elseif($pattern->difficulty === 'intermediate') bg-warning text-dark
                            @elseif($pattern->difficulty === 'advanced') bg-danger
                            @endif">
                            {{ ucfirst($pattern->difficulty) }}
                        </span>

                        @if($pattern->description)
                            <p class="text-truncate mb-3">{{ $pattern->description }}</p>
                        @endif

                        <a href="{{ route('patterns.show', $pattern->slug) }}" class="btn btn-primary mt-auto">
                            View Pattern
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No patterns found. Try adjusting your filters.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
}
</style>
@endsection

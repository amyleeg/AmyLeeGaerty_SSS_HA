@extends('layouts.app')

@section('content')
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h1 class="card-title">{{ $pattern->title }}</h1>
        <p class="card-text"><strong>Difficulty:</strong>
    <span class="badge bg-info text-dark">{{ ucfirst($pattern->difficulty) }}</span>
</p>
        @if($pattern->description)
            <p class="card-text">{{ $pattern->description }}</p>
        @endif
    </div>
    <img src="{{ asset('storage/'.$pattern->preview_image) }}"
         class="card-img-bottom img-fluid mb-5"
         style="max-height: 350px; object-fit: contain;">
</div>

<div class="mb-4">
    <a href="{{ asset('storage/'.$pattern->pattern_pdf) }}" class="btn btn-success me-2">
        Download PDF
    </a>

    <a href="{{ route('patterns.edit', $pattern->slug) }}" class="btn btn-warning me-2">
        Edit Pattern
    </a>

    <form method="POST" action="{{ route('patterns.destroy', $pattern->slug) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this pattern?')">
            Delete
        </button>
    </form>
</div>


<hr>

<h3>Available Sizes</h3>

<ul class="list-group mb-4">
@foreach($pattern->sizes as $size)
    <li class="list-group-item">
        <strong>{{ $size->size_label }}</strong>
        @if($size->pdf_path)
            - <a href="{{ asset('storage/'.$size->pdf_path) }}">Download</a>
        @endif
    </li>
@endforeach
</ul>

@include('patterns.partials.size-form')
@endsection

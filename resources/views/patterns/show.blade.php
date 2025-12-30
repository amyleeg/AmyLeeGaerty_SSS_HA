@extends('layouts.app')

@section('content')
<h1>{{ $pattern->title }}</h1>

<p><strong>Difficulty:</strong> {{ ucfirst($pattern->difficulty) }}</p>
<p>{{ $pattern->description }}</p>

<img src="{{ asset('storage/'.$pattern->preview_image) }}" class="img-fluid mb-3">

<a href="{{ asset('storage/'.$pattern->pattern_pdf) }}" class="btn btn-success mb-3">
    Download Pattern PDF
</a>

<!-- EDIT + DELETE BUTTONS -->
<div class="mb-4">
    <a href="{{ route('patterns.edit', $pattern->slug) }}"
       class="btn btn-warning">
        Edit Pattern
    </a>

    <form method="POST"
          action="{{ route('patterns.destroy', $pattern->slug) }}"
          class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this pattern?')">
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

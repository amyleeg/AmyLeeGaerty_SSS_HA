@extends('layouts.app')

@section('content')
<h1 class="mb-4">Sewing Patterns</h1>

<a href="{{ route('patterns.create') }}" class="btn btn-primary mb-3">
    Submit New Pattern
</a>

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

@extends('layouts.app')

@section('content')
<h1>Categories</h1>

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

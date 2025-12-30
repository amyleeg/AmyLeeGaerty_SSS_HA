@extends('layouts.app')

@section('content')
<h1>Add Category</h1>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <input name="name" class="form-control mb-2" placeholder="Category name">
    <button class="btn btn-primary">Save</button>
</form>
@endsection

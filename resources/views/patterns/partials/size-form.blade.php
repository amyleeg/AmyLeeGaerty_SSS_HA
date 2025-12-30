<h4>Add Size</h4>

<form method="POST" action="{{ route('sizes.store', $pattern->slug) }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-2">
        <input type="text" name="size_label" class="form-control" placeholder="Size (S, M, L)">
    </div>

    <div class="mb-2">
        <input type="text" name="measurements" class="form-control" placeholder="Measurements">
    </div>

    <div class="mb-2">
        <input type="file" name="pdf_path" class="form-control">
    </div>

    <button class="btn btn-secondary">Add Size</button>
</form>

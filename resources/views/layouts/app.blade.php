<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StitchShare</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">StitchShare</a>
        <a class="btn btn-outline-light" href="{{ route('patterns.create') }}">Submit Pattern</a>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>StitchShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">StitchShare</a>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>

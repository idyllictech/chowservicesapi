<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... (existing head content) ... -->
    <!-- Include Bootstrap CSS locally -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- ... (more head content) ... -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- Add this link -->
                <a class="nav-link" href="{{ url('/api-docs') }}">API Documentation</a>

                <!-- ... -->
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

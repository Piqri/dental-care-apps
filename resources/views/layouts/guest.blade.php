<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS - Prebuilt CDN (Production Ready) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.13/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome (opsional) -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Alpine.js (opsional, kalau butuh interaktif) -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body class="bg-gray-50">

    <div class="flex items-center min-h-screen p-6">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl p-6">
            {{ $slot }}
        </div>
    </div>

</body>
</html>

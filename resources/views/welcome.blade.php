<!DOCTYPE html>
<html lang="en" x-data>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autistic Led - Homepage</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="text-white bg-gray-800 flex flex-col min-h-screen">

    <!-- Navigation -->
    @include('partials.shared.navigation')

    <!-- Header -->
    @include('partials.shared.header')

    <main class="p-4 flex items-center justify-center flex-1 flex-col">
        <h1>Content Coming Soon!</h1>
    </main>

    <!-- Footer -->
    @include('partials.shared.footer')
</body>
</html>

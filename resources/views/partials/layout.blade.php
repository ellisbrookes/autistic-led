<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autistic Led - @yield('title', 'Welcome')</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-800 flex flex-col min-h-screen">
  <!-- Navigation -->
  @include('partials.shared.navigation')

  <!-- Header -->
  @include('partials.shared.header')

  <main class="bg-gray-800 p-4 flex items-center justify-center flex-1 flex-col">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('partials.shared.footer')
</body>
</html>

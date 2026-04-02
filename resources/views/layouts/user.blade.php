<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Adeva Rent - Car Rental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  body { font-family: 'Inter', sans-serif; }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif;
  }

  .tire-track {
    background-image: repeating-linear-gradient(
      -45deg,
      transparent,
      transparent 6px,
      rgba(0,0,0,0.08) 6px,
      rgba(0,0,0,0.08) 10px
    );
  }

  .car-card:hover { transform: translateY(-4px); transition: transform .25s ease; }
  .car-card { transition: transform .25s ease; }
</style>
</head>
<body>
<x-navbar></x-navbar>
<main>
        {{ $slot }} 
 </main>
 <x-footer/>
</body>
</html>
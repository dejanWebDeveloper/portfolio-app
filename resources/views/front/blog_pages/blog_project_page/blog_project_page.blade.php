<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Tvoje Ime</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-gray-100 font-sans">

<!-- Header -->
<header class="fixed top-0 left-0 w-full bg-gray-950/80 backdrop-blur-md border-b border-gray-800 z-50">
    <nav class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="index.html" class="text-xl font-bold text-indigo-500">Tvoje Ime</a>
        <ul class="flex gap-6 text-gray-300">
            <li><a href="projekti.html" class="hover:text-indigo-400 transition">Projekti</a></li>
            <li><a href="linkovi.html" class="hover:text-indigo-400 transition">Linkovi</a></li>
            <li><a href="kontakt.html" class="hover:text-indigo-400 transition">Kontakt</a></li>
        </ul>
    </nav>
</header>

<!-- Sadržaj -->
<main class="pt-32 px-6 max-w-5xl mx-auto">
    <h1 class="text-4xl font-bold mb-4 text-center">Admin Panel</h1>
    <p class="text-gray-400 text-center mb-12">
        Admin panel za upravljanje online prodavnicom, razvijen u PHP-u i MySQL-u sa OOP pristupom i autentifikacijom.
    </p>

    <!-- Screenshotovi -->
    <div class="grid md:grid-cols-2 gap-6 mb-12">
        <img src="https://via.placeholder.com/500x300" alt="Login Screen" class="rounded-xl shadow-lg">
        <img src="https://via.placeholder.com/500x300" alt="Dashboard" class="rounded-xl shadow-lg">
        <img src="https://via.placeholder.com/500x300" alt="Uređivanje proizvoda" class="rounded-xl shadow-lg">
        <img src="https://via.placeholder.com/500x300" alt="Pregled narudžbi" class="rounded-xl shadow-lg">
    </div>

    <!-- Detaljan opis -->
    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Opis funkcionalnosti</h2>
        <ul class="list-disc list-inside text-gray-400">
            <li>CRUD operacije za proizvode i kategorije</li>
            <li>Pregled i upravljanje narudžbama</li>
            <li>Autentifikacija i korisničke uloge</li>
            <li>Integracija frontenda i backend logike</li>
            <li>Laravel MVC struktura i Eloquent ORM (ako koristiš Laravel verziju)</li>
        </ul>
    </section>

    <!-- Tehnologije -->
    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Tehnologije</h2>
        <div class="flex flex-wrap gap-4">
            <span class="bg-indigo-600 px-4 py-1 rounded-full text-white">PHP</span>
            <span class="bg-indigo-600 px-4 py-1 rounded-full text-white">MySQL</span>
            <span class="bg-indigo-600 px-4 py-1 rounded-full text-white">Laravel</span>
            <span class="bg-indigo-600 px-4 py-1 rounded-full text-white">Bootstrap</span>
            <span class="bg-indigo-600 px-4 py-1 rounded-full text-white">jQuery</span>
        </div>
    </section>

    <!-- Linkovi -->
    <section class="text-center mb-20">
        <a href="#" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-full transition-all duration-300 mr-4">GitHub</a>
        <a href="#" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-full transition-all duration-300">Demo</a>
    </section>
</main>

<!-- Footer -->
<footer class="mt-20 border-t border-gray-800 py-6 text-center text-gray-500">
    © 2025 Tvoje Ime — Sva prava zadržana.
</footer>

</body>
</html>

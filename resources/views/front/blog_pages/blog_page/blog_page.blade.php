<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Projekti | Tvoje Ime</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
</head>

<body class="bg-gray-950 text-gray-100 font-sans">
<!-- Header -->
<header class="fixed top-0 left-0 w-full bg-gray-950/80 backdrop-blur-md border-b border-gray-800 z-50">
    <nav class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="index.html" class="text-xl font-bold text-indigo-500">Tvoje Ime</a>
        <ul class="flex gap-6 text-gray-300">
            <li><a href="projekti.html" class="text-indigo-400 border-b-2 border-indigo-400 pb-1 font-medium">Projekti</a></li>
            <li><a href="linkovi.html" class="hover:text-indigo-400 transition">Linkovi</a></li>
            <li><a href="kontakt.html" class="hover:text-indigo-400 transition">Kontakt</a></li>
        </ul>
    </nav>
</header>

<!-- Sadržaj -->
<main class="pt-32 px-6 max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center">Moji Projekti</h1>
    <p class="text-gray-400 text-center mb-12">
        Ovde su neki od mojih radova u PHP-u, Laravelu, MySQL-u i frontend tehnologijama.
    </p>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Projekat 1 -->
        @foreach($blogProjects as $blogProject)
        <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 transition">
            <img src="https://via.placeholder.com/400x250" alt="Online shop" class="w-full" />
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Online prodavnica</h3>
                <p class="text-gray-400 mb-4">
                    Mala PHP aplikacija sa klasama za proizvode, kategorije, korpu i checkout.
                    Baza podataka: MySQL, front: Bootstrap + jQuery.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">GitHub →</a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">Demo</a>
                    <a href="{{route('blog_project_page', ['id'=>$blogProject->id, 'slug'=>$blogProject->slug])}}" class="text-indigo-400 hover:text-indigo-300 font-medium">Details</a>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Projekat 2 -->
        <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 transition">
            <img src="https://via.placeholder.com/400x250" alt="Laravel blog" class="w-full" />
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Laravel Blog</h3>
                <p class="text-gray-400 mb-4">
                    Blog sistem razvijen u Laravelu — CRUD funkcionalnosti, autentifikacija, Eloquent ORM, i Blade šabloni.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">GitHub →</a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">Demo</a>
                </div>
            </div>
        </div>

        <!-- Projekat 3 -->
        <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 transition">
            <img src="https://via.placeholder.com/400x250" alt="Task Manager" class="w-full" />
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Task Manager</h3>
                <p class="text-gray-400 mb-4">
                    Aplikacija za praćenje zadataka napravljena u PHP/Laravelu.
                    Koristi MVC strukturu, autentifikaciju i MySQL bazu.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">GitHub →</a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">Demo</a>
                </div>
            </div>
        </div>
        <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 transition">
            <img src="https://via.placeholder.com/400x250" alt="Admin Panel" class="w-full" />
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Admin Panel</h3>
                <p class="text-gray-400 mb-4">
                    Admin panel za upravljanje online prodavnicom. Omogućava dodavanje i uređivanje proizvoda, kategorija, pregled narudžbi i korisnika.
                    Razvijen u PHP-u i MySQL-u, koristeći OOP pristup i autentifikaciju.
                </p>
                <p class="text-gray-400 mb-4">
                    Tehnologije: <span class="text-indigo-400 font-medium">PHP, MySQL, Laravel, Bootstrap, jQuery</span>
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">GitHub →</a>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">Demo</a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="mt-20 border-t border-gray-800 py-8 text-center text-gray-500">
    <p class="mb-4">© 2025 <span class="text-indigo-500 font-medium">Tvoje Ime</span>. Sva prava zadržana.</p>
    <div class="flex justify-center gap-6 text-gray-400 text-xl">
        <a href="https://github.com/tvojekorisnickoime" target="_blank" class="hover:text-indigo-400 transition">
            <i class="fab fa-github"></i>
        </a>
        <a href="https://linkedin.com/in/tvojekorisnickoime" target="_blank" class="hover:text-indigo-400 transition">
            <i class="fab fa-linkedin"></i>
        </a>
        <a href="mailto:tvojemail@example.com" class="hover:text-indigo-400 transition">
            <i class="fas fa-envelope"></i>
        </a>
    </div>
</footer>

</body>
</html>

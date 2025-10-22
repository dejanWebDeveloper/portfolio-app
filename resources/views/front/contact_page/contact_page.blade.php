<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt | Tvoje Ime</title>
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
            <li><a href="projekti.html" class="hover:text-indigo-400 transition">Projekti</a></li>
            <li><a href="linkovi.html" class="hover:text-indigo-400 transition">Linkovi</a></li>
            <li><a href="kontakt.html" class="text-indigo-400 border-b-2 border-indigo-400 pb-1 font-medium">Kontakt</a></li>
        </ul>
    </nav>
</header>

<!-- Kontakt sekcija -->
<main class="pt-32 px-6 max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center">Kontakt</h1>
    <p class="text-gray-400 text-center mb-12">
        Imaš ideju za projekat, pitanje ili želiš saradnju? Pošalji mi poruku!
    </p>

    <!-- Forma -->
    <form action="mailto:tvojemail@example.com" method="POST" class="flex flex-col gap-6 bg-gray-900 p-8 rounded-2xl shadow-lg">
        <div>
            <label for="name" class="block mb-2 font-medium text-gray-300">Ime</label>
            <input type="text" id="name" name="name" required
                   class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-100 border border-gray-700 focus:outline-none focus:border-indigo-500" />
        </div>

        <div>
            <label for="email" class="block mb-2 font-medium text-gray-300">Email</label>
            <input type="email" id="email" name="email" required
                   class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-100 border border-gray-700 focus:outline-none focus:border-indigo-500" />
        </div>

        <div>
            <label for="message" class="block mb-2 font-medium text-gray-300">Poruka</label>
            <textarea id="message" name="message" rows="5" required
                      class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-100 border border-gray-700 focus:outline-none focus:border-indigo-500"></textarea>
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-full transition-all duration-300">
            Pošalji poruku
        </button>
    </form>

    <!-- Alternativni kontakt -->
    <div class="mt-10 text-center text-gray-400">
        <p>Možeš me kontaktirati i direktno putem:</p>
        <p class="mt-2"><a href="mailto:tvojemail@example.com" class="text-indigo-400 hover:text-indigo-300">tvojemail@example.com</a></p>
        <p class="mt-2"><a href="https://linkedin.com/in/tvojekorisnickoime" target="_blank" class="text-indigo-400 hover:text-indigo-300">LinkedIn</a></p>
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

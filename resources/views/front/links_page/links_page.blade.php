<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Links | Dejan Jovanovic</title>
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
        <a href="{{route('index_page')}}" class="text-xl font-bold text-indigo-500">Dejan Jovanovic</a>
        <ul class="flex gap-6 text-gray-300">
            <li><a href="{{route('blog_page')}}" class="hover:text-indigo-400 transition">Projects</a></li>
            <li><a href="{{route('links_page')}}" class="text-indigo-400 border-b-2 border-indigo-400 pb-1 font-medium">Links</a></li>
            <li><a href="{{route('contact_page')}}" class="hover:text-indigo-400 transition">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- Sadržaj -->
<main class="pt-32 flex flex-col items-center px-6">
    <img src="{{url('storage/photo/user/1_profile_photo_09f0c10d-f35a-482b-a9b7-cf6ae5c77396')}}" alt="Dejan Jovanovic" class="rounded-full w-32 h-32 mb-6 border-4 border-indigo-600 shadow-lg" />
    <h1 class="text-3xl font-bold mb-2">Dejan Jovanovic</h1>
    <p class="text-gray-400 mb-8">Junior PHP / Laravel Developer</p>

    <div class="w-full max-w-md flex flex-col gap-4">
        <a href="https://github.com/tvojekorisnickoime" target="_blank" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">💻 GitHub</a>
        <a href="https://linkedin.com/in/tvojekorisnickoime" target="_blank" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">🔗 LinkedIn</a>
        <a href="mailto:tvojemail@example.com" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">📧 Email</a>
        <a href="{{route('blog_page')}}" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">📂 Projekti</a>
        <a href="https://example.com" target="_blank" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">🌐 Portfolio Demo</a>
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

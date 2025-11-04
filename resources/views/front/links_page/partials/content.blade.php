<main class="pb-32 pt-32 flex flex-col items-center px-6">
    <img src="{{asset('photo/dejan_jovanovic.jpg')}}" alt="Dejan Jovanovic" class="rounded-full w-32 h-32 mb-6 border-4 border-indigo-600 shadow-lg" />
    <h1 class="text-3xl font-bold mb-2">Dejan Jovanovic</h1>
    <p class="text-gray-400 mb-8">Junior PHP / Laravel Developer</p>

    <div class="w-full max-w-md flex flex-col gap-4">
        <a href="https://github.com/dejanWebDeveloper" target="_blank" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">💻 GitHub</a>
        <a href="https://www.linkedin.com/in/dejan-jovanovic-656b85355/" target="_blank" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">🔗 LinkedIn</a>
        <a href="mailto:dejan_web@outlook.com" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">📧 Email</a>
        <a href="{{route('projects_page')}}" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">📂 Projects</a>
        <a href="https://example.com" target="_blank" class="w-full text-center bg-gray-800 hover:bg-indigo-600 py-3 rounded-full transition">🌐 Portfolio Demo</a>
    </div>
</main>

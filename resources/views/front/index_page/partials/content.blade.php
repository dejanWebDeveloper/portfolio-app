<section class="min-h-screen flex flex-col md:flex-row items-center justify-center px-6 md:px-20 gap-10">
    <!-- Leva strana: slika -->
    <div class="flex-shrink-0">
        <img
            src="{{ asset('storage/photo/user/1_profile_photo_09f0c10d-f35a-482b-a9b7-cf6ae5c77396') }}"
            alt="Your name"
            class="rounded-full w-72 h-72 object-cover border-4 border-indigo-600 shadow-lg hover:scale-105 transition-transform duration-300"
        />
    </div>

    <!-- Desna strana: tekst -->
    <div class="max-w-lg text-center md:text-left">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            Hello, I'm <span class="text-indigo-500">Dejan Jovanovic</span>
        </h1>
        <h2 class="text-xl md:text-2xl text-gray-400 mb-6">
            Web developer | Backend Laravel developer | Freelancer
        </h2>
        <p class="text-gray-400 leading-relaxed mb-8">
            I’m a junior PHP developer passionate about building clean and efficient web applications.
            After completing a Laravel course, I’ve been focusing on using modern PHP practices and frameworks to create
            structured, maintainable code.
        </p>

        <div class="flex flex-wrap justify-center md:justify-start gap-4">
            <a
                href="{{route('projects_page')}}"
                class="bg-indigo-600 hover:bg-indigo-500 px-6 py-3 rounded-full text-white transition-all duration-300"
            >
                Projects
            </a>
            <a
                href="{{route('links_page')}}"
                class="border border-indigo-500 hover:bg-indigo-500 hover:text-white px-6 py-3 rounded-full transition-all duration-300"
            >
                Links
            </a>
            <a
                href="{{route('contact_page')}}"
                class="text-indigo-400 hover:text-indigo-300 underline px-4 py-3"
            >
                Contact →
            </a>
        </div>
    </div>

</section>

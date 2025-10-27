<div class="grid md:grid-cols-3 gap-8">
    <!-- Projects -->
    @foreach($blogProjects as $blogProject)
        <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 transition">
            <img src="{{ $blogProject->imageUrl() }}" alt="Online shop" class="w-full"/>
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">{{ $blogProject->heading }}</h3>
                <p class="text-gray-400 mb-4">
                    {{ $blogProject->preheading }}
                </p>
                <div class="flex gap-4">
                    <a href="{{ $blogProject->github_link }}" class="text-indigo-400 hover:text-indigo-300 font-medium">GitHub →</a>
                    <a href="{{ $blogProject->demo_link }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Demo</a>
                    <a href="{{route('blog_project_page', ['id'=>$blogProject->id, 'slug'=>$blogProject->slug])}}"
                       class="text-indigo-400 hover:text-indigo-300 font-medium">Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
</main>

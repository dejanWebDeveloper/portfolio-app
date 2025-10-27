<div class="grid md:grid-cols-3 gap-8">
    <!-- Projects -->
    @foreach($projects as $project)
        <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 transition">
            <img src="{{ $project->imageUrl() }}" alt="Online shop" class="w-full"/>
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">{{ $project->heading }}</h3>
                <p class="text-gray-400 mb-4">
                    {{ $project->preheading }}
                </p>
                <div class="flex gap-4">
                    <a href="{{ $project->github_link }}" class="text-indigo-400 hover:text-indigo-300 font-medium">GitHub →</a>
                    <a href="{{ $project->demo_link }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Demo</a>
                    <a href="{{route('projects_project_page', ['id'=>$project->id, 'slug'=>$project->slug])}}"
                       class="text-indigo-400 hover:text-indigo-300 font-medium">Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
</main>

<!-- Screenshotovi -->
<div class="grid md:grid-cols-2 gap-6 mb-12">
    <img src="{{$singleProject->imageUrl()}}" alt="Login Screen" class="rounded-xl shadow-lg">
    <img src="{{ asset('photo/dejan_jovanovic.jpg') }}" alt="Your name"
        class="rounded-xl object-cover border-4 border-indigo-600 shadow-lg hover:scale-105 transition-transform duration-300"/>

</div>
<!-- Detaljan opis -->
<section class="mb-12">
    <h2 class="text-2xl font-semibold mb-4">Functionality description</h2>
    <p class="list-disc list-inside text-gray-400">
        {!! $singleProject->text !!}
    </p>
</section>

<!-- Tehnologije -->
<section class="mb-12">
    <h2 class="text-2xl font-semibold mb-4">Tehnologies</h2>
    <div class="flex flex-wrap gap-4">
        @foreach($singleProjectTags as $tag)
            <span class="bg-indigo-600 px-4 py-1 rounded-full text-white">#{{$tag->name}}</span>
        @endforeach
    </div>
</section>

<!-- Linkovi -->
<section class="text-center mb-20">
    <a href="{{$singleProject->github_link}}"
       class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-full transition-all duration-300 mr-4">GitHub</a>
    <a href="{{$singleProject->demo_link}}"
       class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-full transition-all duration-300">Demo</a>
</section>
</main>

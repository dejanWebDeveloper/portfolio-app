<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dejan Jovanovic | Portfolio</title>
    <link rel="stylesheet" href="{{url('/themes/front/vendor/bootstrap/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{url('/themes/front/vendor/@fancyapps/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{url('/themes/front/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{'favicon.png'}}">
</head>

<body class="bg-gray-950 text-gray-100 font-sans">
<!-- Hero / About Section -->
<section class="min-h-screen flex flex-col md:flex-row items-center justify-center px-6 md:px-20 gap-10">
    <!-- Leva strana: slika -->
    <div class="flex-shrink-0">
        <img
            src="{{url('storage/photo/user/1_profile_photo_09f0c10d-f35a-482b-a9b7-cf6ae5c77396')}}"
            alt="Tvoje ime"
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
                href="projekti.html"
                class="bg-indigo-600 hover:bg-indigo-500 px-6 py-3 rounded-full text-white transition-all duration-300"
            >
                Projects
            </a>
            <a
                href="linkovi.html"
                class="border border-indigo-500 hover:bg-indigo-500 hover:text-white px-6 py-3 rounded-full transition-all duration-300"
            >
                Linkovi
            </a>
            <a
                href="kontakt.html"
                class="text-indigo-400 hover:text-indigo-300 underline px-4 py-3"
            >
                Kontakt →
            </a>
        </div>
    </div>

</section>
<section class="gallery no-padding">
    <div class="row">
        @for($i = 1; $i <= 4; $i++)
            <div class="mix col-lg-3 col-md-3 col-sm-6">
                <div class="item">
                    <a href="{{ url("/themes/front/img/gallery-$i.jpg") }}" data-fancybox="gallery" class="image">
                        <img src="{{ url("/themes/front/img/gallery-$i.jpg") }}" alt="gallery image alt {{ $i }}"
                             class="img-fluid" title="gallery image title {{ $i }}">
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <i class="icon-search"></i>
                        </div>
                    </a>
                </div>
            </div>
        @endfor
    </div>
</section>
<!-- Footer -->
<footer class="py-6 text-center text-gray-500 border-t border-gray-800">
    © 2025 Tvoje Ime — Sva prava zadržana.
</footer>
</body>
</html>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{url('/themes/front/plugins/owl-carousel2/owl.carousel.min.js')}}"></script>
<script>
    $("#latest-posts-slider").owlCarousel({
        "items": 3,
        "loop": true,
        "margin": 30,
        "autoplay": true,
        "autoplayHoverPause": true
    });</script>

<script src="{{url('/themes/front/vendor/jquery/jquery.js')}}"></script>
<script src="{{url('/themes/front/vendor/popper.js/umd/popper.min.js')}}"></script>
<script src="{{url('/themes/front/vendor/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{url('/themes/front/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
<script src="{{url('/themes/front/vendor/@fancyapps/fancybox/jquery.fancybox.min.js')}}"></script>
<script src="{{url('/themes/front/js/front.js')}}"></script>




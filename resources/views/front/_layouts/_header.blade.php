<header class="header">
    <!-- Main Navbar-->
    <nav class="navbar navbar-expand-lg">
        <div class="search-area">
            <div class="search-area-inner d-flex align-items-center justify-content-center">
                <div class="close-btn"><i class="icon-close"></i></div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <form method="get" action="{{route('blog_search_page')}}">
                            <div class="form-group">
                                <input type="search" name="search" id="search" placeholder="What are you looking for?">
                                <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Navbar Brand -->
            <div class="navbar-header d-flex align-items-center justify-content-between">
                <!-- Navbar Brand --><a href="{{route('index_page')}}" class="navbar-brand">Bootstrap Project</a>
                <!-- Toggle Button-->
                <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
            </div>
            <!-- Navbar Menu -->
            <div id="navbarcollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{route('index_page')}}" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item"><a href="{{route('blog_page')}}" class="nav-link">Projects</a>
                    </li>
                    <li class="nav-item"><a href="{{route('contact_page')}}" class="nav-link">Contact</a>
                    </li>
                </ul>
                <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
            </div>
        </div>
    </nav>
</header>
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

<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
<!-- FontAwesome -->
<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
<!-- Slick Carousel -->
<link rel="stylesheet" href="{{ asset('plugins/slick-carousel/slick.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/slick-carousel/slick-theme.css') }}">
<!-- main stylesheet -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="trending-bar-dark hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="trending-bar-title">Trending News</h3>
                <div class="trending-news-slider">
                    <div class="item">
                        <div class="post-content">
                            <h2 class="post-title title-sm">
                                <a href="single-post.html">Ex-Googler warns coding bootcamps are lacking</a>
                            </h2>
                        </div>
                    </div>
                    <div class="item">
                        <div class="post-content">
                            <h2 class="post-title title-sm">
                                <a href="single-post.html">Intel’s new smart glasses actually look good</a>
                            </h2>
                        </div>
                    </div>
                    <div class="item">
                        <div class="post-content">
                            <h2 class="post-title title-sm">
                                <a href="single-post.html">Here's How To Get Free Pizza On 2 hour</a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $socialMediaLinks = App\Models\Socailmedia::first(); // dd($addetail);

            @endphp

            <div class="col-md-12 col-sm-12 col-xs-12 top-nav-social-lists text-lg-right col-lg-4 ml-lg-auto">
                <ul class="list-unstyled mt-4 mt-lg-0">
                    <li>
                        {{-- <div class="social-links"> --}}
                        @if ($socialMediaLinks)
                            <a href="{{ $socialMediaLinks->facebook }}" target="_blank">
                                <span class="social-icon">
                                    <i class="fa fa-facebook-f"></i>
                                </span>
                            </a>
                            <a href="{{ $socialMediaLinks->twitter }}" target="_blank">
                                <span class="social-icon">
                                    <i class="fa fa-twitter"></i>
                                </span>
                            </a>
                            <a href="{{ $socialMediaLinks->google_plus }}" target="_blank">
                                <span class="social-icon">
                                    <i class="fa fa-google-plus"></i>
                                </span>
                            </a>
                            <a href="{{ $socialMediaLinks->youtube }}" target="_blank">
                                <span class="social-icon">
                                    <i class="fa fa-youtube"></i>
                                </span>
                            </a>
                            <a href="{{ $socialMediaLinks->linkedin }}" target="_blank">
                                <span class="social-icon">
                                    <i class="fa fa-linkedin"></i>
                                </span>
                            </a>
                        @else
                            <p>No social media links available.</p>
                        @endif



                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

@php
    $websitedetail = App\Models\Websitedetail::first();
    $headerad = App\Models\Advertisement::where('status', 1)->where('position', 1)->first(); // dd($addetail);

    // dd($websitedetail);

@endphp
<header class="header-navigation d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xs-12 col-sm-3 col-md-3">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ route('home') }}">
                        {{-- {{ asset(storage /. $settings->logo) }} --}}
                        <img src="{{ Storage::url($websitedetail->logo) }}" alt="">
                        <!-- Replace Logo Here -->
                    </a>
                </div>
                <!-- End Logo -->
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9">
                <div class="top-ad-banner float-right">
                    @if ($headerad)
                        <a href="{{ $headerad->link }}">
                            <img src="{{ Storage::url($headerad->image) }}" class="img-fluid"
                                style="height:100px;width:600px;" alt="banner-ads">
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</header>

<div class="main-navbar clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg site-main-nav">
                    <a class="navbar-brand d-lg-none" href="index.html">
                        <img src="images/logos/footer-logo.png" alt="">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            @php
                                $Categories = App\Models\category::inRandomOrder()->take(8)->get();
                            @endphp
                            @foreach ($Categories as $Category)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle"
                                        href="{{ route('news.category', ['id' => $Category->id, 'name' => urlencode($Category->name)]) }}"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ $Category->name }}
                                    </a>
                                    <div class="dropdown-menu">
                                        @php
                                            $subcategories = App\Models\Sub_category::where(
                                                'category_id',
                                                $Category->id,
                                            )->get();
                                        @endphp

                                        @foreach ($subcategories as $subcategory)
                                            <a class="dropdown-item"
                                                href="{{ route('news.category', ['id' => $Category->id, 'name' => urlencode($subcategory->name)]) }}">
                                                {{ $subcategory->name }}
                                            </a>
                                        @endforeach

                                    </div>
                                </li>
                            @endforeach


                            {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Home
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.html">Home 1</a>
                                        <a class="dropdown-item" href="index-2.html">Home 2</a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Post
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="post-left-sidebar.html">Post Left Sidebar</a>
                                        <a class="dropdown-item" href="post-full-width.html">Post Full Width</a>
                                        <a class="dropdown-item" href="single-post.html">Single Post</a>
                                        <a class="dropdown-item" href="post-category-1.html">Category 1</a>
                                        <a class="dropdown-item" href="post-category-2.html">Category 2</a>
                                        <a class="dropdown-item" href="author.html">Author</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="account.html">Log In</a>
                                        <a class="dropdown-item" href="signup.html">Register</a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        About
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="about.html">About</a>
                                        <a class="dropdown-item" href="terms.html">Terms</a>
                                        <a class="dropdown-item" href="privacy.html">Privacy Policy</a>
                                        <a class="dropdown-item" href="job.html">Career</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pages
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="404.html">404 Page</a>
                                        <a class="dropdown-item" href="search.html">Search Page</a>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li> --}}

                        </ul>
                        <div class="nav-search ml-auto d-none d-lg-block">
                            <span id="search">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
    </div>
    <form class="site-search" method="get" action="{{ route('search') }}">
        <input type="text" id="searchInput" name="query" placeholder="Enter Keyword Here..." autofocus>
        <div class="search-close">
            <button type="button" class="close-search">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>
</div>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const successAlert = document.getElementById('alert-success');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000); // Hide after 5 seconds
        }
    });

    function previewFile() {
        const preview = document.getElementById('image');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function() {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

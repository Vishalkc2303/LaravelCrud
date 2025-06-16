@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <style>
        .medium-maxheight {
            max-height: 180px;
        }

        .high-maxwidth {
            max-width: 350px;
        }
    </style>

    <section class="featured-posts">
        <div class="container">
            <div class="row no-gutters">
                @if ($newsItems->isNotEmpty())
                    @foreach ($newsItems as $news)
                        @if ($loop->iteration <= 2)
                            <div class="col-md-6 col-xs-12 col-lg-4">
                                <div class="featured-slider mr-md-3 mr-lg-3">
                                    <div class="item"
                                        style="background-image:url('{{ asset('storage/' . $news->image) }}')">
                                        <div class="post-content">
                                            <a href="#" class="post-cat bg-primary">{{ $news->category->name }}</a>
                                            <h2 class="slider-post-title">
                                                <a href="{{ route('news.show', $news->slug) }}">
                                                    {{ Str::limit($news->title, 50, '...') }}</a>
                                                </a>
                                            </h2>
                                            <div class="post-meta mt-2">
                                                <span class="posted-time">
                                                    <i
                                                        class="fa fa-clock-o mr-2 text-danger"></i>{{ $news->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="col-md-6 col-xs-12 col-lg-4">
                        <div class="row mt-3 mt-lg-0">
                            @foreach ($newsItems as $news)
                                @if ($loop->iteration > 2)
                                    <div class="col-lg-12 col-xs-12 col-sm-6 col-md-6">
                                        <div class="post-featured-style"
                                            style="background-image:url('{{ asset('storage/' . $news->image) }}')">
                                            <div class="post-content">
                                                <a href="#"
                                                    class="post-cat bg-success">{{ $news->category->name }}</a>
                                                <h2 class="post-title">
                                                    <a href="{{ route('news.show', $news->slug) }}">
                                                        {{ Str::limit($news->title, 50, '...') }}</a>
                                                    </a>
                                                </h2>
                                                <div class="post-meta mt-2">
                                                    <span class="posted-time"><i
                                                            class="fa fa-clock-o mr-2 text-danger"></i>{{ $news->created_at->diffForHumans() }}</span>
                                                    {{-- <span class="post-author">
                                                        <span> by </span>
                                                        <a href="author.html">Rodinho Summon</a>
                                                    </span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
    </section>


    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-style-one">
                        <h3 class="news-title">
                            <span>Editor Picks</span>
                        </h3>
                        <div class="news-style-one-slide">
                            @foreach ($newsItems as $news)
                                <div class="item">
                                    <div class="post-block-wrapper clearfix mb-5">
                                        <div class="post-thumbnail">
                                            <a href="{{ route('news.show', $news->slug) }}">
                                                <img class="high-maxwidth" src="{{ asset('storage/' . $news->image) }}"
                                                    alt="{{ $news->title }}" />
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <h2 class="post-title mt-3">
                                                <a href="{{ route('news.show', $news->slug) }}">
                                                    {{ Str::limit($news->title, 50, '...') }}</a>
                                            </h2>
                                            <div class="post-meta mb-2">
                                                <span class="posted-time"><i
                                                        class="fa fa-clock-o mr-2"></i>{{ $news->created_at->diffForHumans() }}</span>
                                                {{-- <span class="post-author">
                                                    by
                                                    <a href="author.html">Tarnak Sunder</a>
                                                </span> --}}
                                            </div>
                                            <p>
                                                {!! Str::limit(strip_tags($news->content), 150, '...') !!}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="py-40"></div>
                    <div class="news-style-two">
                        <h3 class="news-title">
                            <span>Tech</span>
                        </h3>
                        <div class="row">
                            @if ($newsItems->isNotEmpty())
                                @foreach ($newsItems as $news)
                                    @if ($loop->first)
                                        <div class="col-md-6 col-sm-6">
                                            <div class="post-block-wrapper clearfix">
                                                <div class="post-thumbnail">
                                                    <a href="{{ route('news.show', $news->slug) }}">
                                                        <img class="img-fluid" src="{{ asset('storage/' . $news->image) }}"
                                                            alt="{{ $news->title }}" />
                                                    </a>
                                                </div>
                                                <a class="post-category"
                                                    href="category-style1.html">{{ $news->category->name }}</a>
                                                <div class="post-content">
                                                    <h2 class="post-title mt-3">
                                                        <a href="{{ route('news.show', $news->slug) }}">
                                                            {{ Str::limit($news->title, 50, '...') }}</a>
                                                        </a>
                                                    </h2>
                                                    <div class="post-meta mb-2">
                                                        <span class="posted-time"><i
                                                                class="fa fa-clock-o mr-2"></i>{{ $news->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    {!! Str::limit(strip_tags($news->content), 150, '...') !!}

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="col-md-6 col-sm-6">
                                    @foreach ($newsItems as $news)
                                        @unless ($loop->first)
                                            <div class="post-block-wrapper post-float clearfix">
                                                <div class="post-thumbnail">
                                                    <a href="{{ route('news.show', $news->slug) }}">
                                                        <img class="img-fluid" src="{{ asset('storage/' . $news->image) }}"
                                                            alt="{{ $news->title }}" />
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h2 class="post-title title-sm">
                                                        <a href="{{ route('news.show', $news->slug) }}">
                                                            {{ Str::limit($news->title, 50, '...') }}</a>
                                                        </a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="posted-time"><i
                                                                class="fa fa-clock-o mr-2"></i>{{ $news->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endunless
                                    @endforeach
                                </div>
                            @endif
                        </div>


                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="widget">
                            <h3 class="news-title">
                                <span>Stay in touch</span>
                            </h3>

                            <ul class="list-inline social-widget">
                                <li class="list-inline-item">
                                    <a class="social-page facebook" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="social-page twitter" href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>

                                <li class="list-inline-item">
                                    <a class="social-page linkedin" href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>

                                <li class="list-inline-item">
                                    <a class="social-page youtube" href="#">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>

                            </ul>

                        </div>
                        {{-- <div class="widget">
                            @php
                                $sidebarTop = App\Models\Advertisement::where('status', 1)
                                    ->where('position', 2)
                                    ->first(); // dd($addetail);

                            @endphp
                            @if ($sidebarTop)
                                <a href="{{ $sidebarTop->link }}">
                                    <img src="{{ Storage::url($sidebarTop->image) }}" class="img-fluid"
                                        style="height:300px;width:300px;" alt="banner-ads">
                                </a>
                            @endif
                        </div> --}}
                        <div class="widget">
                            <h3 class="news-title">
                                <span>Hot News</span>
                            </h3>

                            {{-- <div class="row"> --}}
                            @foreach ($newsItems as $news)
                                @if ($loop->first)
                                    {{-- <div class="col-md-6 col-xs-12 col-lg-4"> --}}
                                    <div class="post-overlay-wrapper">
                                        <div class="post-thumbnail">
                                            <img class="img-fluid" src="{{ asset('storage/' . $news->image) }}"
                                                alt="post-thumbnail" />
                                        </div>
                                        <div class="post-content">
                                            <a class="post-category white"
                                                href="post-category-1.html">{{ $news->category->name }}</a>
                                            <h2 class="post-title">
                                                <a href="{{ route('news.show', $news->slug) }}">
                                                    {{ Str::limit($news->title, 50, '...') }}</a>
                                                </a>
                                            </h2>
                                            <div class="post-meta white">
                                                <span class="posted-time"><i
                                                        class="fa fa-clock-o mr-1"></i>{{ $news->created_at->diffForHumans() }}</span>
                                                {{-- <span> by </span>
                                                        <span class="post-author">
                                                            <a href="author.html">{{ $news->author->name }}</a>
                                                        </span> --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                @else
                                    <div class="post-list-block">
                                        <div class="post-block-wrapper post-float">
                                            <div class="post-thumbnail">
                                                <a href="{{ route('news.show', $news->slug) }}">
                                                    <img class="img-fluid" src="{{ asset('storage/' . $news->image) }}"
                                                        alt="post-thumbnail" />
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h2 class="post-title title-sm">
                                                    <a href="{{ route('news.show', $news->slug) }}">
                                                        {{ Str::limit($news->title, 50, '...') }}</a>
                                                    </a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="posted-time"><i
                                                            class="fa fa-clock-o mr-1"></i>{{ $news->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="widget">
                            @php
                                $sidebarBottom = App\Models\Advertisement::where('status', 1)
                                    ->where('position', 3)
                                    ->first(); // dd($addetail);

                            @endphp
                            @if ($sidebarBottom)
                                <a href="{{ $sidebarBottom->link }}">
                                    <img src="{{ Storage::url($sidebarBottom->image) }}" class="img-fluid"
                                        style="height:300px;width:300px;" alt="banner-ads">
                                </a>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-style-four bg-light section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="block">
                        <h3 class="news-title">
                            <span>Tour</span>
                        </h3>
                        <div class="post-overlay-wrapper clearfix">
                            <div class="post-thumbnail">
                                <img class="img-fluid" src="images/news/news-13.jpg" alt="post-thumbnail" />
                            </div>

                            <div class="post-content">
                                <h2 class="post-title ">
                                    <a href="single-post.html">An Asteroid Is Passing Earth Today: Here's How to</a>
                                </h2>
                                <div class="post-meta white">
                                    <span class="posted-time">2 hours ago</span>
                                    <span class="post-author">by
                                        <a href="author.html">Rock Madveen</a>
                                    </span>
                                    <span class="pull-right">
                                        <i class="fa fa-comments"></i>
                                        <a href="single-post.html#comments">05</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="post-list-block">
                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-11.jpg" alt="post-thumbnail" />

                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Snow and Freezing Rain in Paris Forces the</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">3 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-04.jpg" alt="post-thumbnail" />
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Your social media apps want to help.</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">8 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-12.jpg" alt="post-thumbnail" />
                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Today Is the Day Most People Quit Their New
                                            Year's</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">9 hours ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="block">
                        <h3 class="news-title">
                            <span>Game</span>
                        </h3>
                        <div class="post-overlay-wrapper clearfix">
                            <div class="post-thumbnail">
                                <img class="img-fluid" src="images/news/news-08.jpg" alt="post-thumbnail" />
                            </div>

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="single-post.html">Call Of Duty: Black Ops 4 Releasing</a>
                                </h2>
                                <div class="post-meta white">
                                    <span class="posted-time">3 hours ago</span>
                                    <span class="post-author">by
                                        <a href="author.html">Arya Stark</a>
                                    </span>
                                    <span class="pull-right">
                                        <i class="fa fa-comments"></i>
                                        <a href="single-post.html#comments">10</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="post-list-block">
                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-03.jpg" alt="post-thumbnail" />
                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Apple HomePod review: locked in</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">4 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-01.jpg" alt="post-thumbnail" />
                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Ex-Googler warns coding bootcamps are lacking</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">5 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-06.jpg" alt="post-thumbnail" />
                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">PS4 Games Sale: All The PSN Deals</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">12 hours ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="block">
                        <h3 class="news-title">
                            <span>Health</span>
                        </h3>
                        <div class="post-overlay-wrapper clearfix">
                            <div class="post-thumbnail">
                                <img class="img-fluid" src="images/news/news-05.jpg" alt="post-thumbnail" />
                            </div>

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="single-post.html">Here's How To Get Free Pizza On</a>
                                </h2>
                                <div class="post-meta white">
                                    <span class="posted-time">an hour ago</span>
                                    <span class="post-author">by
                                        <a href="author.html">Mad King</a>
                                    </span>
                                    <span class="pull-right">
                                        <i class="fa fa-comments"></i>
                                        <a href="single-post.html#comments">30</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="post-list-block">
                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-10.jpg" alt="post-thumbnail" />
                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Free Two-Hour Delivery From Whole Foods</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">2 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-07.jpg" alt="post-thumbnail" />
                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Your social media apps want to help</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">4 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="images/news/news-14.jpg" alt="post-thumbnail" />
                                </div>

                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="single-post.html">Snow and Freezing Rain in Paris Forces the</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">9 hours ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="py-40"></div>
@endsection
{{-- </body>

</html> --}}

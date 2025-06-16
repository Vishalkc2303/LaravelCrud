@extends('layouts.app')
@section('content')
    <div class="py-10"></div>

    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Search News</li>
                        <li>{{$query}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h3 class="news-title">
                        <span>Search Results:</span>
                    </h3>
                    <div class="post-list-block m-top-0 row">

                        @foreach ($search as $news)
                            <div class="post-block-wrapper post-float clearfix">
                                <div class="col-md-4 post-thumbnail">
                                    <a href="{{ route('news.show', $news->slug) }}">
                                        <img class="img-fluid" src="{{ asset('storage/' . $news->image) }}"
                                            alt="{{ $news->title }}" /> </a>
                                </div>

                                <div class="col-md-8 post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                                    </h2>
                                    <p>Lumbersexual meh sustainable Thundercats meditation kogi. Tilde Pitchfork vegan,
                                        gentrify minim elit semiotics non messenger bag Austin which roasted</p>
                                    <div class="post-meta">
                                        <span class="posted-time"><i class="fa fa-clock-o mr-2"></i>7 hours ago</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
                        <div class="widget">
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
                        </div>
                        <div class="widget">
                            <h3 class="news-title">
                                <span>Hot News</span>
                            </h3>

                            {{-- <div class="row"> --}}
                            @foreach ($search as $news)
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
                                                <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
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
                                                    <a
                                                        href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
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
@endsection

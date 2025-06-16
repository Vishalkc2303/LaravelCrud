@extends('layouts.app')
@section('content')
    <!-- OG meta tags -->
    <meta property="og:title" content="{{ $news->title }}">
    <meta property="og:description" content="{!! $news->content !!}">
    <meta property="og:image" content="{{ asset('storage/' . $news->image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter meta tags -->
    <meta name="twitter:title" content="{{ $news->title }}">
    <meta name="twitter:description" content="{{ $news->content }}">
    <meta name="twitter:image" content="{{ asset('storage/' . $news->image) }}">
    <meta name="twitter:card" content="summary_large_image">
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>{{ $news->category->name }}</li>
                            <li>{{ $news->subCategory->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="single-block-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="single-post">
                            <div class="post-header mb-3">
                                <a class="post-category" href="#">{{ $news->category->name }}</a>&nbsp;
                                @php
                                    $isBookmarked = App\Models\Newsbookmark::where('user_id', Auth::id())
                                        ->where('news_id', $news->id)
                                        ->exists();
                                    $isLiked = App\Models\Newslikedislike::where('user_id', Auth::id())
                                        ->where('news_id', $news->id)
                                        ->exists();
                                @endphp

                                @if ($isLiked)
                                    <!-- Already bookmarked -->
                                    <form action="{{ route('bookmark.remove', $news->id) }}" method="POST"
                                        style="display:inline;" id="bookmark-form-{{ $news->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; padding: 0;">
                                            <i class="fa fa-bookmark" style="color: red;">&nbsp;Bookmarked</i>
                                            <!-- Different style for bookmarked -->
                                        </button>
                                    </form>
                                @else
                                    <!-- Not bookmarked yet -->
                                    <form action="{{ route('bookmark.add', $news->id) }}" method="POST"
                                        style="display:inline;" id="bookmark-form-{{ $news->id }}">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; padding: 0;">
                                            <i class="fa fa-bookmark">&nbsp;Bookmark</i>
                                        </button>
                                    </form>
                                @endif
                                @if ($isLiked)
                                    <!-- Already liked -->
                                    <form action="{{ route('like.remove', $news->id) }}" method="POST"
                                        style="display:inline;" id="like-form-{{ $news->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; padding: 0;">
                                            <i class="fa fa-heart" style="color: red;">&nbsp;Liked</i>
                                            <!-- Different style for liked -->
                                        </button>
                                    </form>
                                @else
                                    <!-- Not liked yet -->
                                    <form action="{{ route('like.add', $news->id) }}" method="POST"
                                        style="display:inline;" id="like-form-{{ $news->id }}">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; padding: 0;">
                                            <i class="fa fa-heart-o">&nbsp;Like</i>
                                        </button>
                                    </form>
                                @endif

                                <h2 class="post-title">
                                    {{ $news->title }}
                                </h2>
                                {{-- <p>It was a cheerful prospect. I asked Perry what he thought about it; but he only shrugged
                                his shoulders and continued a longwinded prayer he had been at for some time. He was
                                wont to say that the only redeeming feature of our captivity was the ample time it gave
                                him for the improvisation of prayers</p> --}}
                            </div>
                            <div class="post-body">

                                {{-- i can use this for showing ad --}}

                                {{-- <div class="post-featured-image">
                                <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid" alt="featured-image">
                            </div> --}}
                                <div class="entry-content">
                                    <p>

                                    </p>
                                    <div class="media mb-4 single-media">
                                        {{-- <img src="images/news/img-1.jpg" alt="post-ads" class="img-fluid mr-4"> --}}
                                        <div class="media-body">
                                            <p>
                                                {!! $news->content !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="share-block  d-flex justify-content-between align-items-center border-top border-bottom mt-5">
                                    <div class="post-tags">
                                        @php
                                            $subCategory = App\Models\Sub_category::where(
                                                'category_id',
                                                $news->category_id,
                                            )->get(); // dd($addetail);

                                        @endphp
                                        <span>Category</span>
                                        @foreach ($subCategory as $sub)
                                            <a
                                                href="{{ route('news.subcategory', ['id' => $sub->id, 'name' => urlencode($sub->name)]) }}">{{ $sub->name }}</a>
                                        @endforeach

                                    </div>

                                    <ul class="share-icons list-unstyled">
                                        <li class="facebook">
                                            <a href="#"
                                                onclick="shareOnFacebook('{{ $news->title }}', '{{ $news->content }}', '{{ $news->image }}')">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#"
                                                onclick="shareOnTwitter('{{ $news->title }}', '{{ $news->content }}', '{{ $news->image }}')">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="linkedin">
                                            <a href="#"
                                                onclick="shareOnLinkedIn('{{ $news->title }}', '{{ $news->content }}', '{{ $news->image }}')">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="#"
                                                onclick="shareOnInstagram('{{ $news->title }}', '{{ $news->content }}', '{{ $news->image }}')">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <div class="related-posts-block">
                            <h3 class="news-title">
                                <span>Related Posts</span>
                            </h3>
                            <div class="news-style-two-slide">
                                @foreach ($newsItems as $relatednews)
                                    <div class="item">
                                        <div class="post-block-wrapper clearfix">
                                            <div class="post-thumbnail mb-0">
                                                <a href="{{ route('news.show', $news->slug) }}">
                                                    <img class="img-fluid" style="max-height: 200px;"
                                                        src="{{ asset('storage/' . $relatednews->image) }}"
                                                        alt="post-thumbnail" />
                                                </a>
                                            </div>
                                            <a class="post-category" href="#">{{ $relatednews->category->name }}</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-sm">
                                                    <a
                                                        href="{{ route('news.show', $news->slug) }}">{{ Str::limit($news->title, 50, '...') }}</a>
                                                </h2>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Comments section -->
                        <div id="comments" class="comments-block block">
                            <h3 class="news-title">
                                <span>{{ count($comments) }} Comments</span>
                            </h3>
                            <ul class="all-comments">
                                @forelse ($comments as $comment)
                                    <li>
                                        <div class="comment">
                                            <!-- Assuming you have a user avatar, replace 'images/news/author-01.jpg' with the actual URL or path to the user avatar -->
                                            <img class="commented-person" alt=""
                                                src="{{ $comment->user->name }}">
                                            <div class="comment-body">
                                                <div class="meta-data">
                                                    <span class="commented-person-name">{{ $comment->user->name }}</span>
                                                    <!-- Assuming you have a 'user' relationship in your Comment model -->
                                                    <span class="comment-hour d-block"><i
                                                            class="fa fa-clock-o mr-2"></i>{{ $comment->created_at->format('F d, Y \a\t h:i a') }}</span>
                                                </div>
                                                <div class="comment-content">
                                                    <p>
                                                        {{ $comment->comment }}
                                                    </p>
                                                </div>
                                                <div class="text-left">
                                                    <a class="comment-reply" href="#"><i class="fa fa-reply"></i>
                                                        Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <p>No comments yet.</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="comment-form ">
                            <h3 class="title-normal">Leave a Reply </h3>
                            <p class="mb-4">Your email address will not be published. Required fields are marked *</p>
                            <form role="form" action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="newid" value="{{ $news->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control required-field" id="message" name="comment" placeholder="Message" rows="8"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="comments-btn btn btn-primary" type="submit">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="sidebar sidebar-right">
                            <div class="widget">
                                <h3 class="news-title">
                                    <span>Stay in touch</span>
                                </h3>

                                <ul class="list-inline social-widget">
                                    <li class="list-inline-item">
                                        <a class="social-page youtube" href="#">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </li>
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

                                @foreach ($newsItems as $hotnews)
                                    @if ($loop->first)
                                        {{-- Featured news item --}}
                                        <div class="post-overlay-wrapper">
                                            <div class="post-thumbnail">
                                                <img class="img-fluid" src="{{ asset('storage/' . $hotnews->image) }}"
                                                    alt="post-thumbnail" />
                                            </div>
                                            <div class="post-content">
                                                <a class="post-category white"
                                                    href="#">{{ $hotnews->category->name }}</a>
                                                <h2 class="post-title">
                                                    <a
                                                        href="{{ route('news.show', $hotnews->slug) }}">{{ $hotnews->title }}</a>
                                                </h2>
                                                <div class="post-meta white">
                                                    <span class="posted-time"><i
                                                            class="fa fa-clock-o mr-1"></i>{{ $hotnews->created_at->diffForHumans() }}</span>
                                                    {{-- Other meta data --}}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Other news items --}}
                                        <div class="post-list-block">
                                            <div class="post-block-wrapper post-float">
                                                <div class="post-thumbnail">
                                                    <a href="{{ route('news.show', $hotnews->slug) }}">
                                                        <img class="img-fluid"
                                                            src="{{ asset('storage/' . $hotnews->image) }}"
                                                            alt="post-thumbnail" />
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h2 class="post-title title-sm">
                                                        <a
                                                            href="{{ route('news.show', $hotnews->slug) }}">{{ $hotnews->title }}</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="posted-time"><i
                                                                class="fa fa-clock-o mr-1"></i>{{ $hotnews->created_at->diffForHumans() }}</span>
                                                        {{-- Other meta data --}}
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
        <script>
            function shareOnFacebook() {
                var url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href);
                window.open(url, '_blank');
            }

            function shareOnTwitter() {
                var url = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href);
                window.open(url, '_blank');
            }

            function shareOnLinkedIn() {
                var url = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(window.location.href);
                window.open(url, '_blank');
            }

            function shareOnInstagram() {
                var url = 'https://www.instagram.com/share?url=' + encodeURIComponent(window.location.href);
                window.open(url, '_blank');
            }
        </script>

        {{-- Example in your Blade template --}}
        {{-- <script>
        // Redirect to the news article page on page load
        window.location.href = "{{ route('news.view', ['id' => $news->id]) }}";
    </script> --}}
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Script to fetch and display news content using Ajax -->
        <script>
            $(document).ready(function() {
                // Get the news ID from somewhere (e.g., a data attribute or variable)
                var newsId = "{{ $news->id }}"; // Assuming $news is passed to the view from your controller

                // Ajax request to fetch news content
                $.ajax({
                    url: "{{ route('news.view', ['id' => ':id']) }}".replace(':id', newsId),
                    method: 'POST', // Use POST method
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for Laravel
                    },
                    success: function(response) {
                        // Update the page content with fetched news article
                        $('#news-content').html(
                            response); // Replace #news-content with your target element ID
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading news article:', error);
                    }
                });
            });
        </script>
    @endsection

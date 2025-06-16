@include('layouts.secondnav')
<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Bookmark</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 accounts">
                @include('user.sidebar')
            </div>
            <div class="col-md-9 col-sm-12 col-lg-9 py-2">
                <div class="container">
                    <div class="row">
                        @if ($bookmarks->isEmpty())
                            <p>No bookmarks found.</p>
                        @else
                            @foreach ($bookmarks as $bookmark)
                                <div class="comments post-block-wrapper post-float clearfix row mb-3">
                                    <div class="post-thumbnail col-md-3">
                                        <a href="{{ route('news.show', $bookmark->news->slug) }}">
                                            <img class="img-fluid"
                                                src="{{ asset('storage/' . $bookmark->news->image) }}"
                                                alt="post-thumbnail">
                                        </a>
                                    </div>

                                    <div class="post-content col-md-7">
                                        <h2 class="post-title title-sm">
                                            <a
                                                href="{{ route('news.show', $bookmark->news->slug) }}">{{ $bookmark->news->title }}</a>
                                        </h2>
                                        <p>{{ $bookmark->news->excerpt }}</p>
                                        <p><span class="posted-time"><i
                                                    class="fa fa-clock-o mr-2"></i>{{ $bookmark->news->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div class="post action col-md-2">
                                        <form action="{{ route('bookmark.remove', $bookmark->news->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="py-2 btn btn-primary btn-sm"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

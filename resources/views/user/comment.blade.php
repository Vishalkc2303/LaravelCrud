@include('layouts.secondnav')
<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>My Comments</li>
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
                        @foreach ($comments as $comment)
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="mb-3 comments post-block-wrapper post-float clearfix row">
                                    <div class="post-thumbnail col-md-3">
                                        <a href="{{ route('news.show', $comment->news->slug) }}">
                                            <img class="img-fluid" src="{{ asset('storage/' . $comment->news->image) }}"
                                                alt="post-thumbnail">
                                        </a>
                                    </div>

                                    <div class="post-content col-md-7">
                                        <h2 class="post-title title-sm">
                                            <a
                                                href="{{ route('news.show', $comment->news->slug) }}">{{ Str::limit($comment->news->title, 50, '...') }}</a>
                                        </h2>
                                        <p><strong>Comment:</strong> {{ $comment->comment }}</p>
                                        <p><span class="posted-time"><i
                                                    class="fa fa-clock-o mr-2"></i>{{ $comment->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div class="post action col-md-2">
                                        <form action="{{ route('comment.delete', $comment->id) }}" method="POST"
                                            id="delete-form-{{ $comment->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="py-2 btn btn-primary btn-sm"
                                                onclick="confirmDelete('{{ $comment->id }}')"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

<script>
    function confirmDelete(commentId) {
        if (confirm('Are you sure you want to delete this comment?')) {
            document.getElementById('delete-form-' + commentId).submit();
        }
    }
</script>

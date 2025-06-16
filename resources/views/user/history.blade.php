@include('layouts.secondnav')

<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>History</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="py-5">
    <div class="container">

        
        <form id="deleteAllForm" action="{{ route('history.deleteAll') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDeleteAll()" class="py-2 btn btn-danger btn-sm"><i
                    class="fa fa-trash-o"></i> Delete All History</button>
        </form>

        <script>
            function confirmDeleteAll() {
                if (confirm('Are you sure you want to delete all history entries? This action cannot be undone.')) {
                    document.getElementById('deleteAllForm').submit();
                }
            }
        </script>


        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 accounts">
                @include('user.sidebar')
            </div>


            <div class="col-md-9 col-sm-12 col-lg-9 py-2">
                <div class="container">
                    <div class="row">
                        @if ($historys->isEmpty())
                            <p>No history found.</p>
                        @else
                            @foreach ($historys as $history)
                                <div class="comments post-block-wrapper post-float clearfix row mb-3">
                                    <div class="post-thumbnail col-md-3">
                                        <a href="{{ route('news.show', $history->news->slug) }}">
                                            <img class="img-fluid" src="{{ asset('storage/' . $history->news->image) }}"
                                                alt="post-thumbnail">
                                        </a>
                                    </div>

                                    <div class="post-content col-md-7">
                                        <h2 class="post-title title-sm">
                                            <a
                                                href="{{ route('news.show', $history->news->slug) }}">{{ $history->news->title }}</a>
                                        </h2>
                                        <p>{{ $history->news->excerpt }}</p>
                                        <p><span class="posted-time"><i
                                                    class="fa fa-clock-o mr-2"></i>{{ $history->news->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div class="post action col-md-2">
                                        <form id="deleteForm{{ $history->id }}"
                                            action="{{ route('history.remove', $history->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $history->id }}')"
                                                class="py-2 btn btn-primary btn-sm"><i
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

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this history entry?')) {
            document.getElementById('deleteForm' + id).submit();
        }
    }
</script>

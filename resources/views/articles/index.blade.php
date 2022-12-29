@extends("layouts.app")

@section("content")
<div class="container">

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    {{-- page links --}}
    {{ $articles->links() }}
    @foreach ($articles as $article)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->comments->count() }} Comments,
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <div class="card-text mb-2">{{ $article->body }}</div>
                <a class="card-link" href="{{ url ("/articles/detail/$article->id") }}" >View Detail &raquo;</a>
            </div>
        </div>
    @endforeach
</div>
@endsection




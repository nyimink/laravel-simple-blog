@extends('layouts.app')

@section ("content")
    <div class="container">
        @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }},
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                @auth
                    <a class="btn btn-danger" href="{{ url ("/articles/delete/$article->id") }}">
                        Delete
                    </a>
                @endauth
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count( $article->comments ) }})</b>
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <div>
                        <b class="text-success">{{ $comment->user->name }}</b>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    @auth
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endauth
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>
       @auth
         <form action="{{ url("/comments/add") }}" method="post">
             @csrf
             <input type="hidden" name="article_id" value="{{ $article->id }}">
             <textarea name="content" class="form-control my-2" placeholder="New Comment"></textarea>
             <button class="btn btn-secondary">Comment</button>
         </form>
       @endauth
    </div>

@endsection

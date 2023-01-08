@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <form method="post">
            @csrf
            <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}">
            </div>
            <div class="mb-3">
                <label for="">Body</label>
                <input type="text" class="form-control" name="body" value="{{ $article->body }}">
            </div>
            <div class="mb-3">
                <label for="">Category</label>
                <select name="category_id" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}"
                        @if ($article->category_id == $category->id)
                            selected
                        @endif
                        >
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    </div>


@endsection

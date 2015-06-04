@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">News</h1>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if(Auth::user()->isAdmin())
                <div>
                    <a class="btn btn-default" href="/news/create">Add News</a>
                </div>
                <br>
            @endif
            @foreach($news as $new)
                <div class="article">
                    @if($new->news_pic)
                        <img src="{{ Image::path($new->news_pic, 'resizeCrop, 200,150') }}" class="image">
                    @endif
                    <div class="time">{{ $new->created_at->format('F d, Y H:i') }}</div>
                    <a href="/news/{{ $new->id }}" class="article-link">{{ $new->subject }}</a>
                    <p>{{ Str::limit($new->text, 100) }}</p>
                </div>
            @endforeach
        </div>
    </div>
@stop
@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">{{ $news->subject }}</h1>
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
                    <a class="btn btn-danger pull-right" href="/news/delete/{{ $news->id }}" onclick="return confirm('Are you sure?');"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                </div>
            @endif
            <div>
                <div class="time"><b>Published on:</b> {{ $news->created_at->format('d/m/Y H:i') }}</div>
                <img src="{{ $news->news_pic }}" style="max-height: 250px;">
                <p style="margin-top: 10px;">{{ $news->text }}</p>
            </div>
            <hr>
            <h4>Comments:</h4>
            @foreach($news->comments()->get() as $comment)
                <div class="comment-outline">
                    @if(Auth::user()->isAdmin())
                        <a class="panel-close close" href="{{ URL::route('newsCommentDelete', $comment->id) }}" data-dismiss="alert">×</a>
                    @endif
                    {{ $comment->comment }}
                </div>
                <div><img src="{{Image::path($comment->user->profile->profilePic, 'resizeCrop, 50,50')}}"  style="width: 50px; height:50px; float:left; margin-top: 5px;" class="img-circle"></div>
                <div class="comment">
                    <div class="comment-user">
                        {{ $comment->user()->first()->name }} {{ $comment->user()->first()->surname }}
                    </div>
                    <div class="time" style="padding-top: 0px;">
                        {{ $comment->created_at->format('F d, Y H:i') }}
                    </div>
                </div>
            @endforeach
            <br>
            {{ Form::open(array('class' => 'form-newcomment', 'action' => array('newsCreateComment', $news->id))) }}
            <div class="form-group">
                {{ Form::label('comment', 'Comment:') }}
                {{ Form::text('comment', null, array('class'=>'form-control', 'placeholder'=>'Please, leave a comment')) }}
            </div>
            {{ Form::submit('Leave a comment', array('class'=>'btn btn-primary'))}}
            {{ Form::close() }}
        </div>
    </div>
@stop
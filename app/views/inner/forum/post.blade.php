@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        {{--<h1 class="page-header">Forum | {{ $group->title }} | {{ $category->title }} | {{ $post->title }}</h1>--}}
        <ol class="page-header breadcrumb">
            <li><a href="{{ URL::route('forum') }}">Forum</a></li>
            <li><a href="{{ URL::route('forum') }}#{{ $group->id }}">{{ $group->title }}</a></li>
            <li><a href="{{ URL::route('forumCategory', $category->id) }}">{{ $category->title }}</a></li>
            <li class="active">{{ $post->title }}</li>
        </ol>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @foreach($errors->all() as $error)
                <div class="alert alert-info alert-dismissable">
                    <i class="fa fa-coffee"></i>
                    <li>{{ $error }}</li>
                </div>
            @endforeach
            <div class="clearfix">
                @if(Auth::user()->isAdmin())
                    <a class="btn btn-danger pull-right delete_post" href="#" data-toggle="modal" data-target="#post_delete" id="{{ $post->id }}"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                @endif
                @if(Auth::user()->id == $post->user_id)
                    <a class="btn btn-success pull-right" href="{{ URL::route('forumEditPost', $post->id) }}"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                @endif
            </div>
            <div class="well post">
                <div><img src="{{Image::path($user->profile->profilePic, 'resizeCrop, 150,150')}}"  style="width: 100px; height:100px; float:right;" class="img-circle"></div>
                <h1>{{ $post->title }}</h1>
                <h4>By: {{ $user->name }} {{ $user->surname }} on {{ $post->created_at }}</h4>
                <hr>
                <p>{{ nl2br(BBCode::parse($post->body)) }}</p>
            </div>
            @foreach($post->comments()->get() as $comment)
                <div class="well">
                    @if(Auth::user()->isAdmin())
                        <a class="panel-close close" href="{{ URL::route('forumDeleteComment', $comment->id) }}" data-dismiss="alert">×</a>
                    @endif
                    <h5><b>{{ $comment->user()->first()->name }} {{ $comment->user()->first()->surname }} on {{ $comment->created_at }} commented</b></h5>
                    <hr>
                    <p>{{ nl2br(BBCode::parse($comment->comment)) }}</p>
                </div>
            @endforeach
            {{ Form::open(array('class' => 'form-newcomment', 'action' => array('forumCreateComment', $post->id))) }}
            <div class="form-group">
                {{ Form::label('comment', 'Comment:') }}
                {{ Form::text('comment', null, array('class'=>'form-control', 'placeholder'=>'Please, leave a comment')) }}
            </div>

            {{ Form::submit('Leave a comment', array('class'=>'btn btn-primary'))}}
            {{ Form::close() }}
        </div>
        @if(Auth::user()->isAdmin())
            <div class="modal fade" id="post_delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Delete Post</h4>
                        </div>
                        <div class="modal-body">
                            <h3>Are you sure you want to delete the post?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a href="#" type="button" class="btn btn-primary" id="btn_delete_post">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
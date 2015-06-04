@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">New Post</h1>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            {{ Form::open(array('class' => 'form-newpost', 'action' => array('forumCreatePost', $id))) }}
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <div class="form-group">
                    {{ Form::label('title', 'Title:') }}
                    {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Please, name the post')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('body', 'Post text:') }}
                    {{ Form::textarea('body', null, array('class'=>'form-control', 'placeholder'=>'Your text goes here')) }}
                </div>

                {{ Form::submit('Create', array('class'=>'btn btn-primary'))}}
            {{ Form::close() }}
        </div>
    </div>
@stop
@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Create News</h1>
    </div>
    <div class="container">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            {{Form::open(array('action' => array('NewsController@create') ,'files' => true))}}
            <div class="span8">
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::file('news_pic', array('id' => 'profilePicture', 'onchange' => 'changeProfilePicture()' ))}}
                    </div>
                    @if( $errors->first('news_pic'))
                        <p style="color: red;">{{ $errors->first('news_pic') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('subject', 'Subject:') }}
                    {{ Form::text('subject', null, array('class'=>'form-control')) }}
                    @if( $errors->first('subject'))
                        <p style="color: red;">{{ $errors->first('subject') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('text', 'Text:') }}
                    {{ Form::textarea('text', null, array('class'=>'form-control')) }}
                    @if( $errors->first('text'))
                        <p style="color: red;">{{ $errors->first('text') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                {{ Form::submit('Create', array('class'=>'btn btn-primary col-md-2'))}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('footer-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    {{ HTML::script('js/fileUpload.js') }}
    <script src="../../js/editProfile.js"></script>
@stop
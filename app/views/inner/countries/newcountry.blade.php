@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">New Country</h1>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>
                Please, check country code in this <a href="http://tourismmap.net/countries/codes" target="_blank"><strong>list</strong></a> before creating country!
            </div>
            {{Form::open(array('action' => array('CountryController@create') ,'files' => true))}}
            <div class="span8">
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::file('flag', array('id' => 'profilePicture', 'onchange' => 'changeProfilePicture()' ))}}
                    </div>
                    @if( $errors->first('flag'))
                        <p style="color: red;">{{ $errors->first('flag') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('name', 'Country:') }}
                    {{ Form::text('name', null, array('class'=>'form-control')) }}
                    @if( $errors->first('name'))
                        <p style="color: red;">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('capital', 'Capital:') }}
                    {{ Form::text('capital', null, array('class'=>'form-control')) }}
                    @if( $errors->first('capital'))
                        <p style="color: red;">{{ $errors->first('capital') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('area', 'Area:') }}
                    {{ Form::text('area', null, array('class'=>'form-control')) }}
                    @if( $errors->first('area'))
                        <p style="color: red;">{{ $errors->first('area') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('population', 'Population:') }}
                    {{ Form::text('population', null, array('class'=>'form-control')) }}
                    @if( $errors->first('population'))
                        <p style="color: red;">{{ $errors->first('population') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('code', 'Code:') }}
                    {{ Form::text('code', null, array('class'=>'form-control')) }}
                    @if( $errors->first('code'))
                        <p style="color: red;">{{ $errors->first('code') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('currency', 'Currency:') }}
                    {{ Form::text('currency', null, array('class'=>'form-control')) }}
                    @if( $errors->first('currency'))
                        <p style="color: red;">{{ $errors->first('currency') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('languages', 'Languages:') }}
                    {{ Form::text('languages', null, array('class'=>'form-control')) }}
                    @if( $errors->first('languages'))
                        <p style="color: red;">{{ $errors->first('languages') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('guide', 'Travel guide link:') }}
                    {{ Form::text('guide', null, array('class'=>'form-control')) }}
                    @if( $errors->first('guide'))
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('timezone', 'Timezone:') }}
                    {{ Form::text('timezone', null, array('class'=>'form-control')) }}
                    @if( $errors->first('timezone'))
                        <p style="color: red;">{{ $errors->first('timezone') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('facts', 'Facts:') }}
                    {{ Form::textarea('facts', null, array('class'=>'form-control')) }}
                    @if( $errors->first('facts'))
                        <p style="color: red;">{{ $errors->first('facts') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('description', 'Description:') }}
                    {{ Form::textarea('description', null, array('class'=>'form-control')) }}
                    @if( $errors->first('description'))
                        <p style="color: red;">{{ $errors->first('description') }}</p>
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
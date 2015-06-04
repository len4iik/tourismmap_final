@extends('inner/innerlayout')
@section('head')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Edit User profile</h1>
    </div>
    <div class="container">
        <div class="col-md-6 col-md-offset-2">
            {{Form::open(array('action' => 'updateProfile', 'files' => true))}}
            <div class="span2 col-md-12" >
                <img src="{{Image::path(Auth::user()->profile->profilePic, 'resizeCrop, 200,200')}}" id="profileImage" class="img-circle col-md-5">
            </div>
            <div class="col-lg-12">&nbsp;</div>
            {{Form::file('profilePicture', array('id' => 'profilePicture', 'onchange' => 'changeProfilePicture()' ))}}
            @if( $errors->first('profilePicture'))
                <p style="color: red;">{{ $errors->first('profilePicture') }}</p>
            @endif
            <br>
            <div class="span8">
                <div class="form-group">
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name', Auth::user()->name, array('class'=>'form-control')) }}
                    @if( $errors->first('name'))
                        <p style="color: red;">{{ $errors->first('name') }}</p>
                    @endif

                    {{ Form::label('surname', 'Surname:') }}
                    {{ Form::text('surname', Auth::user()->surname, array('class'=>'form-control')) }}
                    @if( $errors->first('surname'))
                        <p style="color: red;">{{ $errors->first('surname') }}</p>
                    @endif

                    {{ Form::label('date', 'Birth Date:') }}
                    {{ Form::input('date','Birth Date' , Auth::user()->birth_date, array('class' => 'form-control', 'id' => 'birth')) }}

                    {{ Form::label('select-items', 'Countries:') }}
                    {{ Form::select('select-items[]', $countries, array_map(function($country){return $country->country_id;}, Auth::user()->countries->all()), array('class' => 'form-control select2' , 'id' => 'select2', 'multiple' => 'multiple')); }}

                    {{ Form::label('amoutMe', 'About me:') }}
                    {{ Form::textarea('about', Auth::user()->profile->about, array('class'=>'form-control', 'size' => '10x5')) }}
                    @if( $errors->first('about'))
                        <p style="color: red;">{{ $errors->first('about') }}</p>
                    @endif

                </div>
            </div>
            {{ Form::submit('submit', array('class'=>'btn btn-primary pull-right'))}}
            {{ Form::close() }}
        </div>
    </div>
@stop


@section('footer-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    {{ HTML::script('js/fileUpload.js') }}
    <script src="../../js/editProfile.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>
@stop

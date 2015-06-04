@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Edit Country - {{$country->name}}</h1>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            {{Form::open(array('action' => array('CountryController@edit',$country->name) ,'files' => true))}}
            <div class="span2">
                <img src="{{Image::path($country->flag, 'resizeCrop, 300,200')}}" id="profileImage" class="img col-md-2">
            </div>
            <div class="col-lg-12">&nbsp;</div>
            <br>
            <br>
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
                    {{ Form::text('name', $country->name, array('class'=>'form-control', 'id' => 'disabledInput', 'disabled')) }}
                    @if( $errors->first('name'))
                        <p style="color: red;">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('capital', 'Capital:') }}
                    {{ Form::text('capital', $country->capital, array('class'=>'form-control')) }}
                    @if( $errors->first('capital'))
                        <p style="color: red;">{{ $errors->first('capital') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('area', 'Area:') }}
                    {{ Form::text('area', $country->area, array('class'=>'form-control')) }}
                    @if( $errors->first('area'))
                        <p style="color: red;">{{ $errors->first('area') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('population', 'Population:') }}
                    {{ Form::text('population', $country->population, array('class'=>'form-control')) }}
                    @if( $errors->first('population'))
                        <p style="color: red;">{{ $errors->first('population') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('code', 'Code:') }}
                    {{ Form::text('code', $country->code, array('class'=>'form-control')) }}
                    @if( $errors->first('code'))
                        <p style="color: red;">{{ $errors->first('code') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('currency', 'Currency:') }}
                    {{ Form::text('currency', $country->currency, array('class'=>'form-control')) }}
                    @if( $errors->first('currency'))
                        <p style="color: red;">{{ $errors->first('currency') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('languages', 'Languages:') }}
                    {{ Form::text('languages', $country->languages, array('class'=>'form-control')) }}
                    @if( $errors->first('languages'))
                        <p style="color: red;">{{ $errors->first('languages') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('guide', 'Travel guide link:') }}
                    {{ Form::text('guide', $country->guide, array('class'=>'form-control')) }}
                    @if( $errors->first('guide'))
                        <p style="color: red;">{{ $errors->first('guide') }}</p>
                        <br>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('timezone', 'Timezone:') }}
                    {{ Form::text('timezone', $country->timezone, array('class'=>'form-control')) }}
                    @if( $errors->first('timezone'))
                        <p style="color: red;">{{ $errors->first('timezone') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('facts', 'Facts:') }}
                    {{ Form::textarea('facts', $country->facts, array('class'=>'form-control')) }}
                    @if( $errors->first('facts'))
                        <p style="color: red;">{{ $errors->first('facts') }}</p>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    {{ Form::label('description', 'Description:') }}
                    {{ Form::textarea('description', $country->description, array('class'=>'form-control')) }}
                    @if( $errors->first('description'))
                        <p style="color: red;">{{ $errors->first('description') }}</p>
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
@stop
@extends('outerlayout')

@section('content')


    <div class="col-md-offset-4 col-md-4 well">
    <a href="/"><span class="glyphicon glyphicon-arrow-left"></span></a>
        <h2 class="form-signup-heading reg-head">Please Register</h2>
        {{ Form::open(array('class' => 'form-signup', 'action' => 'createUser')) }}
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <div class="form-group">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
            </div>

            <div class="form-group">
                {{ Form::label('surname', 'Surname:') }}
                {{ Form::text('surname', null, array('class'=>'form-control', 'placeholder'=>'Surname')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password_confirmation', 'Confirm the password:') }}
                {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
            </div>

            {{ Form::submit('Sign up', array('class'=>'btn btn-large btn-primary btn-block'))}}
        {{ Form::close() }}
    </div>
@stop
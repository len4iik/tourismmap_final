@extends('inner/innerlayout')
@section('head')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Change your password</h1>
    </div>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3 class="text-center">Need to change your Password?</h3>
                            <p>You can do it right here!.</p>
                            @if(Session::get('badmessage'))
                                <p style="color: red;">{{ Session::get('badmessage') }}</p>
                            @endif
                            @if(Session::get('goodmessage'))
                                <p style="color: green;">{{ Session::get('goodmessage') }}</p>
                            @endif
                            {{ Form::open(array('action' => 'changePassword', 'class' => 'form-horizontal')) }}

                                <div class="form-group">
                                    {{ Form::label('password', 'Old:', array('class' => 'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::password('password', array('placeholder'=>'Old Password', 'class' => 'form-control')) }}
                                    </div>
                                    @if( $errors->first('password'))
                                        <p style="color: red;">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::label('new_password', 'New:', array('class' => 'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::password('new_password', array('placeholder'=>'New Password', 'class' => 'form-control')) }}
                                    </div>
                                    @if( $errors->first('new_password'))
                                        <p style="color: red;">{{ $errors->first('new_password') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::label('confirm_new_password', 'Confirm:', array('class' => 'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::password('confirm_new_password', array('placeholder'=>'Confirm New Password', 'class' => 'form-control')) }}
                                    </div>
                                    @if( $errors->first('confirm_new_password'))
                                        <p style="color: red;">{{ $errors->first('confirm_new_password') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::submit('Submit', array('class'=>'btn btn-success'))}}
                                </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
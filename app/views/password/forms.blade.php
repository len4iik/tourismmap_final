@extends('outerlayout')

@section('content')
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3 class="text-center">Forgot your password?</h3>
                            <p>You can remake it right here!.</p>
                            @if(Session::has('bad'))
                                <p style="color: red;">{{ Session::get('bad') }}</p>
                            @endif
                            @if(Session::has('good'))
                                <p style="color: green;">{{ Session::get('good') }}</p>
                            @endif
                            {{ Form::open(array('class' => 'form-horizontal')) }}
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
                            <a style="text-align: left" href="/">Back</a>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
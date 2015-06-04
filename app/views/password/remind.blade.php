@extends('outerlayout')

@section('content')
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3 class="text-center">Forgot your password?</h3>
                            <p>You can remake it right here!</p>
                            @if(Session::has('bad'))
                                <p style="color: red;">{{ Session::get('bad') }}</p>
                            @endif
                            @if(Session::has('good'))
                                <p style="color: green;">{{ Session::get('good') }}</p>
                            @endif
                            {{ Form::open(array('route' => 'remindSend', 'class' => 'form-horizontal')) }}
                            <div class="form-group">
                                {{ Form::label('email', 'Email:', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    {{ Form::email('email',null, array('placeholder'=>'Your email...', 'class' => 'form-control')) }}
                                </div>
                                @if( $errors->first('email'))
                                    <p style="color: red;">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Send', array('class'=>'btn btn-success'))}}
                            </div>
                            {{ Form::close() }}<!--/end form-->
                            <a style="text-align: left" href="/">Back</a>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop
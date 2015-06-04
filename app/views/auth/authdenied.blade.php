@extends('outerlayout')

@section('content')
    <div class="col-md-offset-4 col-md-4 well">
        {{ HTML::image('img/logo_white.png', '', array('class' => 'logo')) }}
        <br>
        <div class="center">
            We are sorry, but your profile has been blocked due to breach of our rules.<br>
            If you have any questions, please contact our head administrator Helen Shorohova:<br>
            helen.shorohova [at] gmail.com
        </div>
        <div class="authden_logout">
            <a href="/logout">Logout</a>
        </div>
    </div>
@stop
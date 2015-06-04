@extends('outerlayout')

@section('content')
    <div class="col-md-offset-4 col-md-4 well">
        {{ HTML::image('img/logo_white.png', '', array('class' => 'logo')) }}
        <br>
        <div class="center">
            If you have any questions, you are welcome to contact our head administrator<br>
            Helen Shorohova via e-mail<br>
            helen.shorohova [at] gmail.com<br>
            or her Facebook account<br>
            https://www.facebook.com/helen.shorohova<br>
            Also you can contact us via our main e-mail address<br>
            tourismmap.info [at] gmail.com
        </div>
        <a href="/"><span class="glyphicon glyphicon-arrow-left"></span></a>
    </div>
@stop
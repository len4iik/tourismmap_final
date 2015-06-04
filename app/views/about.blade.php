@extends('outerlayout')

@section('content')
    <div class="col-md-offset-4 col-md-4 well">
        {{ HTML::image('img/logo_white.png', '', array('class' => 'logo')) }}
        <br>
        <div class="center">
            We are the web community for true travel lovers. You can choose the countries you have visited<br> and they are going to change
            the color on your personal map. We hope you will love the idea of<br> our project and share our link with others.<br>
            Yours faithfully, Helen Shorohova
        </div>
        <a href="/"><span class="glyphicon glyphicon-arrow-left"></span></a>
    </div>
@stop
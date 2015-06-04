<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Helen Shorohova">
    <title>Tourismmap.net</title>
    <!-- Bootstrap -->
    {{ HTML::style('css/bootstrap.css'); }}
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('css/dashboard.css'); }}
    {{ HTML::style('css/forum.css'); }}
    {{ HTML::style('css/jquery-jvectormap-2.0.2.css'); }}
    {{ HTML::style('css/admin.css'); }}
    {{ HTML::style('css/inner.css'); }}
    @section('head')
    @show
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand img" href="/"><img src="http://tourismmap.net/img/icon.png" style="max-height: 45px;"></a>
            <a class="navbar-brand" href="/">TourismMap</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/profile">My profile</a></li>
                <li><a href="/logout">Log out</a></li>
            </ul>
            <div class="navbar-center">WE LOVE TO TRAVEL</div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <div><img src="{{Image::path(Auth::user()->profile->profilePic, 'resizeCrop, 150,150')}}"  style="width: 150px; height:150px;" class="img-circle"></div>
            <ul class="nav nav-sidebar">
                <li class=""><a href="/"><i class="glyphicon glyphicon-globe"></i> Your map</a></li>
                <li class="navItems"><a href="/news"><i class="glyphicon glyphicon-list-alt"></i> News</a></li>
                <li class="navItems"><a href="/forum"><i class="glyphicon glyphicon-pencil"></i> Forum</a></li>
                <li class="navItems"><a href="/countries"><i class="glyphicon glyphicon-flag"></i> Countries</a></li>
                @if(Auth::user()->isAdmin())
                    <li class="navItems"><a href="/admin"><i class="glyphicon glyphicon-cog"></i> Admin panel</a></li>
                @endif
            </ul>
            <ul class="nav nav-sidebar">
            </ul>
        </div>
    </div>
</div>
@yield('content')
<div class="footer col-md-offset-2">
    <div style="float: left">
        <div class="footer-title">About us</div>
        <div class="footer-text"> We are the web community for true travel lovers. You can choose the countries you have
            visited and they are going to change the color on your personal map. We hope you will love the idea of our
            project and share our link with others. <br>
            Yours faithfully, Helen Shorohova
        </div>
    </div>
    <div style="float: left; margin-left: 40px;">
        <div class="footer-title">Follow us</div>
        <div class="footer-text" style="margin-top: 0px"> <br>
            <a href="https://twitter.com/HShorohova"><img src="http://tourismmap.net/img/twitter_50.png"></a>
            <a href="https://instagram.com/hshorohova/"><img src="http://tourismmap.net/img/instagram_50.png"></a>
            <a href="https://www.facebook.com/helen.shorohova"><img src="http://tourismmap.net/img/facebook_50.png"></a>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@section('footer-js')
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/jquery/jquery-jvectormap-2.0.2.min.js') }}
    {{ HTML::script('js/jquery/jquery-jvectormap-europe-mill-en.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/holder.js') }}
    {{ HTML::script('js/form.js') }}
@show
@if(Session::has('modal'))
    <script type="text/javascript">
        $("{{ Session::get('modal') }}").modal('show');
    </script>
@endif
@if(Session::has('group-modal') && Session::has('group-id'))
    <script type="text/javascript">
        $("#group_update_form").prop('action', "/forum/group/{{ Session::get('group-id') }}/edit");
        $("{{ Session::get('group-modal') }}").modal('show');
    </script>
@endif
@if(Session::has('category-modal') && Session::has('group-id'))
    <script type="text/javascript">
        $("#category_form").prop('action', "/forum/category/{{ Session::get('group-id') }}/new");
        $("{{ Session::get('category-modal') }}").modal('show');
    </script>
@endif
</body>
</html>

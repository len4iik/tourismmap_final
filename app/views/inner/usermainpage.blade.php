@extends('inner/innerlayout')

@section('content')
    {{ HTML::script('js/jquery/jquery.js') }}
    {{ HTML::script('js/jquery/jquery-jvectormap-2.0.2.min.js') }}
    {{ HTML::script('js/jquery/jquery-jvectormap-europe-mill-en.js') }}
    <script type="text/javascript">
        var visited = {
            @foreach($countries as $country)
            "{{ $country->country_short_name }}": 1,
            @endforeach
            }
    </script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Your Map</h1>
</div>
<div class="container">
    <div class="col-md-offset-2">
        <div id="map" style="float:left; width: 600px; height: 500px; border: 1px solid;"></div>
        {{ HTML::script('js/map.js') }}
        <h1 class="country_text">You have visited</h1>
        <h1 class="country_text_count">{{ $country_count }}</h1>
        <h1 class="country_text">countries!</h1>
    </div>
</div>
@stop
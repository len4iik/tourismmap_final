@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">User profile</h1>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            <div class="profile">
                <img src="{{Image::path(Auth::user()->profile->profilePic, 'resizeCrop, 200,200')}}" class="img-circle" style="float:left;">
                <section id="info-page" style="margin-left: 250px;">
                    <header style="display: block; margin-bottom: 12px; ">
                        <h1 class="profile-h1">{{Auth::user()->name}} {{Auth::user()->surname}}</h1>
                        <h2 class="profile-h2">{{Auth::user()->email}}</h2>
                    </header>
                    <h6>Birth date: {{Auth::user()->birth_date}}</h6>
                    <h5><b>Visited countries:
                        @if($userCountries != null)
                            @foreach($userCountries as $userCountry)
                                @if($userCountry !== end($userCountries))
                                    {{ $userCountry }},
                                @else
                                    {{ $userCountry }}
                                @endif
                            @endforeach
                        @else
                        You haven't visited any country yet!
                        @endif
                    </b></h5>
                    @if(Auth::user()->profile->about != null)
                        <p class="description">{{Auth::user()->profile->about}}</p>
                    @endif
                    <div class="span2">
                        <div class="btn-group">
                            <a href="/editProfile" class="grey-button"><i class="glyphicon glyphicon-pencil"></i> edit profile</a>
                            <a class="grey-button" href="/changePassword"><i class="glyphicon glyphicon-lock"></i> change password</a>
                        </div>
                    </div>
            </div>
        </div>
        </section>
    </div>
    </div>
@stop
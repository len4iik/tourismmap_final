@extends('inner/innerlayout')

@section('content')
    <div class="container">
        <div class="col-md-offset-2">
            @if(Auth::user()->isAdmin())
                <a href="/countries/delete/{{ $country->id }}" onclick="return confirm('Are you sure?');" class="btn btn-danger pull-right">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
                <a href="/countries/edit/{{ $country->name }}" class="btn btn-info pull-right" data-title="Confirm" data-content="Are you sure?">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
            @endif
            <div class="country-header" style="padding-bottom: 5px;">
                <img src="{{Image::path($country->flag, 'resizeCrop, 60,40')}}" id="profileImage" class="flag" style="float:left;">
                <h1>{{ $country->name }}</h1>
                <span class="updated-date">
                    <div>Last updated: {{$country->updated_at->format('F d, Y') }}</div>
                </span>
            </div>
            <div class="country-info">
                <h2>General information:</h2>
                <ul>
                    <li class="no-border">
                        <div>
                            <h3>CAPITAL:</h3>
                            <p>{{ $country->capital }}</p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>LANGUAGES:</h3>
                            <p>{{ $country->languages }}</p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>AREA:</h3>
                            <p>{{ $country->area }}</p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>POPULATION:</h3>
                            <p>{{ $country->population }}</p>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li class="no-border">
                        <div>
                            <h3>CURRENCY:</h3>
                            <p>{{ $country->currency }}</p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>TIMEZONE:</h3>
                            <p>{{ $country->timezone }}</p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>ISO CODE:</h3>
                            <p>{{ $country->code }}</p>
                        </div>
                    </li>
                    @if($country->guide != null)
                        <li>
                            <div>
                                <h3>TRAVEL GUIDE LINK:</h3>
                                <p><a href="{{ $country->guide }}" target="_blank">{{ $country->name }} travel guide</a></p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="country-facts" style="clear:both;">
                @if($country->facts != null)
                    <h2>Interesting facts:</h2>
                    <p style="margin-bottom: 20px;"><i>{{  nl2br($country->facts) }}</i></p>
                @endif
                <h2>Description:</h2>
                <p style="text-indent:10px;">{{  nl2br($country->description) }}</p>
            </div>
        </div>
    </div>
@stop
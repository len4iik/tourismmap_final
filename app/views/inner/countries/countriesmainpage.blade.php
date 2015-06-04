@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Countries</h1>
    </div>
    <div class="container">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if(Auth::user()->isAdmin())
                <div>
                    <a class="btn btn-default" href="/countries/create">Add Country</a>
                </div>
                <br>
            @endif
            <table class="reference">
                @foreach($countries as $country)
                    <tr>
                        <td>
                            <a href="/countries/{{ $country->name }}">{{ $country->name }}</a>
                        </td>
                        @if(Auth::user()->isAdmin())
                            <td style="width:100px;">
                                <a href="/countries/delete/{{ $country->id }}" onclick="return confirm('Are you sure?');" class="btn btn-danger delete_country">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                                <a href="/countries/edit/{{ $country->name }}" class="btn btn-info" data-title="Confirm" data-content="Are you sure?">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
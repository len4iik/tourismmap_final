@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Admin Panel</h1>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <table class="reference" style="width:100%">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>E-mail</th>
                    <th>Set Admin Status</th>
                    <th>Set Block Status</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->isAdmin()) <a class="btn btn-default btn-xs" href="{{ URL::route('setAdmin', $user->id) }}">Remove from admins</a>
                            @else <a class="btn btn-default btn-xs" href="{{ URL::route('setAdmin', $user->id) }}">Set as an admin</a>
                            @endif
                        </td>
                        <td>
                            @if($user->isBlocked()) <a class="btn btn-default btn-xs" href="{{ URL::route('blockUser', $user->id) }}">Unblock</a>
                            @else <a class="btn btn-default btn-xs" href="{{ URL::route('blockUser', $user->id) }}">Block</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
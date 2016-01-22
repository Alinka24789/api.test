@extends('app')

@section('content')
        <div class="container-fluid">
	<div class="row col-sm-offset-4 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item"> User: {{ $user->name }}</li>
                        <li class="list-group-item"> E-mail: {{ $user->email }}</li>
                        <li class="list-group-item"> ID: {{ $client->id}}</li>
                        <li class="list-group-item"> Secret: {{ $client->secret }}</li>
                    </ul>
                    <form method="post" action="/oauth/access_token">
                        {{ csrf_field() }}
                        <input type="hidden" name="username" value="{{$user->email}}">
                        <label>Enter password:</label>
                        <input type="password" name="password" value="">
                        <input type="hidden" name="grant_type" value="password">
                        <input type="hidden" name="client_id" value="{{$client->id}}">
                        <input type="hidden" name="client_secret" value="{{$client->secret}}">

                        <button type="submit" name="approve" value="1">Get access token</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
@endsection

@extends('layouts.app')

@section('title')
{{--Admin Panel--}}
Analytics
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-muted">
            <a class="btn btn-default" href="{{ url('/admins/show') }}">Back To Users</a>
            <div class="row"></div><br />
            <div class="panel panel-default">
                {{--<div class="panel-heading translate">Admin Panel</div>--}}
                <div class="panel-heading translate">User Details</div>
              
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-offset-1">
                      <h4>User {{ $user->name . ' ' .  $user->email}}</h4>
                      {{--<h1>Accounts: {{ $user->name }}</h1>--}}
                      <h2>Accounts</h2>
                      <br />
                    </div>
                    <div class="col-sm-offset-2">
                      <div class="row h4">
                        <div class="col-sm-1">id</div>
                        <div class="col-sm-3">nickname</div>
                        <div class="col-sm-1">max</div>
                        <div class="col-sm-1">used</div>
                      </div>
                      <br />
                      @foreach($accounts as $a)
                      <div class="row">
                        <div class="col-sm-1">{{ $a->id }}</div>
                        <div class="col-sm-3">{{ $a->nickname }}</div>
                        <div class="col-sm-1">{{ $a->max }}</div>
                        <div class="col-sm-1">{{ $a->snippets()->count() }}</div>
                        <div class="col-sm-4">
                          <a class="btn btn-info disabled" href="{{ url('/admins/users/' . $a->id) }}">
                            users ({{$a->invites()->count()}})
                          </a>
                          &nbsp;
                          <a class="btn btn-info disabled" href="{{ url('/admins/hints/' . $a->id) }}">
                            hints ({{$a->snippets()->count()}})
                          </a>
                        </div>
                      </div>
                      <br />
                      @endforeach
                    </div>
                    
                    <div class="col-sm-offset-1">
                      {{--<h1>Invitations: {{ $user->name }}</h1>--}}
                      <h2>Invitations</h2>
                      <br />
                    </div>
                    <div class="col-sm-offset-2">
                      <div class="row h4">
                        <div class="col-sm-1">id</div>
                        <div class="col-sm-4">email</div>
                        <div class="col-sm-2">account</div>
                        <div class="col-sm-2">status</div>
                        <div class="col-sm-1">role</div>
                      </div>
                      <br />
                      @foreach($invites as $i)
                      <div class="row">
                        <div class="col-sm-1">{{ $i->id }}</div>
                        <div class="col-sm-4">{{ $i->email }}</div>
                        <div class="col-sm-2">{{ $i->owner }}</div>
                        <div class="col-sm-2">{{ $i->status }}</div>
                        <div class="col-sm-1">{{ $i->role }}</div>
                      </div>
                      <br />
                      @endforeach
                  </div>
                    
                  <div class="col-sm-offset-1">
                      {{--<h1>Log: {{ $user->name }}</h1>--}}
                      <h2>Log</h2>
                      <br />
                      <a class="btn btn-default disabled col-sm-offset-1">Show</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

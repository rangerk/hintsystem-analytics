@extends('layouts.app')

@section('title')
{{--Admin Panel--}}
Analytics
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-muted">
            <a href="{{url('/admins/options')}}" class="btn btn-default">
              <i class="fa fa-gear text-muted"></i>
              &nbsp;
              Options
            </a>
            &nbsp;
            <a href="{{url('/admins/test')}}" class="btn btn-default">
              <i class="fa fa-image text-muted"></i>
              &nbsp;
              Test
            </a>
            <div class="row"></div>
            <br />
            <div class="panel panel-default">
                {{--<div class="panel-heading translate">Admin Panel</div>--}}
                <div class="panel-heading translate">Users List</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-offset-1">
                      <h1>Users</h1>
                      <br />
                    </div>
                    <div class="col-sm-offset-2">
                      <div class="row h4">
                        <div class="col-sm-1">Id</div>
                        {{--<div class="col-sm-4">Email</div>--}}
                        <div class="col-sm-4">User</div>
                        <div class="col-sm-1">Max</div>
                       {{-- <div class="col-sm-1">Plan</div> --}}
                        <div class="col-sm-2">Log in</div>
                      </div>
                      <br />
                      @foreach($users as $u)
                      <div class="row">
                        <div class="col-sm-1">{{ $u->id }}</div>
                        {{--<div class="col-sm-4">{{ $u->email }}</div>--}}
                        {{--<div class="col-sm-4">{{ $u->name.': '.$u->email }}</div>--}}
                        <div class="col-sm-4">{{ $u->name }}</div>
                        <div class="col-sm-1">{{ $u->max }}</div>
                       {{-- <div class="col-sm-1">free</div> --}}
                        <div class="col-sm-2">{{ $u->updated_at }}</div>
                        <div class="col-sm-2">
                          <a class="btn btn-info" href="{{ url('/admins/accounts/' . $u->id) }}">
                            details ({{ $u->accounts()->count() }})
                          </a>
                        </div>
                      </div>
                      <br />
                      {{--
                      <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                          <input class="form-control" placeholder="Enter email content"/>
                        </div>
                        <div class="col-sm-1">
                          <a class="btn btn-default disabled" href="#">Send E-mail</a>
                        </div>
                      </div>
                      <br />
                      --}}
                      @endforeach
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

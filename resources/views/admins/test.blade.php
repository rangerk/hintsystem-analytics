@extends('layouts.app')

@section('title')
Test
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{url('/admins/show')}}" class="btn btn-default">
              <i class="text-muted"></i>
              Back To Users
            </a>
            <div class="row"></div>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Test</div>
                <div class="panel-body">
                  <div class="test"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

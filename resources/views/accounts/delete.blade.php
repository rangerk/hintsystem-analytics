@extends('layouts.app')

@section('content')
<div class="container">
  
          <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                {{--<div class="panel-heading translate">Delete User</div>--}}
                <div class="panel-heading translate">Settings</div>
                <div class="panel-body">
    
  <div class="col-sm-12">
    {{--<div class="alert alert-warning">
      <span class="translate">Delete User</span> ?
    </div>--}}
      <form action="{{ url('/user/' . Auth::user()->id) }}" class="form-vertical" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        {{--
          <button type="submit" class="btn btn-warning translate">Delete User</button>
        --}}
          <div class="delete" style="display: inline-block">{{ Auth::user()->id }}</div>
          {{--<a href="{{ url('/') }}" class="btn btn-default translate">Don't delete</a>--}}
          <a href="{{ url('/') }}" class="btn btn-default translate">On</a>
      </form>
  </div>
          </div>
      </div>
  </div>
</div>


@endsection
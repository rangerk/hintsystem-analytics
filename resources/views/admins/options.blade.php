@extends('layouts.app')

@section('title')
{{--Admin Panel--}}
Analytics
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-muted">
            <a href="{{url('/admins/show')}}" class="btn btn-default">
              <i class="text-muted"></i>
              Back To Users
            </a>
            <div class="row"></div>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading translate">Admin Panel</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-offset-1">
                      <h1>Options</h1>
                      <br />
                    </div>
                    <div class="col-sm-offset-2 col-sm-6">
                      <form action="{{ url('/admins/options/save') }}">
                        <div class="row">
                        <h4>Dragdrop URL</h4>
                        <input class="form-control" name="dragdrop" value="{{ $urls->dragdrop }}" />
                        <div class="row"></div>
                        <br />
                        <h4>HS URL</h4>
                        <input class="form-control" name="hs" value="{{ $urls->hs }}" />
                        <div class="row"></div>
                        <br />
                        <h4>API URL</h4>
                        <input class="form-control" name="api" value="{{ $urls->api }}" />
                        <div class="row"></div>
                        <br />
                        <h4>Log URL</h4>
                        <input class="form-control" name="log" value="{{ $urls->log }}" />
                        <div class="row"></div>
                        <br />
                        <button class="btn btn-success" type="submit">
                          <i class="fa fa-save"></i>
                          &nbsp;
                          Save
                        </button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <br />
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

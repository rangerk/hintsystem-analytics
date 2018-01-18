@extends('layouts.app')

@section('title')
Hint System Account Settings
@endsection

@section('content')
<div class="container">
  
          <div class="col-md-10 col-md-offset-1">

            <a href="/" class="btn btn-default translate">Back to Hints</a>
            <div class="row"></div> <br />
            
            <div class="panel panel-default">
                <div class="panel-heading translate">Account settings</div>

                <div class="panel-body">
                   

    
  <div class="col-sm-12">
  
  @if (session('message'))
      <div class="alert alert-warning">
        {{ session('message') }}
    </div>
  @endif
    
  
  <a data-toggle="collapse" href="#basic">> Basic Settings</a>
  <div id="basic" class="collapse in">
    
      hello
    
    </div>
  
    
  <div class="row text-muted">
    > <span class="translate">Import/Export</span>
  </div>
    
  <br />
  <div class="row">
    {{--<form action="{{ url('/account/import') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="f" id="f" class="form-control" /><br />
        <button type="submit" class="label label-default">Import hints</button>
        <a href="{{ url('/account/export') }}" class="label label-default" target="_blank">Export hints</a>
    </form>--}}
    <form id="import-form" action="{{ url('/account/import') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
      
        {{--
        <input type="file" name="f" id="f" style="display: none" onChange="document.getElementById('import-form').submit()" />
        <button type="button" onClick="document.getElementById('f').click()" class="btn btn-default">Import hints</button>
        --}}
      
        <div class="col-sm-12">
          <div class="import" id="f" style="display: inline-block">Import hints</div>
          <a href="{{ url('/account/export') }}" class="btn btn-default translate" target="_blank">Export hints</a>
        </div>
      
    </form>
  </div>
  
  <br />
  <form action="/account/save" class="form-vertical" >
    
  <div class="row text-muted" data-toggle="collapse" data-target=".columns.collapse">
    > <span class="translate">Visible Hint Columns</span>
  </div>
  <br />
  <div class="columns collapse in"
       onMouseDown=" $('.disabled').removeClass('disabled'); "
       >{{ Auth::user()->columns }}</div>
  <br />
    
    <div class="row text-muted">> <span class="translate">User management</span></div>
    
  <br />
  <div class="row text-muted translate">Enter the Domains where these hints are allowed (one per line)</div>
  <br />
  <div class="row">
    <textarea 
              onKeyDown=" $('.disabled').removeClass('disabled'); "
              name="domains" class="form-control" rows="7">{{ Auth::user()->domains }}</textarea>
  </div>
    
  <br />
    
  <div class="row">
    <div class="col-sm-2 text-muted translate">Test Mode</div>
    <div class="on-off col-sm-10"
         onMouseDown=" $('.disabled').removeClass('disabled'); "
         ><input type="hidden" name="test" value="{{Auth::user()->test}}" /></div>
  </div>
  <br />
    
  <div class="row">
    <div class="col-sm-3 text-muted translate">Default Icons</div>
    <div class="col-sm-9">
      {{--
      <a class="btn btn-default">Icon 1</a>
      <a class="btn btn-default">Icon 2</a>
      <a class="btn btn-default">Icon 3</a>
      --}}
      <div class="icons" data-icons="{{ Auth::user()->icons }}">Icons...</div>
    </div>
  </div>
  <br />
    
  <div class="row">
    <div class="col-sm-3 text-muted translate">Translate</div>
    <div class="col-sm-9">
      <div class="dropdown">
        <button class="btn btn-info dropdown-toggle" 
                data-toggle="dropdown"
                type="button"
                >{{ Auth::user()->translate }} <span class="caret"></span></button>
        <ul class="dropdown-menu"
            onMouseDown=" $('.disabled').removeClass('disabled'); "
            >
          <li><a href="{{ url('/translate/select/en') }}">En</a></li>
          <li><a href="{{ url('/translate/select/test') }}">Test</a></li>
        </ul>
      </div>

    </div>
  </div>
  <br />
  
  <div class="row">
    <div class="col-sm-2 text-muted translate">Voting</div>
    <div class="on-off col-sm-10"
         onMouseDown=" $('.disabled').removeClass('disabled'); "
         ><input type="hidden" name="voting" value="{{Auth::user()->voting}}" /></div>
  </div>
  <br />
    
    {{--
  <button class="btn btn-success col-sm-offset-9"><i class="fa fa-save"></i> Save</button>
  --}}
  <div class="submit col-sm-offset-9" style="display: inline-block">Submit...</div>
  <a href="{{ url('/') }}" class="btn btn-default translate">Cancel</a>
    
    
    </form> 
</div>
       
       </div>
       </div>
       </div>
       </div>
{{--
<script type="text/babel" src="{{ url('/components/import.js') }}"></script>
<script type="text/babel" src="{{ url('/components/onoff.js') }}"></script>
--}}
@endsection
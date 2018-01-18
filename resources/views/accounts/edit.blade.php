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
  
  <form action="/account/save" class="form-vertical" >
  
  <a class="row" data-toggle="collapse" href="#basic">> Basic Settings</a>
  <div id="basic" class="collapse in col-sm-offset-1">
    
  <div class="row">
    <div class="col-sm-3 text-muted translate">Nickname</div>
    <div class="col-sm-5">
      <input class="form-control" 
             onKeyDown=" $('.disabled').removeClass('disabled'); "
             value="{{ $account->nickname }}" name="nickname" />
    </div>
  </div>
  <br />
    
  <div class="row">
    <div class="col-sm-3 text-muted translate">Translate</div>
    <div class="col-sm-9">
      <div class="dropdown">
        <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" type="button">
          {{ $account->translate }} <span class="caret"></span>
        </button>
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
    <div class="col-sm-3 text-muted translate">Default Icons</div>
    <div class="col-sm-9">
      <div class="icons" data-icons="{{ $account->icons }}">Icons...</div>
    </div>
  </div>
  <br />
    
  <div class="row">
    <div class="col-sm-2 text-muted translate">Voting</div>
    <div class="on-off col-sm-10"
         onMouseDown=" $('.disabled').removeClass('disabled'); "
         ><input type="hidden" name="voting" value="{{$account->voting}}" /></div>
  </div>
    
  <br />
    
  <div class="row text-muted">
    <div class="col-sm-3">
      Max hints #
    </div>
    <div class="col-sm-5">
      {{--
      <input type="text" class="form-control" name="max" 
             value="{{$account->max}}"
             disabled="true"
             /> --}}
      <span class="text-muted">{{$account->max}}</span>
      {{--
      <input type="text" class="form-control" name="max" 
             onKeyDown=" $('.disabled').removeClass('disabled'); "
             value="{{$account->max}}"
             disabled={true}
             /> --}}
    </div>
  </div>
    
  <br />
    
    
    </div>

  {{--<div class="row text-muted" data-toggle="collapse" data-target=".columns.collapse">
    > <span class="translate">Visible Hint Columns</span>
  </div>--}}
  <a class="row" data-toggle="collapse" href=".columns">
    > <span class="translate">Visible Hint Columns</span>
  </a>
  <br />
  
  <div class="columns collapse in col-sm-offset-1" onMouseDown=" $('.disabled').removeClass('disabled'); "
       >{{ $account->columns }}</div>
    
  <br />
    
  <a class="row" data-toggle="collapse" href="#tools">> Tools</a>
  <div id="tools" class="collapse col-sm-offset-1">
    
  <div class="row text-muted">
    {{-- > --}} <span class="translate">Import/Export</span>
  </div>
    
  <br />
    
  <div class="row">
    {{--
    <form id="import-form" action="{{ url('/account/import') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
    --}}
        <div class="col-sm-12">
          <div class="import" id="f" style="display: inline-block">Import hints</div>
          <a href="{{ url('/account/export') }}" class="btn btn-default translate" target="_blank">Export hints</a>
        </div>
  {{--  </form> --}}
  </div>
  
  <br />
    
  {{--
  <form action="/account/save" class="form-vertical" >
  --}}
    
  <div class="row text-muted">{{-- > --}}<span class="translate">User management</span></div>
  <br />
  <div class="row text-muted translate">Enter the Domains where these hints are allowed (one per line)</div>
  <br />
  <div class="row">
    <textarea onKeyDown=" $('.disabled').removeClass('disabled'); "
              name="domains" class="form-control" rows="7"
              placeholder="Enter domains where your hints will appear. If blank, they'll be allowed anywhere."
              >{{ $account->domains }}</textarea>
  </div>
  <br />
    
  <div class="row">
    {{--<div class="col-sm-2 text-muted translate">Test Mode</div>--}}
    <div class="col-sm-2 text-muted translate">On-click hints default to open</div>
    <div class="on-off col-sm-10"
         onMouseDown=" $('.disabled').removeClass('disabled'); "
         ><input type="hidden" name="test" value="{{$account->test}}" /></div>
  </div>
  <br />
  
  <div class="row">
    <div class="col-sm-2 text-muted translate">On/Off</div>
    <div class="on-off col-sm-10"
         onMouseDown=" $('.disabled').removeClass('disabled'); "
         ><input type="hidden" name="onoff" value="{{$account->onoff}}" /></div>
  </div>
  <br />
    
  </div>
  
  <div class="submit col-sm-offset-9" style="display: inline-block">Submit...</div>
  <a href="{{ url('/') }}" class="btn btn-default translate">Cancel</a>
    
    
    </form> 
    
    <a class="row" data-toggle="collapse" href="#users">> Users</a>
    <div id="users" class="collapse col-sm-offset-1">
      {{--
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3">User</div>
        <div class="col-sm-3">Nickname</div>
        <div class="col-sm-2"></div>
      </div>
      
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3">User</div>
        <div class="col-sm-3">Roman</div>
        <div class="col-sm-2">owner</div>
      </div>
    
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-1"><span class="label label-info">x</span></div>
        <div class="col-sm-3">User</div>
        <div class="col-sm-3">Nickname</div>
        <div class="col-sm-2"></div>
      </div>
      <br /><br />
      --}}
      {{--
      <div class="row">
        <div class="col-sm-3"><a href="#" class="btn btn-default">Re-send invitation</a></div>
        <div class="col-sm-1"><span class="label label-info">x</span></div>
        <div class="col-sm-3">User</div>
        <div class="col-sm-3">Nickname</div>
        <div class="col-sm-2">pending</div>
      </div>
      <br /><br />
      
      <div class="row">
        <div class="col-sm-3 text-muted">Invite new user:</div>
        <div class="col-sm-6"><input class="form-control" placeholder="Enter email of new user" /></div>
        <div class="col-sm-3"><a href="#" class="btn btn-default">Send</a></div>
      </div>
      <br />
      --}}
      
      <div class="invite"></div>
      
    </div>
    
    <a class="row" data-toggle="collapse" href="#danger">> Danger Area</a>
    <div id="danger" class="collapse col-sm-offset-1">
      
      <div class="row">
        @if($role == 'owner')
          {{--<a href="#" class="btn btn-default col-sm-3 col-sm-offset-2">Delete Account</a>--}}
        
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle col-sm-3 col-sm-offset-2" 
                    data-toggle="dropdown" type="button">Delete Account</button>
            <ul class="dropdown-menu">
              <li class="dropdown-header">
                Are you sure you want to remove account {{ $account->nickname }} ?
                <br /><br />
                <a href="{{ url('/account/delete/' . $account->id) }}" class="btn btn-default">Yes</a>
                &nbsp;
                <a class="btn btn-default">No</a>
              </li>
            </ul>
          </div>
        @endif
        @if($role != 'owner')
          {{--<a href="#" class="btn btn-default col-sm-3 col-sm-offset-1">Quit Account</a>--}}
        
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" 
                    data-toggle="dropdown" type="button">Quit Account</button>
            <ul class="dropdown-menu">
              <li class="dropdown-header">
                Quit account {{ $account->nickname }} ?
                <br /><br />
                <form action="{{ url('/account/quit') }}">
                  <button type="submit" class="btn btn-info col-sm-4">Yes</button>
                </form>
                &nbsp;
                <button type="button" class="btn btn-default col-sm-4 col-sm-offset-1">No</button>
              </li>
            </ul>
          </div>
        @endif
      </div>
      <br />
      
      @if($role == 'owner')
        <div class="transfer"></div>
        {{--<div class="row">
          <form action="{{ url('/account/transfer/' . $account->id) }}">
          <div class="col-sm-3 text-muted">Transfer Ownership:</div>
          <div class="col-sm-6"><input id="email" class="form-control" placeholder="Enter email of new owner" name="email" /></div>
          <div class="col-sm-3">--}}
            {{--<a href="#" class="btn btn-default">Transfer</a>--}}
            {{--
            <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" 
                    data-toggle="dropdown" type="button">Transfer</button>
            <ul class="dropdown-menu">
              <li class="dropdown-header">
                Transfer Ownership ?
                <br />
                Recipient must be user of this account before you can transfer to them.
                <br />
                Warning: do you want to transfer account {{ $account->nickname }} to {{ 'email' }} ?
                <br /><br />--}}
                {{--<a href="{{ url('/account/transfer/' . $account->id) }}" class="btn btn-default">Yes</a>--}}
                {{--<button type="submit" class="btn btn-info">Yes</button>
                &nbsp;
                <button type="button" class="btn btn-default">No</button>
              </li>
            </ul>
          </div>
            
          </div>
          </form>
        </div>--}}
      
      @endif
      <br />
      
    </div>
    
    
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
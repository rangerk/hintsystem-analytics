@extends('layouts.app')

@section('content')
<div class="container">
  
          <div class="col-md-10 col-md-offset-1">
            
            <a href="{{ url('/') }}" class="btn btn-default translate">Back to Hints</a>
            <div class="row"></div>
            <br />
            
            <div class="panel panel-default">
                
                {{--<div class="panel-heading translate">User Settings</div>--}}
                <div class="panel-heading translate">Settings</div>
              
                <div class="panel-body">
    
                {{--<h1 class="text-muted">User Settings for {{ Auth::user()->name }}</h1>--}}
                <h1 class="text-muted">Settings for {{ Auth::user()->name }}</h1>
                
                <div class="row"></div>
                <br />
                
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#settings" data-toggle="tab" onclick="">Settings</a></li>
                  <li><a href="#accounts" data-toggle="tab">Accounts</a></li>
                  <li><a href="#billing" data-toggle="tab">Billing (for owner)</a></li>
                </ul>
                  
                <div class="tab-content col-sm-offset-1"><br />
                  
                <div class="tab-pane fade in active" id="settings">
                  
                <form action="{{ url('/user') }}" method="POST">

                <div class="row">
                  <div class="col-sm-12 text-muted translate">Basics</div>
                </div>
                <br />
                  
                <div class="row">
                  <div class="col-sm-offset-1 col-sm-2 text-muted translate">Name</div>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" 
                           value="{{ Auth::user()->name }}"
                           onKeyDown=" $('.disabled').removeClass('disabled'); "
                           />
                  </div>
                </div>
                <br />
                
                <div class="row">
                  <div class="col-sm-offset-1 col-sm-2 text-muted translate">Nickname</div>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" name="nickname"
                           value="{{ Auth::user()->nickname }}"
                           onKeyDown=" $('.disabled').removeClass('disabled'); "
                           />
                  </div>
                </div>
                <br />
                
                <div class="row">
                  <div class="col-sm-offset-1 col-sm-2 text-muted translate">E-Mail Address</div>
                  <div class="col-sm-7">
                    <input type="email" class="form-control" name="email" 
                           value="{{ Auth::user()->email }}"
                           onKeyDown=" $('.disabled').removeClass('disabled'); "
                           />
                  </div>
                </div>
                <br />
                
                <div class="row">
                  <div class="col-sm-12 text-muted translate">Password</div>
                </div>
                <br />
                  
      <div class="row">
        <div class="col-sm-offset-1 col-sm-2 text-muted translate">New Password</div>
        <div class="col-sm-7">
          
          <div class="password"
               onKeyDown=" $('.disabled').removeClass('disabled'); "
               ></div>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-sm-offset-1 col-sm-2 text-muted translate">Retype Password</div>
        <div class="col-sm-7">
          
          <div class="confirm"
               onKeyDown=" $('.disabled').removeClass('disabled'); "
               ></div>
        </div>
      </div>
      <br />
      
      <div class="row">
        <div class="col-sm-offset-1 col-sm-2 text-muted translate">Current Password</div>
        <div class="col-sm-7">
          <input type="password" class="form-control"
                 name="current"
                 onKeyDown=" $('.disabled').removeClass('disabled'); "
                 />
        </div>
      </div>
      <br />
                  
      <div class="settings"></div>
                  
      </form>
      </div>
                  
      <div class="tab-pane fade in" id="accounts">

        <div class="col-sm-offset-1 text-muted">
          <div class="accounts"></div>
        </div>
      </div>
                  
      <div class="tab-pane fade in" id="billing">
        {{--<h2>
          Billing
        </h2>--}}
        <span class="text-muted">No billing for now. Yay!</span>
      </div>
      </div>
      <br />
                  
      {{--
      <div class="row">
        <div class="col-sm-12 text-muted translate col-sm-offset-1">My Accounts</div>
      </div>
      <br />

      <div class="col-sm-offset-2 text-muted">
      
      <div class="row text-muted">
        <div class="accounts col-sm-6"></div>
      </div>
      <br />
        --}}
      {{--
      <div class="row text-muted">
        <div class="col-sm-2">Account</div>
        <div class="col-sm-2">Role</div>
      </div>
                  
      <div class="row">
        <div class="col-sm-2">Account 1</div>
        <div class="col-sm-2">owner</div>
        <div class="col-sm-2"><i class="fa fa-circle"></i></div>
      </div>
        
      <div class="row">
        <div class="col-sm-2">Account 2</div>
        <div class="col-sm-2">owner</div>
        <div class="col-sm-2"><i class="fa fa-circle"></i></div>
      </div>
        
      <div class="row">
        <div class="col-sm-2">Account 3</div>
        <div class="col-sm-2">regular user</div>
        <div class="col-sm-2"><i class="fa fa-circle"></i></div>
      </div>
        
      <div class="row">
        <div class="col-sm-2"><a href="#" class="btn btn-default">+</a></div>
      </div>
      <br />
      --}}
        {{--
      <div class="row">
        <div class="col-sm-2">Account 4</div>
        <div class="col-sm-2">pending</div>
        <div class="col-sm-4">
          <a href="#" class="btn btn-info">Join</a>
          &nbsp;
          <a href="#" class="btn btn-default">Decline</a>
        </div>
      </div>
      <br />
        
      <div class="row">
        <div class="col-sm-2">Account 5</div>
        <div class="col-sm-2">pending</div>
        <div class="col-sm-4">
          <a href="#" class="btn btn-info">Join</a>
          &nbsp;
          <a href="#" class="btn btn-default">Decline</a>
        </div>
      </div>
      
      </div> --}}
      <br />
      <br />
                 
                  
      <div class="row">
        {{--<div class="col-sm-12 text-muted translate col-sm-offset-1">Danger Area</div>--}}
      </div>
      <br />
                  
      <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
          <div class="delete" 
               style="display: inline-block" 
               data-value="{{ Auth::user()->id }}">
          </div>
        </div>
      </div>

      {{--
      <div class="row">
      <div class="col-sm-10 col-sm-offset-2">
        <form action="{{ url('/user/' . Auth::user()->id) }}" class="form-vertical" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <div class="delete" style="display: inline-block">{{ Auth::user()->id }}</div>


            <a href="{{ url('/') }}" class="btn btn-default translate">Cancel</a>
        </form>
      </div>
      </div>
      --}}
          </div>
      </div>
  </div>
</div>


@endsection
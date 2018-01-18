@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading translate">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label translate">E-Mail Address</label>

                            <div class="col-md-6">
                              {{--
                                <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                              --}}
                              {{--
           <input readonly="true" type="email" class="form-control" 
                  name="email" value="{{ $email or old('email') }}">
                              --}}
                               <input type="hidden" class="form-control" 
                                      name="email" value="{{ $email or old('email') }}">
                               <h4>
                                 {{ $email or old('email') }}
                              </h4>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label translate">Password</label>

                            <div class="col-md-6">
                              
                                {{-- <input type="password" class="form-control" name="password">--}}
                                <div class="password">Password...</div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
         
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label translate">Confirm Password</label>
                            <div class="col-md-6">
                                {{--<input type="password" class="form-control" name="password_confirmation">--}}
                                <div class="confirm">Confirm...</div>
                              {{--  <input id="match" type="password" class="form-control" name="password_confirmation">--}}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{--<button type="submit" class="btn btn-primary">
                                  <i class="fa fa-btn fa-refresh"></i><span class="translate">Reset Password</span>
                                </button>--}}
                                <div class="email"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

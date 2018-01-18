@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading translate">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                      
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label translate">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                {{--@if ($errors->has('email'))--}}
                                    <span class="help-block">
                                        <strong id="email-help" class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                {{--@endif--}}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label translate">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                {{--@if ($errors->has('password'))--}}
                                    <span class="help-block">
                                        <strong id="password-help">{{ $errors->first('password') }}</strong>
                                    </span>
                                {{--@endif--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="remember"> <span class="translate">Remember Me</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              {{--
                                <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-btn fa-sign-in"></i><span class="translate">Login</span>
                                </button>
                              --}}
                              <div class="login" style="display: inline-block"></div>

                                <a class="btn btn-link translate" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                        
                    </form>
                  {{--
                      <div>
                          <a class="btn btn-success" href="{{ url('/auth/google') }}">Google</a>
                          <a class="btn btn-success" href=" {{ url('/auth/twitter') }}">Twitter</a>
                          <a class="btn btn-success" href="{{ url('/auth/facebook') }}">Facebook</a>
                          <a class="btn btn-success" href="{{ url('/auth/linkedin') }}">LinkedIn</a>
                      </div>
                  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

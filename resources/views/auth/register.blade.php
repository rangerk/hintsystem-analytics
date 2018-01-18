@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading translate">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label translate">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label translate">E-Mail Address</label>

                            <div class="col-md-6">
                                @if (session('email'))
                                    <input type="email" class="form-control" name="email" value="{{ session('email') }}">
                                @else
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @endif

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
                                {{--<input type="password" class="form-control" name="password">--}}

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
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              {{--
                                <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-btn fa-user"></i><span class="translate">Register</span>
                                </button>
                              --}}
                              <div class="create"></div>
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

    {{--<script>window.token = '{{csrf_token()}}'</script>--}}
{{--
    <script type="text/babel" src="{{ url('/components/password.js') }}"></script>
--}}
@endsection

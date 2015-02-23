@extends('panelViews::master')
@section('bodyClass')
login
@stop
@section('body')
    <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="mes-box">
                       @if(Session::get('mesType')=='error') <div class="error-box animated fadeInDown"><span class="ic-caution"></span>  {{Session::get('message')}}  </div>@endif
                       @if(Session::get('mesType')=='info') <div class="info-box animated fadeInDown"><span class="ic-info"></span> {{Session::get('message')}}</div>@endif
                    </div>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Enter New Password</h3>
                        </div>
                        <div class="panel-body">
                            <div class="logo-holder">
                                <img src="{{asset("packages/serverfireteam/panel/img/logo.png")}}" />
                            </div>
                            <form action="{!! url('panel/reset') !!}" method="POST">
                                <fieldset>
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                        <input type="hidden" name="token" value="{{ $token }}" />
					<div class="form-group">
	                                        <input class="form-control" placeholder="email" name="email" type="text" autofocus />
 	                                </div>
	                                <div class="form-group">
		                                <input class="form-control" placeholder="New Password" name="password" type="password" value="" />
	                                </div>
	                                <div class="form-group">
        	                                <input class="form-control" placeholder="Retype Password" name="password_confirmation" type="password" value="" />
                                        </div>
	                                <input type="submit"  class="btn btn-lg btn-success btn-block" value="Reset Password" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop

@extends('panelViews::mainTemplate')
@section('page-wrapper')

@if(Session::has('message'))
    <div class="alert-box success">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif

@if ($demo_status == true)
	<h4>You are not allowed to change the password in demo version of panel.</h4>
@else

	<div class="row">
		<div class="col-xs-4">
      <div class="well well-lg">
        <form action="{{ action('\Serverfireteam\Panel\RemindersController@postChangePassword') }}" method="POST">
          <label>{{ \Lang::get('panel::fields.emailAddress') }}</label> <input class="form-control" type="email" name="email"><br />
          <label>{{ \Lang::get('panel::fields.currentPassword') }}</label>
          <input class="form-control" type="password" name="current_password"><br />
          <label>{{ \Lang::get('panel::fields.password') }}</label> <input  class="form-control" type="password" name="password"><br />
          <label>{{ \Lang::get('panel::fields.rePassword') }}</label>
          <input class="form-control" type="password" name="password_confirmation"><br />
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <input class="btn btn-default" type="submit" value="{{ \Lang::get('panel::fields.ChangePassword') }}">
        </form>
      </div>
		</div>
	</div>

@endif
@stop

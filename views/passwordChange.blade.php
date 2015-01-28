@extends('panelViews::mainTemplate')
@section('page-wrapper')

@if(Session::has('message'))
    <div class="alert-box success">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif

<div class="row">
    <div class="col-xs-4" >
<form action="{{ action('Serverfireteam\Panel\RemindersController@postChangePassword') }}" method="POST">    
    <label>Email Address:</label> <input class="form-control" type="email" name="email"><br />
    <label>Current Password:</label> <input class="form-control" type="password" name="current_password"><br />
    <label>Password:</label> <input  class="form-control" type="password" name="password"><br />
    <label>Re-Type PAssword:</label> <input class="form-control" type="password" name="password_confirmation"><br />
    <input class="btn btn-default" type="submit" value="Reset Password">
</form>
        </div>    
</div>
    
@stop   


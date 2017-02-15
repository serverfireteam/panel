@extends('panelViews::mainTemplate')
@section('page-wrapper')

@if(Session::has('message'))
    <div class="alert-box success">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif

<div class="row">
    <div class="col-xs-4" >
<form action="{{ action('Serverfireteam\Panel\UsersController@postCreateUser') }}" method="POST">    
    <label>Email Address:</label> <input class="form-control" type="email" name="email"><br />
    <label>Password:</label> <input  class="form-control" type="password" name="password"><br />
    <label>Re-Type PAssword:</label> <input class="form-control" type="password" name="re_password"><br />
    <label>Name:</label> <input class="form-control" type="text" name="first_name"><br />
    <label>Family:</label> <input class="form-control" type="text" name="last_name"><br />
    <input class="btn btn-default" type="submit" value="Create User">
</form>
        </div>    
</div>
    
@stop   


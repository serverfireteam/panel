
@extends('panelViews::mainTemplate')
@section('page-wrapper')

@if(Session::has('message'))
    <div class="alert-box success">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif

<div class="row">
    <div class="col-xs-4" >


{{
 Form::model($admin, array( $admin->id))
}}

{{ Form::label('first_name', 'First Name') }}
{{ Form::text('first_name', $admin->first_name, array('class' => 'form-control')) }}
<br />
{{ Form::label('last_name', 'Last Name') }}
{{ Form::text('last_name', $admin->last_name, array('class' => 'form-control')) }}
<br />
<!-- email -->
{{ Form::label('email', 'Email') }}
{{ Form::email('email', $admin->email, array('class' => 'form-control')) }}		
<br />
{{ Form::submit('Update Profile', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

  </div>    
</div>
    
@stop   

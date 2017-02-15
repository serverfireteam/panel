
@extends('panelViews::mainTemplate')
@section('page-wrapper')

@if (!empty($message))
    <div class="alert-box success">
        <h2>{{ $message }}</h2>
    </div>
@endif

@if ($demo_status == true)
	<h4>You are not allowed to edit the profile in demo version of panel.</h4>
@else

<div class="row">
    <div class="col-xs-4" >
      <div class="well well-lg">
        {!!
         Form::model($admin, array( $admin->id))
        !!}

        {!! Form::label('first_name', \Lang::get('panel::fields.FirstName')) !!}
        {!! Form::text('first_name', $admin->first_name, array('class' => 'form-control')) !!}
        <br />
        {!! Form::label('last_name', \Lang::get('panel::fields.LastName')) !!}
        {!! Form::text('last_name', $admin->last_name, array('class' => 'form-control')) !!}
        <br />
        <!-- email -->
        {!! Form::label('email', \Lang::get('panel::fields.email')) !!}
        {!! Form::email('email', $admin->email, array('class' => 'form-control')) !!}
        <br />
        {!! Form::submit(\Lang::get('panel::fields.updateProfile'), array('class' => 'btn btn-primary')) !!}

        {!! Form::close() !!}
      </div>
@endif

  </div>
</div>

@stop

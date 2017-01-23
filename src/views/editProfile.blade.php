
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

        {!! Form::label('forename', \Lang::get('panel::fields.FirstName')) !!}
        {!! Form::text('forename', $admin->forename, array('class' => 'form-control')) !!}
        <br />
        {!! Form::label('surname', \Lang::get('panel::fields.LastName')) !!}
        {!! Form::text('surname', $admin->surname, array('class' => 'form-control')) !!}
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

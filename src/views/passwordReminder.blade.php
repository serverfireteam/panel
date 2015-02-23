
@extends('panelViews::master')
@section('bodyClass')
login
@stop
@section('body')



    <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    
                    <div class="mes-box">
                         @if($mesType=='error')<div class="error-box animated fadeInDown"><span class="ic-caution"></span> {{$message}}</div>@endif  
                         @if($mesType=='info') <div class="info-box animated fadeInDown"><span class="ic-info"></span> {{$message}}</div>@endif
                    </div>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            {{ ($mesType=='message')?'<h3 class="panel-title">'.$message.'</h3>':'' }} 
                        </div>
                        <div class="panel-body">
                            <div class="logo-holder">
                                <img src="{{asset("packages/serverfireteam/panel/img/logo.png")}}" />
                            </div>
                            <form action="{!! url('panel/remind') !!}" method="POST">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="email" name="email" type="email" autofocus>
                                    </div>
                                    
                                    <!-- Change this to a button or input when using this as a form -->
                                    <input type="submit"  class="btn btn-lg btn-success btn-block" value="{{ \Lang::get('panel::fields.sendReminder') }}">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop


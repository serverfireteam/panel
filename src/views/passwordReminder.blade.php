
@extends('panelViews::master')
@section('bodyClass')
login
@stop
@section('body')



    <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    
                    <div class="mes-box">
                        {{ ($mesType=='error')?'<div class="error-box"><span class="ic-caution"></span> '.$message.'</div>':'' }}  
                        {{ ($mesType=='info')?'<div class="info-box">'.$message.'</div>':'' }} 
                    </div>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            {{ ($mesType=='message')?'<h3 class="panel-title">'.$message.'</h3>':'' }} 
                        </div>
                        <div class="panel-body">
                            <div class="logo-holder">
                                <img src="{{asset("packages/serverfireteam/panel/img/logo.png")}}" />
                            </div>
                            <form action="{{ action('Serverfireteam\Panel\RemindersController@postRemind') }}" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="email" name="email" type="email" autofocus>
                                    </div>
                                    
                                    <!-- Change this to a button or input when using this as a form -->
                                    <input type="submit"  class="btn btn-lg btn-success btn-block" value="Send Reminder">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop


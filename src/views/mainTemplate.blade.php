@extends('panelViews::master')
@section('bodyClass')
dashboard
@stop
@section('body')



    <div class="loading">
        <div class="rnd-box"><div class="inner-box"></div></div>
        <h1> LOADING </h1>
    </div>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">
            
            <!-- /.navbar-header -->
             <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed btn-resp-sidebar" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                
              </div>

            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar " role="navigation">
                <div class="sidebar-nav navbar-collapse collapse " id="bs-example-navbar-collapse-1">
                      <div class="grav center"><img src="http://www.gravatar.com/avatar/{{ md5( strtolower( trim( Auth::user()->email ) ) )}}?d=mm&s=128" ><a href="https://www.gravatar.com"><span> {{ \Lang::get('panel::fields.change') }}</span></a></div>
                      <div class="user-info">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</div>
                      <a class="visit-site" href="{{$app['url']->to('/')}}">{{ \Lang::get('panel::fields.visiteSite') }}  </a>
                    <ul class="nav" id="side-menu">
                            <li>
                                <a  href="{{ url('panel') }}" class="{{ (Request::url() === url('panel')) ? 'active' : '' }}"><i class="fa fa-dashboard fa-fw"></i> {{ \Lang::get('panel::fields.dashboard') }}</a>
                            </li>
                            
                         @foreach(\Config::get('panel.crudItems') as $key => $value )
                            {!! $model = "\App\\".$value !!}                
                            <li>
                                <a  href="{{ url('panel/'.$value.'/all') }}" class="{{ (Request::segment(2)==$value)?'active':'' }}"><i class="fa fa-edit fa-fw"></i> {{{$key}}} <span class="badge pull-right">{!!$model::all()->count()!!}</span></a>
                            </li>
                         @endforeach
                    </ul>     
                      
                        </li>
                    </ul>
                </div>
               
             
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="powered-by"><a href="https://github.com/serverfireteam/panel">Powered By ServerFire Team</a></div> 
        <div id="page-wrapper">
            

            <!-- Menu Bar -->
            <div class="row">
                <div class="col-xs-12 text-a top-icon-bar">
                    <div class="btn-group" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <a  type="button" class="btn btn-default dropdown-toggle main-link" data-toggle="dropdown" aria-expanded="false">
                                {{ Lang::get('panel::fields.settings') }} 
                                <span class="caret fl-right"></span>
                            </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('panel/edit')}}"><span class="icon  ic-users "></span>{{ Lang::get('panel::fields.ProfileEdit') }}</a></li>
                            <li><a href="{{url('panel/changePassword')}}"><span class="icon ic-cog"></span>{{ Lang::get('panel::fields.ResetPassword') }}</a></li>
                          </ul>
                        </div>
                        <a href="{{url('panel/logout')}}" type="button" class="btn btn-default main-link">{{ Lang::get('panel::fields.logout') }}<span class="icon  ic-switch fl-right"></span></a>
                      </div>
                    
<!--                    <a href="{{url('panel/logout')}}" > logout <span class="icon  ic-cog"></span></a>
                    <a href="#" > settings <span class="icon ic-switch"></span></a>-->
                    
                    
                </div>
            </div>
            
            @yield('page-wrapper')
            
        </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
@stop


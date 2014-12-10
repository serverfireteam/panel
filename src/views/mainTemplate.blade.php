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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <!-- /.navbar-header -->

            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">        
                    <ul class="nav" id="side-menu">
                            <li>
                                {{link_to('panel', 'Dashboard')}}
                            </li>
                            
                         @foreach (  \Config::get('config.crudItems') as $key => $value )                
                            <li>
                                 <a  href="{{ url('panel/'.$value.'/all') }}"><i class="fa fa-dashboard fa-fw"></i> {{{$key}}}</a>
                            </li>
                         @endforeach
                    </ul>     
                      
                        </li>
                    </ul>
                </div>
               
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            

            <!-- Menu Bar -->
            <div class="row">
                <div class="col-xs-12 text-a top-icon-bar">
                    <div class="btn-group" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <a  type="button" class="btn btn-default dropdown-toggle main-link" data-toggle="dropdown" aria-expanded="false">
                                settings 
                                <span class="caret fl-right"></span>
                            </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('panel/edit')}}"><span class="icon  ic-cog "></span> Profile Edit </a></li>
                            <li><a href="{{url('panel/changePassword')}}"><span class="icon ic-cog"></span> Reset Password </a></li>
                          </ul>
                        </div>
                        <a href="{{url('panel/logout')}}" type="button" class="btn btn-default main-link">logout <span class="icon  ic-switch fl-right"></span></a>
                      </div>
                    
<!--                    <a href="{{url('panel/logout')}}" > logout <span class="icon  ic-cog"></span></a>
                    <a href="#" > settings <span class="icon ic-switch"></span></a>-->
                    
                    
                </div>
            </div>
            
            @yield('page-wrapper')
            
        </div>
            <!-- /.row -->
            <div class="row">
                <!-- /.col-lg-8 -->
                
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
@stop


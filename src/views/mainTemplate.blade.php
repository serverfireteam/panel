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
                                {{link_to('panel', 'Dashboard')}}<i class="fa fa-dashboard fa-fw"></i>
                            </li>
                         @foreach (  \Config::get('config.crudItems') as $key => $value )                
                            <li>
                                <a  href="panel/{{{$value}}}/all"><i class="fa fa-dashboard fa-fw"></i> {{{$key}}}</a>
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
                    <a href="#"<span class="icon  ic-cog"></span></a>
                    <span class="icon ic-switch"></span>
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


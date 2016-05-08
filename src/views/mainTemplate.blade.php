@extends('panelViews::master')
@section('bodyClass', 'dashboard')
@section('body')
    <?php
        $urls = \Config::get('panel.panelControllers');
        $linkItems  = \Serverfireteam\Panel\libs\dashboard::getItems();
    ?>

    <div class="loading">
        <h1> LOADING </h1>
        <div class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
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
                      <div class="grav center"><img src="http://www.gravatar.com/avatar/{{ md5( strtolower( trim( Auth::guard('panel')->user()->email ) ) )}}?d=mm&s=128" ><a href="https://www.gravatar.com"><span> {{ \Lang::get('panel::fields.change') }}</span></a></div>
                      <div class="user-info">{{Auth::guard('panel')->user()->first_name.' '.Auth::guard('panel')->user()->last_name}}</div>
                      <a class="visit-site" href="{{$app['url']->to('/')}}">{{ \Lang::get('panel::fields.visiteSite') }}  </a>
                      <ul class="nav" id="side-menu">
                          <li class="{{ (Request::url() === url('panel')) ? 'active' : '' }}">
                              <a  href="{{ url('panel') }}" ><i class="fa fa-dashboard fa-fw"></i> {{ \Lang::get('panel::fields.dashboard') }}</a>
                          </li>

                          @foreach($linkItems as $linkItem)
                              <?php
                                  $isActive = Request::segment(2) == $linkItem['modelName'];
                              ?>
                              <li class="s-link {{ $isActive ? 'active' : '' }}">
                                  <a  href="{{ url($linkItem['showListUrl']) }}" class="{{ $isActive ? 'active' : '' }}">
                                      <i class="fa fa-edit fa-fw"></i>
                                      {{{$linkItem['title']}}}
                                  </a>
                                  <span class="badge {{App::getLocale() == 'fa' ? 'pull-left' : 'pull-right'}}">{!!$linkItem['count']!!}</span>
                                  <div class="items-bar">
                                      <a href="{{ url($linkItem['addUrl']) }}" class="ic-plus" title="Add" ></a>
                                      <a title="List" class="ic-lines" href="{{ url($linkItem['showListUrl']) }}" ></a>
                                  </div>
                              </li>
                          @endforeach
                      </ul>

                        </li>
                    </ul>
                </div>


            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="powered-by"><a href="http://laravelpanel.com">{{ \Lang::get('panel::fields.thankYouNote') }}</a></div>
        <div id="page-wrapper">


            <!-- Menu Bar -->
            <div class="row">
                <div class="col-xs-12 text-a top-icon-bar">
                    <div class="btn-group" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <a  type="button" class="btn btn-default dropdown-toggle main-link" data-toggle="dropdown" aria-expanded="false">
                                {{ Lang::get('panel::fields.settings') }}
                                <span class="caret"></span>
                            </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('panel/edit')}}"><span class="icon  ic-users "></span>{{ Lang::get('panel::fields.ProfileEdit') }}</a></li>
                            <li><a href="{{url('panel/changePassword')}}"><span class="icon ic-cog"></span>{{ Lang::get('panel::fields.ChangePassword') }}</a></li>
                          </ul>
                        </div>
                        <a href="{{url('panel/logout')}}" type="button" class="btn btn-default main-link">{{ Lang::get('panel::fields.logout') }}<span class="icon  ic-switch"></span></a>
                      </div>
                </div>
            </div>

            @yield('page-wrapper')

        </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
@stop

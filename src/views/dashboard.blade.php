@extends('panelViews::mainTemplate')
@section('page-wrapper')

            <div class="row">

                <div class="col-lg-12 dashboard-title">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                            
            </div>
            <!-- /.row -->
            <div class="row box-holder">
                @if(is_array(\Config::get('config.crudItems')))
                    @foreach (Serverfireteam\Panel\libs\dashboard::create() as $box)
                    <div class="col-lg-3 col-md-6">
                        <div class="panel ">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3 title">
                                        {{$box['title']}}
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{$box['count']}}</div>
                                        <div></div>

                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">

                                    <a href='{{$box['showListUrl']}}' class="pull-left">Show List <i class="icon ic-chevron-right"></i></a>
                                    <div class="pull-right"> <a class="add " href="{{$box['addUrl']}}"> Add  </a></div>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endif

                
            </div>
<script>
    $(function(){
        var color = ['primary','green','orange','red','purple','green2','blue2','yellow'];
        var pointer = 0;
        $('.panel').each(function(){
            if(pointer > color.length) pointer = 0;
            $(this).addClass('panel-'+color[pointer]);
            $(this).find('.pull-right .add').addClass('panel-'+color[pointer]);
            pointer++;
        })
    })
</script>
@stop            
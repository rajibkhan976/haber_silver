@extends('admin::layouts.master')
{{--@section('sidebar')
@include('admin::layouts.sidebar')
@stop--}}

@section('content')

    <!-- page start-->
    <div class="row" style="font-size: 13px">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;
                    <span style="color: #A54A7B " class="top-popover" rel="popover" data-title=" {{ $pageTitle }} " data-html="true" data-content="<em>we can show all user login history in this page</em>"> (?) </span>                    
                </div>

                <div class="panel-body">
                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::open(['method' =>'GET','route'=>'user.search.activity']) !!}
                    <div id="index-search">
                        <div class="col-sm-3">
                            {!! Form::text('title',@Input::get('title')? Input::get('title') : null,['class' => 'form-control','placeholder'=>'type title', 'title'=>'type your require permission "title", example :: Main, then click "search" button']) !!}
                        </div>
                        <div class="col-sm-2 filter-btn">
                            {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type title then click search button for required information')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>

                    {{-------------- Filter :Ends -------------------------------------------}}
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable1">
                            <thead>
                            <tr>
                                <th> Username </th>
                                <th> Action </th>
                                <th> Action Url </th>
                                <th> Action Table </th> 
                                <th> Action Detail </th>                  
                                <th> Date </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td>{{ucfirst(@$values->users_id)}}</td>
                                        <td>{{$values->action_name}}</td>
                                        <td>{{$values->action_url}}</td>
                                        <td>{{$values->action_table}}</td>
                                        <td>{{$values->action_detail}}</td>
                                        <td>{{$values->created_at}}</td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <span class="pull-left">{!! str_replace('/?', '?', $data->render()) !!} </span>
                </div>
            </div>
        </div>
    </div>
    <!-- page end-->

    


    <!-- Modal  -->

    <div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content add-form">

            </div>
        </div>
    </div>

    <!-- modal -->


    <!--script for this page only-->
    @if($errors->any())
        <script type="text/javascript">
            $(function(){
                $("#addData").modal('show');
            });
        </script>
    @endif

@stop
@extends('admin::layouts.master')


@section('content')

    <!-- page start-->
    <div class="row" style="font-size: 13px">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;
                     <span style="color: #A54A7B " class="top-popover" rel="popover" data-title=" {{ $pageTitle }}" data-html="true" data-content="<em>we can show all permission in this page</em>"> (?) </span>
                    <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="{{ route('route.in.permission') }}" data-placement="top" data-content="click to entry all route_url in permission list" onclick="return confirm('Are you sure to Add all routes in permission list?')" >Add Routes in Permission list
                    </a>

                </div>

                <div class="panel-body">
                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::open(['method' =>'GET','route'=>'user.permission.search']) !!}
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
                                <th> Title </th>
                                <th> Route Url </th>
                                <th> Action &nbsp;&nbsp;<span style="color: #A54A7B " class="top-popover" rel="popover" data-title="" data-html="true" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for delete informations"> (?) </span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td>{{ucfirst($values->title)}}</td>
                                        <td>{{$values->route_url}}</td>
                                        <td>
                                            <a href="{{ route('user.view.permission', $values->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="view"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('user.edit.permission', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="update"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('user.delete.permission', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" data-placement="top" data-content="delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <span class="pull-right">{!! str_replace('/?', '?',  $data->appends(Input::except('page'))->render() ) !!} </span>
                </div>
            </div>
        </div>
    </div>
    <!-- page end-->

    <div id="addData" class="modal fade" tabindex="" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content add-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Permissions <span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                    
                     {!! Form::open(['route' => 'user.store.permission','id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate" ]) !!}
                    
                     @include('user::permission._form')
                    {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- modal -->


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
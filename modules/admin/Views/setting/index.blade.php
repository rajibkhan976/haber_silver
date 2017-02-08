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
                    <span style="color: #A54A7B " class="top-popover" rel="popover" data-title=" {{ $pageTitle }}" data-html="true" data-content="<em>all user role define from this page, example : system-user or admin</em>"> (?) </span>


                    <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="#addData" data-placement="top" data-content="click add role button for new role entry">
                        <strong>Add Settings</strong>
                    </a>

                </div>

                <div class="panel-body">
                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::open(['method' =>'GET', 'route' => 'admin.setting.search']) !!}

                    <div id="index-search">
                        <div class="col-sm-3">
                            {!! Form::text('type',@Input::get('type')? Input::get('type') : null,['class' => 'form-control','placeholder'=>'Type', 'title'=>'Enter settings type, then click "search" button']) !!}
                        </div>
                        <div class="col-sm-3 filter-btn">
                            {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left pop','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
                        </div>
                    </div>
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>

                    {!! Form::close() !!}

                    {{-------------- Filter :Ends -------------------------------------------}}
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable1">
                            <thead>
                            <tr>
                                <th> Type </th>
                                <th> Last number </th>
                                <th> Increment </th>
                                <th> Status </th>
                                <th> Code </th>
                                <th> Action &nbsp;&nbsp;
                                 <span style="color: #A54A7B " class="top-popover" rel="popover" data-title="" data-html="true" data-content="view : click for details informations<br>update : click for update informations<br>"> (?) </span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td>{{ucfirst($values->type)}}</td>
                                        <td>{{ucfirst($values->last_number)}}</td>
                                        <td>{{ucfirst($values->increment)}}</td>
                                        <td>{{ucfirst($values->status)}}</td>
                                        <td>{{ucfirst(@$values->code)}}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.setting', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="update"><i class="fa fa-edit"></i></a>
                                        </td>
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


    <div id="addData" class="modal fade" tabindex="" role="dialog" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content add-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Settings Informatons<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                {!! Form::open(['route' => 'admin.store.setting', 'files'=> true, 'id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate" ]) !!}

                     @include('admin::setting._form')
                {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- modal -->


    <!-- Modal  -->

    <div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
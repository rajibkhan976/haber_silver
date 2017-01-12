@extends('admin::layouts.master')
@section('content')

<!-- page start-->
<div class="row" style="font-size: 13px;">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"> User list </span>&nbsp;&nbsp;&nbsp;
                <span style="color: #A54A7B" class="right-popover" rel="popover" data-title="User Lists" data-html="true" data-content="<em>You will able to show all users below <br> Also you can add user, update, delete from the action column in the table</em>">
                    (?)
                </span>

                <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="#addData" data-placement="left" data-content="click 'add user' button to create a new user">
                    <strong>Add User</strong>
                </a>

            </div>

            <div class="panel-body">

                {{-------------- Search :Starts -------------------------------------------}}
                {!! Form::open(['method' =>'GET','route'=>'user.search']) !!}
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        {!! Form::text('username', @Input::get('username')? Input::get('username') : null, ['class' => 'form-control','placeholder'=>'type username','title'=>'type your require "username" then click "search" button']) !!}

                    </div>
                    <div class="col-sm-2">
                        {!! Form::Select('status',array(''=>'Status','inactive'=>'Inactive','active'=>'Active','cancel'=>'Cancel'),@Input::get('status')? Input::get('status') : null,['class'=>'form-control', 'title'=>'select your require "status", example :: open, then click "search" button']) !!}
                    </div>
                    <div class="col-sm-3 filter-btn">
                        {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type user name or select branch or both in specific field then click search button for required information')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <p> &nbsp;</p>

                {{------------- Search :Ends -------------------------------------------}}


                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable1">
                        <thead>

                            <th> Image </th>
                            <th> Name </th>
                            <th> Username </th>
                            <th> Email </th>
                            <th> Role </th>
                            <th> Last Visit </th>
                            <th> Status &nbsp;&nbsp;<span style="color: #A54A7B" class="top-popover" rel="popover"  data-content="User's Status" > (?)</span></th>

                            <th> Action &nbsp;&nbsp;<span style="color: #A54A7B" class="top-popover" rel="popover"  data-content="view : click for details informations<br>update : click for update information <br> delete : click for delete informations">
                                    (?)
                                </span></th>
                        </tr>
                        </thead>
                        <tbody>

                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td> <img src="{!! isset($values->thumb) ? asset($values->thumb) : asset('uploads/users/default_thumb.png') !!}" >
                                        </td>
                                        <td> {!! @$values->first_name !!} {!! @$values->last_name !!} </td>
                                        <td> {!! @$values->username !!} </td>
                                        <td> {!! @$values->email !!} </td>
                                        <td> {!! isset($values->relRole)? \Illuminate\Support\Str::ucfirst(@$values->relRole->title) :  ucfirst(@$values->roles_title) !!} </td>
                                        <td> {!! @$values->last_visit !!} </td>

                                        <td> {{ucfirst(@$values->status)}} </td>

                                        <td>
                                            <a href="{{ route('user.show', $values->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#bgModal" data-placement="top" data-content="view"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('user.edit', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#bgModal" data-placement="top" data-content="update"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('user.delete', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" data-placement="top" data-content="delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                        </tbody>
                    </table>
                </div>
                <span class="pull-right">
                    {!! str_replace('/?', '?',  $data->appends(Input::except('page'))->render() ) !!}
                </span>
            </div>
        </div>
    </div>
</div>
<!-- page end-->

<div id="addData" class="modal fade" tabindex="" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" style="z-index:1050">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                <h4 class="modal-title" id="myModalLabel"> Add User Information
                    <span style="color: #A54A7B" class="right-popover" rel="popover" data-title="User Lists" data-html="true" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>">
                    (?)
                </span>
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'user.store', 'id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate" ]) !!}

                    @include('user::users._form')

                {!! Form::close() !!}
            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
<!-- modal -->


<!-- Modal  -->

<div class="modal fade" id="bgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="z-index:1050">
        <div class="modal-content">

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
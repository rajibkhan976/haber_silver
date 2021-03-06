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
                        <strong>Add Catalog</strong>
                    </a>

                </div>

                <div class="panel-body">
                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::open(['method' =>'GET', 'route' => 'admin.catalog.search']) !!}

                    <div id="index-search">
                        <div class="col-sm-3">
                            {!! Form::text('title',@Input::get('title')? Input::get('title') : null,['class' => 'form-control','placeholder'=>'Type title', 'title'=>'Type your required Role title "title", then click "search" button']) !!}
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
                                <th> Title </th>
                                <th> Image </th>
                                <th> File </th>
                                <th> Status </th>
                                <th> Action &nbsp;&nbsp;
                                 <span style="color: #A54A7B " class="top-popover" rel="popover" data-title="" data-html="true" data-content="view : click for details informations<br>update : click for update informations<br>"> (?) </span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td>{{ucfirst($values->title)}}</td>
                                        <td>@if(isset($values->image))<img src="{{ $values->thumb .'?'.rand(100,500)}}"> @endif</td>
                                        <td> @if( @$values->file != '' ) <img src="/assets/images/admin/50x50-pdf-icon.png">
                                            @else
                                                <a href="{{ route('admin.edit.catalog', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="update"> <i class="fa fa-upload" aria-hidden="true"></i> </a>
                                            @endif</td>
                                        <td>{{ucfirst($values->status)}}</td>
                                        <td>
                                            <a href="{{ route('admin.view.catalog', $values->id) }}" class="btn btn-info btn-xs" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="view"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.edit.catalog', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="update"><i class="fa fa-edit"></i></a>
                                            @if( $values->status != 'cancel')
                                            <a href="{{ route('admin.delete.catalog', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" data-placement="top" data-content="delete"><i class="fa fa-trash-o"></i></a>
                                            @endif
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
                    <h4 class="modal-title" id="myModalLabel"> Add Catalog <span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                {!! Form::open(['route' => 'admin.store.catalog', 'files'=> true, 'id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate" ]) !!}
                   
                     @include('admin::catalog._form')
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
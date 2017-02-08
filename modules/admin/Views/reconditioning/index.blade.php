@extends('admin::layouts.master')


@section('content')

    <!-- page start-->
    <div class="row" style="font-size: 13px">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;
                    <span style="color: #A54A7B " class="top-popover" rel="popover" data-title=" {{ $pageTitle }}"
                          data-html="true" data-content="<em>we can show all reconditioning service in this page</em>"> (?) </span>
                    <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="#addData"
                       data-placement="top"
                       data-content="click add reconditioning service button for new image slider entry">
                        <strong>Add Reconditioning Item</strong>
                    </a>
                </div>

                <div class="panel-body">
                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::open(['method' =>'GET','route'=>'admin.reconditioning.search']) !!}
                    <div id="index-search">
                        <div class="col-sm-3">
                            {!! Form::text('title',@Input::get('title')? Input::get('title') : null,['class' => 'form-control','placeholder'=>'Search Keywords', 'name'=>'title', 'title'=>'example :: Abc, then click "search" button']) !!}
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
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                               id="datatable1">
                            <thead>
                            <tr>
                                <th> Title</th>
                                <th> Slug</th>
                                <th> Image View</th>
                                <th> Status</th>
                                <th> Action &nbsp;&nbsp;<span style="color: #A54A7B " class="top-popover" rel="popover"
                                                              data-title="" data-html="true"
                                                              data-content="view : click for details informations<br>update : click for update informations<br>delete : click for cancel reconditioning service"> (?) </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td>
                                            <a href="{{ route('admin.view.reconditioning', $values->id) }}" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="view"> {{ucfirst($values->title)}}</a>
                                        </td>
                                        <td>{{$values->slug}}</td>
                                        <td>@if(isset($values->thumb) && !empty($values->thumb))
                                            <img src="{{ $values->thumb .'?'.rand(100,500)}}">
                                            @else
                                                <img style="height: 50px" src="/{{ $no_image .'?'.rand(100,500)}}">
                                            @endif </td>
                                        <td>{{ucfirst($values->status)}}</td>
                                        <td>
                                            <a href="{{ route('admin.view.reconditioning', $values->id) }}"
                                               class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal"
                                               data-placement="top" data-content="view"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.edit.reconditioning', $values->id) }}"
                                               class="btn btn-primary btn-xs" data-toggle="modal"
                                               data-target="#etsbModal" data-placement="top" data-content="update"><i
                                                        class="fa fa-edit"></i></a>
                                            @if( $values->status !="cancel")
                                                <a href="{{ route('admin.delete.reconditioning', $values->id) }}"
                                                   class="btn btn-danger btn-xs"
                                                   onclick="return confirm('Are you sure to Delete?')"
                                                   data-placement="top" data-content="delete"><i
                                                            class="fa fa-trash-o"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- page end-->

    <div id="addData" class="modal fade" tabindex="" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content add-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            title="click x button for close this entry form">×
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Reconditioning Item<span style="color: #A54A7B"
                                                                                           class="user-guideline"
                                                                                           data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font
                                    size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route' => 'admin.store.reconditioning','id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate", "enctype" => "multipart/form-data" ]) !!}

                    @include('admin::reconditioning._form')
                    {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- modal -->


    <!-- Modal  -->

    <div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
         data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content add-form">

            </div>
        </div>
    </div>

    <!-- modal -->


    <!--script for this page only-->
    @if($errors->any())
        <script type="text/javascript">
            $(function () {
                $("#addData").modal('show');
            });
        </script>
    @endif

@stop
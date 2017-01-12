@extends('admin::layouts.master')


@section('content')

    <!-- page start-->
    <div class="row" style="font-size: 13px">
        <div class="col-sm-12">
            <div class="panel">


                <div class="panel-body">
                    {{-------------- Filter :Starts -------------------------------------------}}
                    <div>
                        <b> {{$pageTitle}} : {{ucfirst($pc_data->title)}}</b>
                        || <b> Type: </b> {{ucfirst($pc_data->type)}}
                        || <b> Status: </b> {{$pc_data->status}}

                    </div>
                    {{-------------- Filter :Ends -------------------------------------------}}
                    <div class="table-primary col-md-8 col-md-offset-2" >
                        <!-- For Add  more image -->
                        <div class="panel-heading">
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="#addData" data-placement="top" data-content="click add company button for new Company entry"  >
                                <strong>Add Product Category Image</strong>
                            </a>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++ -->


                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable1">
                            <thead>
                            <tr>
                                <th> Image </th>
                                <th> Title </th>
                                <th> Alt </th>
                                <th> Status </th>

                                <th> Action &nbsp;&nbsp;<span style="color: #A54A7B " class="top-popover" rel="popover" data-title="" data-html="true" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for cancel company activity"> (?) </span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td> <img src="{{@$values->thumb}}" alt="">  </td>
                                        <td> {{@$values->title}}"   </td>
                                        <td> {{@$values->alt}}  </td>
                                        <td> {{@$values->status}}  </td>

                                        <td>
                                            <a href="{{ route('admin.edit.product.category.image', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="update"><i class="fa fa-edit"></i></a>
                                            @if( $values->status !="cancel")
                                                <a href="{{ route('admin.delete.product.category.image', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" data-placement="top" data-content="delete"><i class="fa fa-trash-o"></i></a>
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Product Category Image <span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>">(?) </span></h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route' => 'admin.store.product.category.image', 'method'=>'POST', 'files'=>true, 'id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate", "enctype" => "multipart/form-data" ]) !!}

                    @include('admin::product_category_image._form')
                    {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- modal -->


    <!-- Modal  -->

    <div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
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
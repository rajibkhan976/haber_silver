@extends('admin::layouts.master')


@section('content')

    <!-- page start-->
    <div class="row" style="font-size: 13px">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;
                     <span style="color: #A54A7B " class="top-popover" rel="popover" data-title=" {{ $pageTitle }}" data-html="true" data-content="<em>we can show all product image in this page</em>"> (?) </span>
                    <a href="{{url('admin/product-image')}}" class="btn btn-primary btn-xs pull-right pop" >   
                        <strong>Go To All Product Image List</strong>
                    </a>                   
               </div>

                <div class="panel-body"> 
                    {{-------------- Filter :Ends --------------------}}
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable1">
                            <thead>
                                <tr>
                                    <th> Title </th>
                                    <th> Product </th>
                                    <th> Alter Text </th> 
                                    <th class="col-lg-4"> Product Image </th>
                                    <td> Thumb Image </td>
                                    <td> Status </td>
                                    <th> Action &nbsp;&nbsp;<span style="color: #A54A7B " class="top-popover" rel="popover" data-title="" data-html="true" data-content="update : click for update informations<br>delete : click for cancel Product Image activity"> (?) </span></th>
                                </tr>
                            </thead>
                            <tbody>    

                            @if(isset($data))
                                @foreach($data as $values)
                              
                                <tr>
                                    <td> {{ucfirst($values->title)}} </td>
                                    <td> {{ucfirst($values->product->title)}} </td>
                                    <td> {{$values->alt}} </td>
                                    <td> @if(isset($values->image))<img src="{{ asset($values->image)}}"> @endif</td>
                                    <td> @if(isset($values->image))<img src="{{ asset($values->thumb)}}"> @endif</td>
                                    <td> {{ucfirst($values->status)}} </td> 
                                    <td>                                     
                                      <a href="{{ route('admin.edit.product.image', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="update"><i class="fa fa-edit"></i>
                                      </a>
                                        @if( $values->status !="cancel")
                                            <a href="{{ route('admin.delete.product.image', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" data-placement="top" data-content="delete"><i class="fa fa-trash-o"></i></a>
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Product Image <span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                    
                    {!! Form::open(['route' => 'admin.store.product.image','id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate", "enctype" => "multipart/form-data" ]) !!}
                    
                         @include('admin::product_image._form-image')
                         
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
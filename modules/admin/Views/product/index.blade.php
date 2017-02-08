@extends('admin::layouts.master')


@section('content')

    <!-- page start-->
    <div class="row" style="font-size: 13px">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;
                     <span style="color: #A54A7B " class="top-popover" rel="popover" data-title=" {{ $pageTitle }}" data-html="true" data-content="<em>we can show all products in this page</em>"> (?) </span>
                    <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="#addData" data-placement="top" data-content="click add product image button for new product image"  >   
                        <strong>Add Product</strong>
                    </a>                   
               </div>

                <div class="panel-body">
                    {{-------------- Filter :Starts -------------------------------------------}}
                    {!! Form::open(['method' =>'GET','route'=>'admin.product.search']) !!}
                    <div id="index-search">
                        <div class="col-sm-3">
                            {!! Form::text('title',@Input::get('title')? Input::get('title') : null,['class' => 'form-control','placeholder'=>'title']) !!}
                        </div>
                        <div class="col-sm-2 filter-btn">
                            {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type title then click search button for required information')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>

                    {{-------------- Filter :Ends --------------------}}
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable1">
                            <thead>
                            <tr>
                                <th> Category </th>
                                <th> Subcategory </th>
                                <th> Product Code</th>
                                <th> Product </th>
                                <th> Cost Price </th>   
                                <th> Sell Price </th>
                                <th> Status </th>
                                <th> View Image </th>                               
                                <th> Action &nbsp;&nbsp;<span style="color: #A54A7B " class="top-popover" rel="popover" data-title="" data-html="true" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for cancel product activity"> (?) </span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                                @foreach($data as $values)
                                <tr class="gradeX">
                                    <td> {{ucfirst($values->productCategory['title'])}} </td>
                                    <td> {{ucfirst($values->productSubCategory['title'])}} </td>
                                    <td> {{$values->product_code}} </td> 
                                    <td> {{$values->title}} </td>   
                                    <td> {{$values->cost_price}} </td>   
                                    <td> {{$values->sell_price}} </td> 
                                    <td> {{ucfirst($values->status)}} </td>
                                    <td> 
                                       <a href="{{ route('admin.view.product.image.details', $values->id) }}" class="btn btn-info btn-xs"><i class="fa fa-file-image-o"></i></a>
                                    </td>                                   
                                    <td>
                                        <a href="{{ route('admin.view.product', $values->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="view"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.edit.product', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="update"><i class="fa fa-edit"></i></a>
                                            @if( $values->status !="inactive")
                                                <a href="{{ route('admin.delete.product', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" data-placement="top" data-content="delete"><i class="fa fa-trash-o"></i></a>
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
                    <h4 class="modal-title" id="myModalLabel">Add Product <span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                    
                    {!! Form::open(['route' => 'admin.store.product','id' => 'user-jq-validation-form', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate", "enctype" => "multipart/form-data" ]) !!}
                    
                         @include('admin::product._form') 
                         
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
@extends('admin::layouts.master')


@section('content')

    <div class="row" style="font-size: 13px">

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;
                    <span style="color: #A54A7B " class="top-popover" rel="popover" data-title=" {{ $pageTitle }}" data-html="true" data-content="<em>search files by typing content or keyword</em>"> (?) </span>
                    <div class="row pull-right">
                        <a class="btn btn-primary btn-xs" href="{{route('admin.es_indexing')}}" >
                            <strong>ES (Indexing)</strong>
                        </a>

                        <a class="btn btn-info btn-xs "  data-toggle="modal" href="#addData"  data-placement="top">
                            <strong>Upload Files</strong>
                        </a>

                    </div>

                </div>

                <div class="panel-body">

                    {{-------------- Filter :Starts -------------------------------}}
                    {!! Form::open(['method' =>'GET','route'=>'admin.es_search']) !!}
                    <div class="row">
                        <div class="col-sm-10">
                            {!! Form::text('query',@Input::get('query')? Input::get('query') : null,['class' => 'form-control','placeholder'=>'Search Your Files ...', 'style'=>'background: #efefef; padding: 15px; height: 44px; color: orangered;']) !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Form::submit('Search', array('class'=>'btn btn-primary btn-lg')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <p> &nbsp;</p>

                    <div class="row">
                        <div class="col-sm-12">
                            @forelse($data as $val)

                                <?php
                                    $file_path = $val['_source']['file_path'];
                                    $file = str_replace('Users/selimreza/Sites/haber_dev/public/', '', $file_path);
                                    $file_content = $val['_source']['attachment']['content'];
                                    $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                                ?>

                                <div class="col-sm-3">
                                    <div class="col-sm-12">
                                        <a href="{{asset($file)}}" target="_blank">
                                            @if($file_extension == 'pdf' )
                                                <img src="{{asset('assets/images/admin/pdf_icon.png')}}" width="200px" height="250px">
                                            @elseif($file_extension == 'txt')
                                                <img src="{{asset('assets/images/admin/txt_icon.png')}}" width="200px" height="250px">
                                            @else
                                                <img src="{{asset('assets/images/admin/doc_icon.png')}}" width="200px" height="250px">
                                            @endif
                                            <p>
                                                {!! str_limit($file_content, 200) !!}
                                            </p>
                                        </a>
                                    </div>
                                </div>


                            @empty

                                {!! 'No Match found!' !!}

                            @endforelse
                        </div>
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
                    <h4 class="modal-title" id="myModalLabel">Upload your files (PDF / DOCX / TXT)</h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route' => 'admin.es_uploads', 'method'=>'POST', 'files'=>true,  "novalidate"=>"novalidate", "enctype" => "multipart/form-data" ]) !!}

                    <div class="col-lg-offset-0 col-md-4">
                        <div class="form-group">
                            <div style="float: left; width: 80%;">
                                {{ Form::file('files[]', ['multiple'=>true,'files'=>true, 'class' => 'field form-control']) }}
                            </div>

                        </div>
                    </div>

                    <div class="form-margin-btn pull-right">
                        {!! Form::submit('Upload Files', ['class' => 'btn btn-success']) !!}
                        <a href="#" class=" btn btn-default">Close</a>
                    </div>



                    {!! Form::close() !!}

                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- modal -->


@stop
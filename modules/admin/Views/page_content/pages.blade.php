@extends('admin::layouts.master')
@section('content')

    <!-- START Header scripts -->
    @include('user::scripts._header')
    <!-- END Header scripts -->
    <!-- page start-->

        <div class="col-sm-12">
            <div class="panel">

                <div class="panel-body">
                    <div class="row" style="font-size: 13px">
                        <div class="col-sm-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title">{{ isset($data->type)?ucfirst($data->type):''}} Page Content</span>
                                    <div class="panel-body">

                                        <div class="table-primary">
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                                                   id="datatable1">

                                                <tr>
                                                    <th class="col-lg-4">Type</th>
                                                    <td>{{ isset($data->type)?ucfirst($data->type):''}}</td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                    <th class="col-lg-4">route</th>
                                                    <td>{{ isset($data->route)? $data->route:''}}</td>
                                                </tr>

                                                <td colspan="2">
                                                    @if(isset($data->image) && !empty($data->image))
                                                        <img class="img-responsive" src="{{ $data->image }}"/>
                                                    @else
                                                        <img class="img-responsive" src="/{{ $no_image }}">
                                                    @endif
                                                </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-lg-4">Short Description</th>
                                                    <td>{{ isset($data->short_description)? $data->short_description:''}}</td>
                                                </tr>

                                                <tr>
                                                    <th class="col-lg-4">Long Description</th>
                                                    <td>{{ isset($data->long_description)? $data->long_description:''}}</td>
                                                </tr>

                                                <tr>
                                                    <th class="col-lg-4">Status</th>
                                                    <td>{{ isset($data->status)? $data->status:''}}</td>
                                                </tr>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- START Footer scripts -->
                    @include('user::scripts._footer')
                    <!-- END Header scripts -->


                </div>
            </div>
        </div>
    </div>




@stop
@extends('admin::layouts.master')
@section('content')

    <div class="section-body contain-lg">
        <!-- BEGIN BASIC ELEMENTS -->
        <div class="row">

            <div class="col-md-2">
                <h4>{{ $pageTitle }}</h4>
                <article class="margin-bottom-xxl">
                    <ul class="list-divided">
                        <li>
                            Here you will be able to assign permission for the selected role.
                        </li>
                        <li>
                            Also you will revoke permission for the selected role.
                        </li>
                    </ul>
                </article>
            </div><!--end .col -->
            <div class="col-lg-offset-0 col-md-10 col-sm-10">
                <p> Here you will be able to assign permission for each and every actions in our system</p>
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'user.store.permission.role','class' => 'form']) !!}
                            @include('user::role_permission._duallistbox_form')
                        {!! Form::close() !!}
                    </div><!--end .card-body -->
                </div><!--end .card -->
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END BASIC ELEMENTS -->


    </div>

@stop
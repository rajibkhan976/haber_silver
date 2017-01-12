<!DOCTYPE html>
<html lang="en">
<head>
    <title> {!! isset($pageTitle) ? $pageTitle : null !!} </title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content=" haber silver on the way">
    <meta name="description" content="haber silver">
    <!-- END META -->

    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/materialadmin.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/material-design-iconic-font.min.css') }}" />

    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/summernote/summernote.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/DataTables/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/DataTables/extensions/dataTables.colVis.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/DataTables/extensions/dataTables.tableTools.css') }}" />

    <!-- Custom CSS for admin panel -->
    <link rel="stylesheet" href="{{ elixir('assets/css/admin.css') }}" />

    <!-- END STYLESHEETS -->


    <!-- JavaScript -->
    <script src="{{ elixir('assets/js/admin-theme/html5shiv.js') }}"></script>
    <script src="{{ elixir('assets/js/admin-theme/respond.min.js') }}"></script>

    <script src="{{ elixir('assets/js/admin-theme/jquery/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ elixir('assets/js/admin-theme/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ elixir('assets/js/admin-theme/bootstrap.min.js') }}"></script>

    <!-- END JavaScript -->

    <!-- Custom JavaScript -->
    <script src="{{ elixir('assets/js/admin.min.js') }}"></script>
    <!-- END Custom JavaScript -->

</head>
<body class="menubar-hoverable header-fixed ">

<!-- BEGIN LOGIN SECTION -->
<section class="section-account">
    <div class="img-backdrop" style="background-image: url('{{asset('assets/images/img16.jpg')}}')"></div>
    <div class="spacer"></div>
    <div class="card contain-sm style-transparent">
        <div class="card-body">
            <div class="row">

                @if(isset($errors))
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif

                {{--set some message after action--}}
                @if (Session::has('message'))
                    <div class="alert alert-success">{{Session::get("message")}}</div>
                @elseif(Session::has('error'))
                    <div class="alert alert-warning">{{Session::get("error")}}</div>
                @elseif(Session::has('info'))
                    <div class="alert alert-info">{{Session::get("info")}}</div>
                @elseif(Session::has('danger'))
                    <div class="alert alert-danger">{{Session::get("danger")}}</div>
                @endif

                {{-- Token Mis mathched exception  --}}
                @if(isset($errors))
                    @if ($errors->has('token_error'))
                        {{$errors}}
                        <div class="alert alert-warning"> {{ $errors->first('token_error') }} </div>
                    @endif
                @endif

                <div class="col-lg-offset-2 col-sm-8">
                    <div class="card" style="padding: 20px;">
                        <br/>
                        <span class="text-lg text-normal text-primary">Login | HaberSilver.com</span>
                        <br/><br/>

                        {!! Form::open(['route' => 'post-login','id'=>'login-data-validation', "class"=>"form form-validate floating-label",  "novalidate"=>"novalidate"]) !!}
                        {!! csrf_field() !!}
                            <div class="form-group">
                                {!! Form::email('username', null, ['class' => 'form-control','required', 'id'=>'username']) !!}
                                <label for="username">Username</label>
                            </div>
                            <div class="form-group">
                                {!! Form::password('password', ['class' => 'form-control','required', 'id'=>'password']) !!}
                                <label for="password">Password</label>
                                <p class="help-block"><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" >Forgotten?</a></p>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <div class="checkbox checkbox-inline checkbox-styled">
                                        <label>
                                            <input type="checkbox"> <span>Remember me</span>
                                        </label>
                                    </div>
                                </div><!--end .col -->
                                <div class="col-xs-6 text-right">
                                    <button class="btn btn-primary btn-raised" type="submit">Login</button>
                                </div><!--end .col -->
                            </div><!--end .row -->
                        {!! Form::close() !!}
                    </div>
                </div><!--end .col -->
                {{--<div class="col-sm-5 col-sm-offset-1 text-center">

                    <h3 class="text-light">
                        No account yet?
                    </h3>
                    <a class="btn btn-block btn-raised btn-primary" href="#">Sign up here</a>
                    <br><br>
                    <h3 class="text-light">
                        or
                    </h3>
                    <p>
                        <a href="#" class="btn btn-block btn-raised btn-info"><i class="fa fa-facebook pull-left"></i>Login with Facebook</a>
                    </p>
                    <p>
                        <a href="#" class="btn btn-block btn-raised btn-info"><i class="fa fa-twitter pull-left"></i>Login with Twitter</a>
                    </p>

                </div><!--end .col -->--}}
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>
<!-- END LOGIN SECTION -->

<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Reset Password Form</h4>
            </div>
            <div class="modal-body">
                @include('user::reset_password._form')
            </div>

        </div>
    </div>
</div>


<!-- BEGIN JAVASCRIPT -->

<script src="{{ elixir('assets/js/admin-theme/spin.js/spin.min.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/autosize/jquery.autosize.min.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/DataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/DataTables/extensions/ColVis/js/dataTables.colVis.min.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/DemoTableDynamic.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/ckeditor/ckeditor.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/ckeditor/adapters/jquery.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/summernote/summernote.min.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/jquery-validation/dist/jquery.validate.min.js') }}"></script>

<script src="{{ elixir('assets/js/admin-theme/App.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/AppNavigation.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/AppOffcanvas.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/AppCard.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/AppForm.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/AppNavSearch.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/AppVendor.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/Demo.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/DemoDashboard.js') }}"></script>
<script src="{{ elixir('assets/js/admin-theme/DemoFormEditors.js') }}"></script>


<!-- END JAVASCRIPT -->

</body>
</html>

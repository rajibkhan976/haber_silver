<!DOCTYPE html>
<html lang="en">
<head>
    <title>{!! $pageTitle or "Admin | Haber Silver" !!}</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Haber Silver and Sons">
    <meta name="description" content="Haber Silver and Sons">
    <!-- END META -->

    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/materialadmin.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/material-design-iconic-font.min.css') }}" />


    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/multi-select/multi-select.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/admin-theme/bootstrap-datepicker/datepicker3.css') }}" />


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


<!-- BEGIN HEADER-->
<header id="header" >
    <div class="headerbar">
        @include('admin::layouts.header')
    </div>
</header>
<!-- END HEADER-->

<!-- BEGIN BASE-->
<div id="base">
    <!-- BEGIN OFFCANVAS LEFT -->
    <div class="offcanvas">
    </div><!--end .offcanvas-->
    <!-- END OFFCANVAS LEFT -->

    <!-- BEGIN CONTENT-->
    <div id="content">

        @include('admin::layouts.error_message')


        <section>
            <div class="section-body">

                @yield('content')

            </div>
        </section>
    </div><!--end #content-->
    <!-- END CONTENT -->

    <!-- BEGIN MENUBAR-->
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
            <div>
                <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="expanded">
                <a href="{{route('admin/dashboard')}}">
                    <span class="text-lg text-bold text-primary ">Haber &nbsp; Silver</span>
                </a>
            </div>
        </div>
        <div class="menubar-scroll-panel">

            <!-- BEGIN MAIN MENU -->
            <ul id="main-menu" class="gui-controls">

                <!-- sidebar -->
                @include('admin::layouts.sidebar')

            </ul><!--end .main-menu -->
            <!-- END MAIN MENU -->

            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">Copyright &copy; 2016</span> <strong>Haber Silver</strong>
                </small>
            </div>
        </div><!--end .menubar-scroll-panel-->
    </div><!--end #menubar-->
    <!-- END MENUBAR -->

    {{--@include('admin::layouts.content')--}}

</div><!--end #base-->
<!-- END BASE -->


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

    <script src="{{ elixir('assets/js/admin-theme/multi-select/multiselect.min.js') }}"></script>
    <script src="{{ elixir('assets/js/admin-theme/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

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

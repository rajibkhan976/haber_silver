<!-- BEGIN DASHBOARD -->
<li>
    <a href="{{route('admin/dashboard')}}" class="active">
        <div class="gui-icon"><i class="md md-home"></i></div>
        <span class="title">Dashboard</span>
    </a>
</li><!--end /menu-li -->
<!-- END DASHBOARD -->


<!-- BEGIN User Management -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-user"></i></div>
        <span class="title"></i>User Management </span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{route('user.lists')}}" ><span class="title"><i class="fa fa-user fa-fw"></i> User Lists (All) </span></a></li>
        <li><a href="{{route('user.site.user')}}" ><span class="title"><i class="fa fa-user fa-fw"></i> Site User(s) </span></a></li>
        <li><a href="{{route('user.cms.user')}}" ><span class="title"><i class="fa fa-user fa-fw"></i> CMS User(s) </span></a></li>
        <li><a href="{{route('user.distributor.user')}}" ><span class="title"><i class="fa fa-user fa-fw"></i> Distributor(s) </span></a></li>
        <li><a href="{{route('user.view.activity')}}" ><span class="title"><i class="md md-assessment"></i> User's Activity </span></a></li>
        <li><a href="#" ><span class="title"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Settings </span></a></li>

    </ul><!--end /submenu -->
</li>
<!-- END User Management -->



<!-- BEGIN EMAIL -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-user-md"></i></div>
        <span class="title"> Permission Manage</span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{route('user.role')}}" ><span class="title"><i class="fa fa-tasks" ></i> Role Manage</span></a></li>
        <li><a href="{{ route('user.index.permission') }}" ><span class="title"><i class="fa fa-exclamation-triangle"></i> Permission(s) </span></a></li>
        <li><a href="{{ route('user.index.role.permission') }}" ><span class="title"><i class="fa fa-user-secret"></i> Access Control Role wise </span></a></li>
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END EMAIL -->



<!-- BEGIN UI -->
<li class="gui-folder">
    <a>
        <div class="gui-icon">
            <i class="fa fa-cart-arrow-down" ></i>
        </div>
        <span class="title"> Product Management </span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{url('admin/product')}}" ><span class="title"><i class="fa fa-align-justify"></i> Product Lists</span></a></li>
        <li><a href="{{ route('admin.index.product.category') }}" ><span class="title"><i class="fa fa-file-text-o"></i> Product Category</span></a></li>
        <li><a href="{{ route('admin.index.product.sub.category') }}" ><span class="title"><i class="fa fa-file-text-o"></i> Product Subcategory</span></a></li>
        <li><a href="{{ route('admin.setting') }}" ><span class="title"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Settings</span></a></li>
        <li class="gui-folder">
            <a href="javascript:void(0);">
                <span class="title"><i class="fa fa-file" aria-hidden="true"></i> Reports </span>
            </a>
            <!--start submenu -->
            <ul>
                <li><a href="#" ><span class="title"><i class="fa fa-file-o"></i> Product Balance Sheet</span></a></li>
                <li><a href="#" ><span class="title"><i class="fa fa-file-o"></i> Quote Balance Sheet</span></a></li>
            </ul><!--end /submenu -->
        </li><!--end /menu-li -->
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END UI -->

<!-- BEGIN COMPANY MANAGE -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="md md-computer"></i></div>
        <span class="title">Company Manage</span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{url('admin/company')}}"><span class="title"><i class="fa fa-rss"></i> Company</span></a></li>
        {{--<li><a href="{{url('admin/company-user')}}" >--}}
                {{--<span class="title"><i class="fa fa-user"></i> Company User</span></a></li>--}}
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END COMPANY MANAGE -->

<!-- BEGIN PAGES -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-file"></i></div>
        <span class="title">Pages</span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{ route('admin.view.single.page.content',1) }}" ><span class="title"><i class="fa fa-file"></i> About Us</span></a></li>
        <li><a href="{{ route('admin.view.single.page.content',2) }}" ><span class="title"><i class="fa fa-file"></i> Contact Us</span></a></li>
        <li><a href="{{url('admin/page-content')}}" ><span class="title"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Page Content</span></a></li>

    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END PAGES -->

<!-- BEGIN FEATURE PAGES -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-file"></i></div>
        <span class="title">Feature Pages </span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{url('admin/video-master')}}" ><span class="title"><i class="fa fa-video-camera"></i> Video Manager</span></a></li>
        <li><a href="{{url('admin/reconditioning')}}" ><span class="title"><i class="fa fa-file"></i> Reconditioning</span></a></li>
        <li><a href=" {{ route('admin.catalog') }}" ><span class="title"><i class="fa fa-file-pdf-o"></i> Catalog Manage </span></a></li>
        <li><a href="{{url('admin/trade-show')}}" ><span class="title"><i class="fa fa-rss"></i> Trade Show</span></a></li>
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END FEATURE PAGES -->

<!-- BEGIN HOMEPAGE MANAGE -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-file"></i></div>
        <span class="title">Homepage Manage </span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{url('admin/image-slider')}}" ><span class="title"><i class="fa fa-file-image-o"></i> Image Slider</span></a></li>
        <li><a href="{{url('admin/image-slider')}}" ><span class="title"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Settings</span></a></li>
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END FORMS -->

<!-- BEGIN MENU PANEL -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
        <span class="title">Menu Panel </span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{url('admin/menu-panel')}}" ><span class="title"><i class="fa fa-cog"></i> Menu Setup</span></a></li>
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END MENU PANEL -->

<!-- BEGIN SETTINGS -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i></div>
        <span class="title">Settings </span>
    </a>
    <!--start submenu -->
    <ul>
        {{--<li><a href="#" ><span class="title"><i class="fa fa-file-code-o"></i> Code Generator</span></a></li>--}}
        <li><a href="#" ><span class="title"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Setup Tools</span></a></li>
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END SETTINGS -->

<li>
    <a href="#" >
        <div class="gui-icon"><i class="md md-assessment"></i></div>
        <span class="title">Reports</span>
    </a>
</li><!--end /menu-li -->
<!-- END CHARTS -->
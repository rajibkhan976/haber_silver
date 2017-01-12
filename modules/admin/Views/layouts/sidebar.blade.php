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
        <li><a href="#" ><span class="title"><i class="fa fa-align-justify"></i> Product Lists</span></a></li>
        <li><a href="#" ><span class="title"><i class="fa fa-file-text-o"></i> Product Category</span></a></li>
        <li><a href="#" ><span class="title"><i class="fa fa-file-text-o"></i> Product Subcategory</span></a></li>
        <li><a href="#" ><span class="title"><i class="fa fa-file-pdf-o"></i> Catalog Manage </span></a></li>
        <li><a href="#" ><span class="title"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Settings</span></a></li>
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

<!-- BEGIN PAGES -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="md md-computer"></i></div>
        <span class="title">CRUD</span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="{{url('admin/video-master')}}" ><span class="title"><i class="fa fa-rss"></i> Video Master</span></a></li>
        <li><a href="{{url('admin/image-slider')}}" ><span class="title"><i class="fa fa-rss"></i> Image Slider</span></a></li>
        <li><a href="{{url('admin/reconditioning')}}" ><span class="title"><i class="fa fa-rss"></i> Reconditioning</span></a></li>
        <li><a href="{{url('admin/trade-show')}}" ><span class="title"><i class="fa fa-rss"></i> Trade Show</span></a></li>
        <li><a href="{{url('admin/page-content')}}" ><span class="title"><i class="fa fa-rss"></i> Page Content</span></a></li>
        <li><a href="{{url('admin/catalog')}}" ><span class="title"><i class="fa fa-rss"></i> Catalog</span></a></li>
        <li><a href="{{url('admin/company-user')}}" ><span class="title"><i class="fa fa-rss"></i> Company User</span></a></li>
        <li><a href="{{url('admin/setting')}}" ><span class="title"><i class="fa fa-rss"></i> Settings</span></a></li>
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END FORMS -->


<!-- BEGIN PAGES -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="md md-computer"></i></div>
        <span class="title">Pages</span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="#" ><span class="title"><i class="fa fa-rss"></i> About Us</span></a></li>
        <li><a href="#" ><span class="title"><i class="fa fa-rss"></i> Contact Us</span></a></li>
        <li><a href="#" ><span class="title"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Settings</span></a></li>
    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END FORMS -->



<!-- BEGIN LEVELS -->
<li class="gui-folder">
    <a>
        <div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
        <span class="title">Menu Panels</span>
    </a>
    <!--start submenu -->
    <ul>
        <li><a href="#"><span class="title"><i class="fa fa-folder-open"></i> Header Menu</span></a></li>
        <li><a href="#"><span class="title"><i class="fa fa-folder-open"></i> Footer Menu</span></a></li>

    </ul><!--end /submenu -->
</li><!--end /menu-li -->
<!-- END LEVELS -->

<!-- BEGIN CHARTS -->
<li>
    <a href="#" >
        <div class="gui-icon"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> </div>
        <span class="title">Settings</span>
    </a>
</li><!--end /menu-li -->
<!-- END CHARTS -->

<!-- BEGIN CHARTS -->
<li>
    <a href="#" >
        <div class="gui-icon"><i class="md md-assessment"></i></div>
        <span class="title">Reports</span>
    </a>
</li><!--end /menu-li -->
<!-- END CHARTS -->
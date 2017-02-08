<!-- Jumbotron Header -->
<header class="navbar-fixed-top" >
    <!-- Navigation -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="col-md-4">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="col-md-6"><a class="navbar-brand" href="{{route('web.html')}}"><img src="{{asset('assets/images/web/haber-logo.jpg')}}" alt="logo" class="image-resposive" /></a></div>
                        <div class="col-md-6 since1902"><img src="{{asset('assets/images/web/since1902.jpg')}}" alt="logo" class="image-resposive" /></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <div class="top-cart">
                            <div class="col-md-9 text-right">
                                <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Quote Cart</a>
                                <a href="{{route('login')}}">Login</a>
                            </div>
                            <div class="col-md-3 text-right">
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Search by category" aria-describedby="basic-addon2" type="text">
                                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <div class="call-icon-div">
                                <i class="fa fa-phone call-icon" aria-hidden="true"></i> 718-993-6405
                            </div>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="{{route('web.html.category')}}">Products</a>
                                </li>
                                <li>
                                    <a href="#">Videos</a>
                                </li>
                                <li>
                                    <a href="#">Gallery</a>
                                </li>
                                <li>
                                    <a href="#">Reps</a>
                                </li>
                                <li>
                                    <a href="#">Literature</a>
                                </li>
                                <li>
                                    <a href="#">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </nav>
</header>
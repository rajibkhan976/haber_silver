@extends('web::layouts.master')

<div class="container-fluid">
    <div class="row">
        <div class="category-top-bar">
            <div class="container">
                <div class="col-md-6"></div><div class="col-md-5"><h2>Product List</h2></div><div class="col-md-1"><h2><i class="fa fa-align-justify" aria-hidden="true"></i> <i class="fa fa-th-large" aria-hidden="true"></i></h2></div>
            </div>
        </div>
    </div>
</div>

@section('content')

<!-- Page Content -->
<div class="container">
    <!-- Page Features -->
    <div class="row">
        <div class="col-md-4">
            <div class="sidebar-nav">
                <ul class="nav nav-stacked">
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Kenny-Mack.jpg')}} width='80'>">Kenny Mack Resin</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Modern-Twist.jpg')}} width='80'>">Modern-Twist Silicone Placemats</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Fusion-Buffet.jpg')}} width='80'>">Fusion Buffet System & Risers</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Grill-Chafers.jpg')}} width='80'>">Induction/Grill Chafers</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Chafers-Marmites.jpg')}} width='80'>">Chafers & Marmites</a></li>
                    <li class="active"><a href="{{route('web.html.products')}}" data-toggle="tooltip" >Heat Lamps & Carving Boards</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Storage-Carts.jpg')}} width='80'>">Transport/Storage Carts</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Grills.jpg')}} width='80'>">Grills, Heater Stands & Coverups</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Coffee-Urns.jpg')}} width='80'>">Coffee Urns & Air Pot Coverups</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Juicers.jpg')}} width='80'>">Juicers</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Cold-Buffet.jpg')}} width='80'>">Cold Buffet & Wine</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Hollowware.jpg')}} width='80'>">Hollowware</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Serving-Utensils.jpg')}} width='80'>">Serving Utensils</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Flatware.jpg')}} width='80'>">Flatware & Tabletop</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Buffet-accessories.jpg')}} width='80'>">Buffet Accessories</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Trays.jpg')}} width='80'>">Trays</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="category-list text-center">
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h1.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Kenny Mack Resin</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h2.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Modern Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h3.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Adjustable Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h4.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Fusion Heat Lamps</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h5.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Tempo Heat Lamps</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h6.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Tower Heat Lamps</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h7.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Lamp Storage</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">

                            <img src="{{asset('assets/images/web/product/h8.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Tower Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">

                            <img src="{{asset('assets/images/web/product/h9.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Fancy Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">

                            <img src="{{asset('assets/images/web/product/h10.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Tempo Carving Stations</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">

                            <img src="{{asset('assets/images/web/product/h11.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Tower Carving Stations</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h12.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Fancy Carving Stations</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">

                            <img src="{{asset('assets/images/web/product/h13.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Modern Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h14.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3> Adjustable Heat Lamps </h3>
                        </div>

                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h15.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Fusion Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h16.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Tempo Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h17.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Tower Heat Lamps</h3>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-6 hero-feature">
                    <a href="{{route('web.html.products.detail')}}">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/web/product/h18.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h3>Fancy Heat Lamps</h3>
                        </div>
                    </a>

                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->
</div>



@stop
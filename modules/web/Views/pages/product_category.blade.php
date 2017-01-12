@extends('web::layouts.master')
@section('content')


    <!-- Page Features -->
<div class="row">
    <div class="col-md-4">
        <div class="sidebar-nav">
            <ul class="nav nav-stacked">
                <li><a href="#">Kenny Mack Resin</a></li>
                <li><a href="{{route('web.html.products')}}">Modern-Twist Silicone Placemats</a></li>
                <li><a href="{{route('web.html.products')}}">Fusion Buffet System & Risers</a></li>
                <li><a href="{{route('web.html.products')}}">Induction/Grill Chafers</a></li>
                <li><a href="{{route('web.html.products')}}">Chafers & Marmites</a></li>
                <li><a href="{{route('web.html.products')}}">Heat Lamps & Carving Boards</a></li>
                <li><a href="{{route('web.html.products')}}">Transport/Storage Carts</a></li>
                <li><a href="{{route('web.html.products')}}">Grills, Heater Stands & Coverups</a></li>
                <li><a href="{{route('web.html.products')}}">Coffee Urns & Air Pot Coverups</a></li>
                <li><a href="{{route('web.html.products')}}">Juicers</a></li>
                <li><a href="{{route('web.html.products')}}">Cold Buffet & Wine</a></li>
                <li><a href="{{route('web.html.products')}}">Hollowware</a></li>
                <li><a href="{{route('web.html.products')}}">Serving Utensils</a></li>
                <li><a href="{{route('web.html.products')}}">Flatware & Tabletop</a></li>
                <li><a href="{{route('web.html.products')}}">Buffet Accessories</a></li>
                <li><a href="{{route('web.html.products')}}">Trays</a></li>

            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="category-list text-center">
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Kenny-Mack.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Kenny Mack Resin</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Modern-Twist.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Modern-Twist Silicone Placemats</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Fusion-Buffet.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Fusion Buffet System & Risers</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Grill-Chafers.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Induction/Grill Chafers</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Chafers-Marmites.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Chafers & Marmites</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Heat-Lamps.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Heat Lamps & Carving Boards</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Storage-Carts.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Transport/Storage Carts</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">

                        <img src="{{asset('assets/images/web/category/Grills.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Grills, Heater Stands & Coverups</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">

                        <img src="{{asset('assets/images/web/category/Coffee-Urns.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Coffee Urns & Air Pot Coverups</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">

                        <img src="{{asset('assets/images/web/category/Juicers.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Juicers</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">

                        <img src="{{asset('assets/images/web/category/Cold-Buffet.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Cold Buffet & Wine</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Hollowware.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Hollowware</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">

                        <img src="{{asset('assets/images/web/category/Serving-Utensils.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Serving Utensils</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Flatware.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Flatware & Tabletop</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Buffet-accessories.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Buffet Accessories</h3>
                    </div>
                </a>

            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <a href="{{route('web.html.products')}}">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/web/category/Trays.jpg')}}" alt="" class="img-responsive">
                    </div>
                    <div class="caption">
                        <h3>Trays</h3>
                    </div>
                </a>

            </div>

        </div>
    </div>
</div>
<!-- /.row -->


@stop
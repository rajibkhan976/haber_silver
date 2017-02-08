@extends('web::layouts.master')

<div class="container-fluid">
    <div class="row">
        <div class="category-top-bar">
            <div class="container">
                <div class="col-md-6"></div><div class="col-md-5"><h2>Product Details</h2></div><div class="col-md-1"><h2><i class="fa fa-align-justify" aria-hidden="true"></i> <i class="fa fa-th-large" aria-hidden="true"></i></h2></div>
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
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Kenny-Mack.jpg')}}' width='80'>">Kenny Mack Resin</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Modern-Twist.jpg')}}' width='80'>">Modern-Twist Silicone Placemats</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Fusion-Buffet.jpg')}}' width='80'>">Fusion Buffet System & Risers</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Grill-Chafers.jpg')}}' width='80'>">Induction/Grill Chafers</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Chafers-Marmites.jpg')}}' width='80'>">Chafers & Marmites</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Heat-Lamps.jpg')}}' width='80'>">Heat Lamps & Carving Boards</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Storage-Carts.jpg')}}' width='80'>">Transport/Storage Carts</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Grills.jpg')}}' width='80'>">Grills, Heater Stands & Coverups</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Coffee-Urns.jpg')}}' width='80'>">Coffee Urns & Air Pot Coverups</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Juicers.jpg')}}' width='80'>">Juicers</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Cold-Buffet.jpg')}}' width='80'>">Cold Buffet & Wine</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Hollowware.jpg')}}' width='80'>">Hollowware</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Serving-Utensils.jpg')}}' width='80'>">Serving Utensils</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Flatware.jpg')}}' width='80'>">Flatware & Tabletop</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Buffet-accessories.jpg')}}' width='80'>">Buffet Accessories</a></li>
                    <li><a href="{{route('web.html.products')}}" data-toggle="tooltip" data-original-title="<img src='{{asset('assets/images/web/category/Trays.jpg')}}' width='80'>">Trays</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="product-details">
                    <div class="col-md-12 col-sm-6">
                        <div id="slider">
                            <!-- Top part of the slider -->
                            <div class="row">
                                <div class="col-sm-12" id="carousel-bounding-box">
                                    <div class="carousel slide carousel-fade product-slider" id="myCarousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <div class="active item" data-slide-number="0">
                                                <a href="{{asset('assets/images/web/product/p-big-01.jpg')}}" data-lightbox="product-details">
                                                    <img  src="{{asset('assets/images/web/product/p-big-01.jpg')}}"  class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="item" data-slide-number="1">
                                                <a href="{{asset('assets/images/web/product/p-big-02.jpg')}}" data-lightbox="product-details">
                                                    <img src="{{asset('assets/images/web/product/p-big-02.jpg')}}" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="item" data-slide-number="2">
                                                <a href="{{asset('assets/images/web/product/p-big-03.jpg')}}" data-lightbox="product-details">
                                                    <img src="{{asset('assets/images/web/product/p-big-03.jpg')}}" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="item" data-slide-number="3">
                                                <a href="{{asset('assets/images/web/product/p-big-02.jpg')}}" data-lightbox="product-details">
                                                    <img src="{{asset('assets/images/web/product/p-big-04.jpg')}}" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="item" data-slide-number="4">
                                                <a href="{{asset('assets/images/web/product/p-big-05.jpg')}}" data-lightbox="product-details">
                                                    <img src="{{asset('assets/images/web/product/p-big-05.jpg')}}" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/Slider-->
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="product-details-thumb">
                                <li>
                                    <a id="carousel-selector-0"><img src="{{asset('assets/images/web/product/p-big-01.jpg')}}" class="img-responsive"></a>
                                </li>
                                <li>
                                    <a  id="carousel-selector-1"><img src="{{asset('assets/images/web/product/p-big-02.jpg')}}" class="img-responsive"></a>
                                </li>
                                <li>
                                    <a  id="carousel-selector-2"><img src="{{asset('assets/images/web/product/p-big-03.jpg')}}" class="img-responsive"></a>
                                </li>
                                <li>
                                    <a id="carousel-selector-3"><img src="{{asset('assets/images/web/product/p-big-04.jpg')}}" class="img-responsive"></a>
                                </li>
                                <li>
                                    <a id="carousel-selector-4"><img src="{{asset('assets/images/web/product/p-big-05.jpg')}}" class="img-responsive"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="details-info">
                    <div class="col-md-12 details-title">
                        <span class="pull-left">
                           <h2>Fancy Heat Lamps</h2>
                        </span>
                        <span class="pull-right">
                           <h2>0499P31B</h2>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h3>Information:</h3>
                        <p>
                            PORTABLE HEAT LAMP, FANCY SINGLE HEAD BRASS<br>
                            Available in Single and Two-Head styles
                            Available in Stainless Steel & Silver Plate
                            Available in U.S. 120 volt and both Euro & UK 240 volt designs
                            (contact factory for 240v pricing)
                        </p>
                        <button class="btn btn-default">add to Cart</button>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <h3>Dimensions:</h3>
                        <p>
                            Ctn Wt: 24 lbs, Ctn Size: 44 x 18 x 10"<br>
                            Wt: 11 lbs, 18 x 7 1/2 x 27"h<br>
                            Pkg: 2 pc/ctn
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="pro-details-list">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>&nbsp</th>
                            <th>Part</th>
                            <th>Finish</th>
                            <th>Description</th>
                            <th>Quote Cart</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="row"><img src="{{asset('assets/images/web/product/p-big-03.jpg')}}" width="40" class="img-responsive"></td>
                            <td>0499MRSS</td>
                            <td>Stainless</td>
                            <td>Portable Heat Lamp, Modern+Round Shade</td>
                            <td> <button class="btn btn-default">add to Cart</button></td>
                        </tr>
                        <tr>
                            <td scope="row"><img src="{{asset('assets/images/web/product/p-big-02.jpg')}}" width="40" class="img-responsive"></td>
                            <td>0499MRSS</td>
                            <td>Stainless</td>
                            <td>Portable Heat Lamp, Modern+Round Shade</td>
                            <td> <button class="btn btn-default">add to Cart</button></td>
                        </tr>
                        <tr>
                            <td scope="row"><img src="{{asset('assets/images/web/product/p-big-01.jpg')}}" width="40" class="img-responsive"></td>
                            <td>0499MRSS</td>
                            <td>Stainless</td>
                            <td>Portable Heat Lamp, Modern+Round Shade</td>
                            <td> <button class="btn btn-default">add to Cart</button></td>
                        </tr>
                        <tr>
                            <td scope="row"><img src="{{asset('assets/images/web/product/p-big-04.jpg')}}" width="40" class="img-responsive"></td>
                            <td>0499MRSS</td>
                            <td>Stainless</td>
                            <td>Portable Heat Lamp, Modern+Round Shade</td>
                            <td> <button class="btn btn-default">add to Cart</button></td>
                        </tr>
                        <tr>
                            <td scope="row"><img src="{{asset('assets/images/web/product/p-big-05.jpg')}}" width="40" class="img-responsive"></td>
                            <td>0499MRSS</td>
                            <td>Stainless</td>
                            <td>Portable Heat Lamp, Modern+Round Shade</td>
                            <td> <button class="btn btn-default">add to Cart</button></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="pro-details-button">
                    <div class="col-md-12 details-title">
                        <span class="pull-left">
                           <h2><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Product Info </h2>
                        </span>
                        <span class="pull-right">
                           <h2><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Catalog</h2>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="related-product text-center">
                    <h2>RELATED PRODUCTS</h2>
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
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>



@stop

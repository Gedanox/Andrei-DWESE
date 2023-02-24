@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="{{ url('assets/js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/jquery-2.2.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/active.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/classy-nav.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/map-active.js') }}"></script>
@endsection

@section('navItems')
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="{{ url('index') }}">Shop</a></li>
            <li class="active"><a href="#">Product</a></li>
            <li><a href="{{ url('index/create') }}">Create</a></li>
            <li><a href="#">Checkout</a></li>
        </ul>
    </nav>
@endsection

@section('content')
	<!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                    <img class="d-block w-100" src="../{{ $items->photo }}" alt="First slide">
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(../{{ $items->photo }});">
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">{{ $items->price }}€</p>
                                <a href="#">
                                    <h6>{{ $items->name }}</h6>
                                </a>
                                <!-- Avaiable -->
                                <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                            </div>

                            <div class="short_overview my-5">
                                <p>{{ $items->description }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Product Details Area End -->
@endsection
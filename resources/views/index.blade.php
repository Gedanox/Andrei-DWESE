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
            <li><a href="index.html">Home</a></li>
            <li class="active"><a href="{{ url('index') }}">Shop</a></li>
            <li><a href="product-details.html">Product</a></li>
            <li><a href="cart.html">Cart</a></li>
            <li><a href="checkout.html">Checkout</a></li>
        </ul>
    </nav>
@endsection

@section('subirfoto')
	<body>
		<form action="{{ url('upload') }}" enctype="multipart/form-data" method="post">
	        @csrf
	        <input type="file" name="file" id="file"/>
	        <input type="submit" value="Submit"/>
	    </form>
	</body>

@endsection

@section('content')
    <div class="row" style="margin-top: 8px;">
        <table class="table table-striped table-responsive" id="yachtTable">
            
            <tbody>
                @foreach($items as $item)
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="forceimage">
                                    <img src="{{ url($item->photo) }}" class="forceimage" alt="">
                                </div>
    
                                <!-- Product Description -->
                                <div class="product-description d-flex align-items-center justify-content-between">
                                    <!-- Product Meta Data -->
                                    <div class="product-meta-data">
                                        <div class="line"></div>
                                        <p class="product-price">{{ $item->price }}€</p>
                                        <a href="{{ url('index/' . $item->id) }}">
                                            <h6>{{ $item->name }}</h6>
                                        </a>
                                    </div>
                                    <!-- Ratings & Cart -->
                                    <div class="ratings-cart text-right">
                                        <div class="cart">
                                            <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="{{ url('assets/img/cart.png') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </tbody>
        </table>
        <div id="row">
            <ul id="pagination" class="pagination">
                
            </ul>
        </div>
    </div>
@endsection

@section('test1')
    <!-- Single Product Area -->
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ url('assets/img/product1.jpg') }}" alt="">
                                <!-- Hover Thumb -->
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">$180</p>
                                    <a href="product-details.html">
                                        <h6>Modern Chair</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="cart">
                                        <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="{{ url('assets/img/cart.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('category')
    <!-- ##### Single Widget ##### -->
    <div class="widget brands mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Brands</h6>
    
        <div class="widget-desc">
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="amado">
                <label class="form-check-label" for="amado">Amado</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="ikea">
                <label class="form-check-label" for="ikea">Ikea</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="furniture">
                <label class="form-check-label" for="furniture">Furniture Inc</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="factory">
                <label class="form-check-label" for="factory">The factory</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="artdeco">
                <label class="form-check-label" for="artdeco">Artdeco</label>
            </div>
        </div>
    </div>
@endsection

@section('price')
    <!-- ##### Single Widget ##### -->
    <div class="widget price mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Price</h6>
    
        <div class="widget-desc">
            <div class="slider-range">
                <div data-min="10" data-max="1000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="10" data-value-max="1000" data-label-result="">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                </div>
                <div class="range-price">$10 - $1000</div>
            </div>
        </div>
    </div>
@endsection

@section('sorting')
    <!-- Sorting -->
    <div class="product-sorting d-flex">
        <div class="sort-by-date d-flex align-items-center mr-15">
            <p>Sort by</p>&nbsp;&nbsp;
                    <a href="{{ $order['price']['asc'] }}">Price Asc</a> &nbsp;&nbsp;
                    <a href="{{ $order['price']['desc'] }}">Price Desc</a> &nbsp;&nbsp;
                    <a href="{{ $order['name']['asc'] }}">Name Asc</a>&nbsp;&nbsp;
                    <a href="{{ $order['name']['desc'] }}">Name Desc</a>&nbsp;&nbsp;
                    <a href="{{ $order['created_at']['desc'] }}">New</a>&nbsp;&nbsp;
                    <a href="{{ $order['created_at']['asc'] }}">Old</a>&nbsp;&nbsp;
        </div>
    </div>
@endsection

@section('category4')

@endsection
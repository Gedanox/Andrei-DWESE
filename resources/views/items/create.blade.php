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
            <li><a href="{{ url('index') }}">Shop</a></li>
            <li><a href="#">Product</a></li>
            <li class="active"><a href="#">Create</a></li>
            <li><a href="checkout.html">Checkout</a></li>
        </ul>
    </nav>
@endsection

@section('content')
	<!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container">

                <form action="{{ url('index') }}" method="post" enctype="multipart/form-data">
			      @csrf
			      <div>
			        <label for="category">Category</label><br>
			        <select name="category" id="category" required>
			          <option value="1">Trousers</option>
			          <option value="2">Shirts</option>
			          <option value="3">Jeans</option>
			          <option value="4">Jacket</option>
			          <option value="5">Accessories</option>
			        </select>
			      </div>
			      <br><br>
			      <div>
			        <label for="name">Name</label>
			        <input required type="text" id="name" placeholder="Enter name" name="name">
			      </div>
			      <div >
			        <label style="width: 100%;" for="photo">Photo</label>
			        <input required style="display: block; margin-left: 0;" type="file" accept="image/jpeg" id="photo" name="photo">
			      </div>
			      <br>
			      <div>
			        <label for="description">Description</label>
			        <input required type="text" id="description" placeholder="Enter description" name="description">
			      </div>
			      <div>
			        <label for="price">Price</label>
			        <input required type="number" step="0.01" id="price" placeholder="Price" name="price">
			      </div>
			      <br>
			      <button type="submit" class="btn btn-primary mr-3 mt-2">Create</button>
			      <a class="btn btn-primary px-3 mt-2" href="{{ url('index') }}">Back</a>
			    </form>
            </div>
        </div>
    <!-- Product Details Area End -->
@endsection
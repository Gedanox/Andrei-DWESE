@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="{{ url('assets/js/ajax.js') }}"></script>
@endsection

@section('navItems')
    <nav class="navbar bg-dark navbar-expand-lg navbar-dark fixed-top navbar-sparrow">
      <div class="container"><h3 class="text-white">Andrei's</h3>
        <div class="collapse navbar-collapse" id="navbarNavDropdown1">
          <ul class="navbar-nav ms-auto">
          </ul>
        </div>
      </div>
    </nav>
@endsection

@section('content')
    <div class="container px-4">
        <div class="row" >
            <div class="col-lg-8 pe-lg-6">
              <div class="row">
                <div class="col-12">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb font-sans-serif py-2 my-1">
                      <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Shop</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Shirts
                      </li>
                    </ol>
                  </nav>
                  <h1 class="fs-3 mb-2">{{ $item->name }}</h1>
                  <div class="stars d-inline-block">
                    <span class="fas fa-star"></span
                    ><span class="fas fa-star"></span
                    ><span class="fas fa-star"></span
                    ><span class="fa-layers fa-fw"
                      ><i class="fas fa-star-half"></i
                      ><i
                        class="far fa-star-half"
                        data-fa-transform="flip-h"
                      ></i></span
                    ><span class="far fa-star"></span>
                  </div>
                  <a
                    class="d-inline-block ms-2 text-600 font-sans-serif"
                    href="#!"
                    >125 customer review</a
                  >
                </div>
                <div class="col-12 mt-4">
                  <img
                    class="rounded img-fluid"
                    src="{{ $item->photo }}"
                    alt=""
                  />
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="sticky-top py-6 py-lg-8">
                <div
                  class="badge border text-danger border-danger font-sans-serif"
                >
                  <span class="fas fa-star me-1"></span>Best Seller
                </div>
                <h2 class="fw-normal">
                  {{ $item->price }}€&nbsp;<del class="text-500 fw-light fs-2">free?</del>
                </h2>
                <h6 class="mt-4">Product details</h6>
                <p class="text-600">
                  {{ $item->description }}
                </p>
                <h6 class="mt-4">Material &amp; Care</h6>
                <p>Lyocell<br />Machine-wash</p>
                <h6 class="mt-4">Select size</h6>
                <div class="d-flex align-items-center mb-4 me-3">
                  <div class="d-sm-flex align-items-center me-3">
                    <label class="me-2 mb-0">Sizes</label
                    ><select class="form-select font-sans-serif">
                      <option>xs</option>
                      <option>s</option>
                      <option>m</option>
                      <option>l</option>
                      <option>xl</option>
                    </select>
                  </div>
                  <div class="d-sm-flex align-items-center ms-3">
                    <label class="me-2 mb-0">Quantity</label
                    ><select class="form-select font-sans-serif">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>
                  </div>
                </div>
                <div class="d-grid">
                  <a class="btn btn-dark" href="../pages/cart.html"
                    >add to cart</a
                  >
                </div>
                <a class="fs--1 text-900 d-block mt-4" href="#!">size guide</a
                ><a class="fs--1 text-900 d-block" href="#!"
                  >delivery &amp; returns</a
                >
              </div>
            </div>
          </div>
    </div>
@endsection

@section('modalContent')
    <div class="modal fade container" id="modalShow" tabindex="-1" role="dialog" aria-hidden="true">
        
    </div>
@endsection
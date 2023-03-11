@extends('layouts.app')

@section('content')
<div class="container px-4">
      <div class="row" >
        <div class="col-lg-8 pe-lg-6">
          <div class="row">
            <div class="col-12">
              <h1 class="fs-3 mb-2">{{ $review->title }}</h1>
            </div>
            <div class="col-12 mt-4">
              
              		@foreach($review->images as $image)
              			<img class="card-img-top" src="{{$image->imageroute}}" alt="Card image cap">
              		@endforeach
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sticky-top py-6 py-lg-8">
            <h2 class="fw-normal">
              {{ $review->review }}
              <br>
		        <div class="row mt25 mb25 justify-content-between">
                        <a class="btn-black btn" href="{{ url('review/'. $review->id . '/edit') }}">Edit</a>
				    <form method="POST" action="{{ url('review/'. $review->id) }}">
				        @method('delete')
				        @csrf
				        <input type="submit" class="btn-danger btn" value="DELETE POST"/>
				    </form>
		        </div>
            </h2>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
@endsection
@extends('layouts.app')

@section('content')
		<div class="col">
				<a class="btn-dark btn" style="text-decoration:none; color:white;" href="{{ url('review/book') }}">Books</a>
				<a class="btn-dark btn" style="text-decoration:none; color:white;" href="{{ url('review/film') }}">Films</a>
				<a class="btn-dark btn" style="text-decoration:none; color:white;" href="{{ url('review/record') }}">Records</a>
		</div><br>
		<div class="row">
		@foreach($reviews as $review)
			<div class="col-md-4">
              <div class="card">
              	<a class="overflow-hidden" href="{{ url('review/'.$review->id) }}">
              		@foreach($review->images as $image)
              			<img class="card-img-top" src="{{$image->imageroute}}" alt="Card image cap">
              		@endforeach
			    </a>
                <div class="card-body"><a class="text-1000" href="{{ url('review/'.$review->id) }}">
                    <h5 class="card-title">{{ $review->title }}</h5>
                  </a>
                </div>
                <div class="card-footer d-flex align-items-center">
                  <div class="font-sans-serif">
                      <h6 class="mb-0">{{ $review->user->name }} - {{ $review->type }}</h6>
                  </div>
                </div>
              </div>
            </div>
		@endforeach
		</div>
		<div><br><br>
		@if(Auth::user())
			<a class="btn-dark btn" style="text-decoration:none; color:white;" href="{{ url('review/create') }}">Create Review</a>
		@endif
		</div>
@endsection

@section('scripts')
    
@endsection
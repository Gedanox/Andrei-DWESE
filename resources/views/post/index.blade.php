@extends('layouts.app')

@section('content')
		<div class="col"><br>
		@if(Auth::user())
			<a class="btn-dark btn" style="text-decoration:none; color:white;" href="{{ url('post/create') }}">Create Post</a>
		@endif
		</div><br>
		<div class="row">
		@foreach($posts as $post)
			<div class="col-md-12 mt-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex py-2" style="display: inline-block;">
                    <div class="font-sans-serif text-start">
                        <h6 class="mb-0">{{ $post->user->name }}</h6><span class="fs--1 text-1000">{{ $post->created_at }}</span></div>
                 	</div>
			        <div class="row mt25 mb25 justify-content-between">
	                    
	  				    <form method="POST" action="{{ url('post/'. $post->id) }}">
	  				        @method('delete')
	  				        @csrf
	  				        <input style="width:20%; float:right;" type="submit" class="btn-danger btn" value="DELETE POST"/>
	  				        <a style="width:20%; float:right;"class="btn-black btn" href="{{ url('post/'. $post->id . '/edit') }}">Edit</a>
	  				    </form>
			        </div>
                </div>
                <div class="card-body text-start"><a class="text-1000" href="{{ url('post/'.$post->id) }}">
                    <h5 class="card-title">{{ $post->title }}</h5>
                  </a>
                  <p class="card-text text-1000 font-sans-serif">{{ $post->message }}</p>
                </div>
                </div>
            </div>
		@endforeach
		</div>
		<div><br><br>
		</div>
@endsection

@section('scripts')
    
@endsection
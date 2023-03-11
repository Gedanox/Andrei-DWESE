@extends('layouts.app')

@section('content')<br>
		@if(Auth::user())
		@endif
			<div class="col-md-12 mt-12"><br>
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
	  	        <a style="width:20%; float:right;"class="btn-black btn" href="{{ url('post/'. $post->id . '/edit') }}">Edit post</a>
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
      <div class="container">
      <div class="container">
      <div class="container">
      @foreach($post->comments as $comment)
        <div class="col-md-12 mt-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex py-2" style="display: inline-block;">
              <div class="font-sans-serif text-start">
                  <h6 class="mb-0">{{ $comment->user->name }}</h6><span class="fs--1 text-1000">{{ $comment->created_at }}</span></div>
           	</div>
			  <div class="row mt25 mb25 justify-content-between">
	              
	  	    <form method="POST" action="{{ url('comment/'. $comment->id) }}">
	  	        @method('delete')
	  	        @csrf
	  	        <input style="width:25%; float:right;" type="submit" class="btn-danger btn" value="DELETE COMMENT"/>
	  	    </form>
			  </div>
          </div>
          <div class="card-body text-start"><a class="text-1000" href="{{ url('comment/'.$comment->id) }}">
            </a>
            <p class="card-text text-1000 font-sans-serif">{{ $comment->message }}</p>
          </div>
          </div>
      </div>
      @endforeach
      </div>
      </div>
      </div>    <form action="{{ url('comment') }}" enctype="multipart/form-data" method="post" id="comment">
        @csrf
        <div class="form-group">
            <label for="nombre">Message</label>
            <input value="{{ old('message')}}" required type="textarea" maxlength="100" class="form-control" id="name" name="message" placeholder="message">
            <input type="hidden" value= "{{ $post->id }}" name="idpost"/>
        </div><br>
        <button type="submit" class="btn btn-primary">Create</button>
        &nbsp;
        <a href="{{ url('post') }}" class="btn btn-primary">Back</a>
    </form>
@endsection

@section('scripts')
@endsection
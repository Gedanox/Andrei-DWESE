@extends('layouts.app')

@section('content')
<div>
    <form action="{{ url('post') }}" enctype="multipart/form-data" method="post" id="post">
        @csrf
        <div class="form-group">
            <label for="nombre">Title</label>
            <input value="{{ old('title', $post->title)}}"  required type="text" minlength="3" maxlength="100" class="form-control" id="name" name="title" placeholder="title">
            <label for="nombre">Message</label>
            <input value="{{ old('message', $post->message)}}" required type="textarea" maxlength="100" class="form-control" id="name" name="message" placeholder="message">
        </div><br>
        <button type="submit" class="btn btn-primary">Create</button>
        &nbsp;
        <a href="{{ url('post') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection

@section('scripts')
@endsection

@extends('layouts.app')

@section('content')
<div>
    <form action="{{ url('comment') }}" enctype="multipart/form-data" method="post" id="comment">
        @csrf
        <div class="form-group">
            <label for="nombre">Message</label>
            <input value="{{ old('message')}}" required type="textarea" maxlength="100" class="form-control" id="name" name="message" placeholder="message">
        </div><br>
        <button type="submit" class="btn btn-primary">Create</button>
        &nbsp;
        <a href="{{ url('post') }}" class="btn btn-primary">Back</a>
    </form>
@endsection
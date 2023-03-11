@extends('layouts.app')

@section('content')
<div>
    <form action="{{ url('review') }}" enctype="multipart/form-data" method="post" id="review">
        @csrf
        <div class="form-group">
            <label for="nombre">Type</label><br>
            <select name="type" id="type" form="review" class="form-control">
                <option name="type" id="book" value="Book">Book</option>
                <option name="type" id="film" value="film">Film</option>
                <option name="type" id="record" value="Record">Record</option>
            </select>
            <label for="nombre">Title</label>
            <input value="{{ old('title')}}"  required type="text" minlength="3" maxlength="100" class="form-control" id="name" name="title" placeholder="title">
            <label for="nombre">Review</label>
            <input value="{{ old('review')}}" required type="textarea" maxlength="100" class="form-control" id="name" name="review" placeholder="review">
            <label for="image">image</label><br>
            <input id="image" name="image" type="file" class="form-control" accept="image/jpeg image/png" required>
        </div><br>
        <button type="submit" class="btn btn-primary">Create</button>
        &nbsp;
        <a href="{{ url('review') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection
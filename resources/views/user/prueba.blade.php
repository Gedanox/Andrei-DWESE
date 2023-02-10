@extends('layouts.app')

@section('content')
    <div>
    <form action="{{ url('home/prueba2') }}" method="get">
        <div class="form-group">
            <label for="name">User name</label>
            <input value="{{ old('name') }}" required type="text" minlength="2" maxlength="100" class="form-control" id="nombre" name="name" placeholder="User name">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_confirmation">User name</label>
            <input value="{{ old('name_confirmation') }}" required type="text" minlength="2" maxlength="100" class="form-control" id="nombre_confirmation" name="name_confirmation" placeholder="User name">
            @error('name_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        &nbsp;
        <a href="{{ url('admin') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection
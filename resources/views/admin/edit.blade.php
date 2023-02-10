@extends('layouts.app')

@section('content')
    <div>
    <form action="{{ url('admin/' . $user->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">User name</label>
            <input value="{{ old('name', $user->name) }}" required type="text" minlength="2" maxlength="100" class="form-control" id="nombre" name="name" placeholder="User name">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">User email</label>
            <input value="{{ old('email', $user->email) }}" required type="text" minlength="2" maxlength="100" class="form-control" id="email" name="email" placeholder="User email">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">User password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="User password" >
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        &nbsp;
        <a href="{{ url('admin') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection
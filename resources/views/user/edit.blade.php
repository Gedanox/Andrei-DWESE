@extends('layouts.app')

@section('content')
    <div>
    <form action="{{ url('home/update') }}" method="post">
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
            <input value="{{ old('email', $user->email) }}" required type="email" minlength="2" maxlength="100" class="form-control" id="email" name="email" placeholder="User email">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="old_password">Old password</label>
            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password" >
            @error('old_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">New password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="New password" >
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation" >
            @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        &nbsp;
        <a href="{{ url('admin') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <br>
                    @if (Auth::user()->isAdmin())
                        You are admin.
                        <a href="{{ url('admin') }}">User Administration</a>
                    @endif
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
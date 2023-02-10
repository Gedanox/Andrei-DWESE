@extends('layouts.app')

@section('content')
This is a public page.

<br>

@if(Auth::guest())
Contenido para los usuarios visitante.
@endif

<br>

@auth
Contenido para los usuarios auth.

<br>

@if(Auth::user()->hasVerifiedEmail())
Contenido para los usuarios verificados.
@endif

@endauth

@endsection
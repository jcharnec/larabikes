@env(['local', 'test'])
    <x-local :mode="App::environment()"/>
@endenv

@php($pagina='portada')

@extends('layouts.master')

@section('titulo', 'Portada de Larabikes')

@section('login')

@endsection
@section('contenido')
<figure class="row mt-2 mb-2 col-10 offset-1">
    <img class="d-block w-100" alt="Moto de Caneda en Akira" src="{{asset('images/bikes/bike0.png')}}">
</figure>
@endsection

@section('enlaces')
@endsection
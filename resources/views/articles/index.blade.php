@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="float-left">Articulos</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <button class="btn btn-primary">Nuevo</button>
        </div>
    </div>

    @include('articles.list')
@endsection

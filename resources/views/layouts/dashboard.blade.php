@extends('layouts.internalApp')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="float-left">Menu Principal</h1>
        </div>
    </div>

    <div class="row mt-4">
        @can('users.list')
            <div class="col-12 col-md-4 ">
                <a class="aItemMenu" href="{{ route('users.index') }}">
                    <div class="card text-white bg-primary mb-3 menuCard">
                        <div class="card-body" style="display: flex">
                            <div class="col">
                                <h4 class="card-title">Usuarios</h4>
                            </div>
                            <div class="ml-2 icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        <div class="col-12 col-md-4 ">
            <a class="aItemMenu" href="{{ route('roles.index') }}">
                <div class="card text-white bg-primary mb-3 menuCard">
                    <div class="card-body" style="display: flex">
                        <div class="col">
                            <h4 class="card-title">Roles</h4>
                        </div>
                        <div class="ml-2 icon">
                            <i class="fas fa-cog"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        @can('articles.list')
            <div class="col-12 col-md-4 ">
                <a class="aItemMenu" href="{{ route('articles.index') }}">
                    <div class="card text-white bg-primary mb-3 menuCard">
                        <div class="card-body" style="display: flex">
                            <div class="col">
                                <h4 class="card-title">Articulos</h4>
                            </div>
                            <div class="ml-2 icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan



    </div>



@endsection

@extends('layouts.app')

@section('more-links')
    {{-- Datatables --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="float-left">Articulos</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Nuevo</button>
            @include('articles.form')
        </div>
    </div>

    @include('articles.list')
@endsection

@section('more-scripts')

    {{-- Datatables --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    {{-- My JS --}}
    <script>
        function init() {
            cargarTabla();
        }

        function cargarTabla() {
            $('#myTable').DataTable({
                "scrollX": true,
            });
        }

        init();
    </script>
@endsection

@extends('layouts.app')

@section('more-links')
    {{-- Datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection

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

@section('more-scripts')

    {{-- Datatables --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection

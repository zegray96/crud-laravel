@extends('layouts.app')

@section('more-links')
    {{-- Datatables --}}
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

    {{-- Script View --}}
    <script>
        function init() {
            loadTable();
        }

        // Al cerrar modal
        $('#modalForm').on('hidden.bs.modal', function() {
            // eliminamos los msj de errores
            $(".help-block").remove();
        });

        function loadTable() {
            $('#myTable').DataTable({
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoPostFix": "",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "loadingRecords": "Cargando...",
                    "lengthMenu": "Mostrar " +
                        `<select class="custom-select custom-select-sm form-control form-control-sm">
                            <option value='10'>10</option>
                            <option value='25'>25</option>
                            <option value='50'>50</option>
                            <option value='100'>100</option>
                            <option value='-1'>Todos</option>
                        </select>` +
                        " registros por página",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                },
                "scrollX": true,
                "ajax": "{{ route('articles.list') }}",
                "columns": [{
                        "data": 'buttons'
                    },
                    {
                        "data": 'description'
                    },
                    {
                        "data": 'price'
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            if (data == "ACTIVO") {
                                data = '<h5><span class="badge badge-success">' + data + '</span></h5>';
                            } else {
                                if (data == "INACTIVO") {
                                    data = '<h5><span class="badge badge-danger">' + data + '</span></h5>';
                                }
                            }
                            return data;
                        },

                    },
                ]
            });
        }

        init();
    </script>

@endsection

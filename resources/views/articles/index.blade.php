@extends('layouts.internalApp')

@section('more-links')
    {{-- Datatables --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="float-left">Articulos</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            @can('articles.create')
                <a href="{{ route('articles.create') }}" class="btn btn-primary"
                    onclick="event.preventDefault(); create(this.href)"> Nuevo
                </a>
            @endcan


            {{-- Modal Form --}}
            @include('layouts.modalForm')
            {{-- End Modal --}}
        </div>
    </div>

    @include('articles.list')
@endsection

@section('more-scripts')

    {{-- Datatables --}}
    <script type="text/javascript" src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/datatables/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/buttons.html5.min.js') }}"></script>


    {{-- Script View --}}
    <script>
        function init() {
            loadTable();
        }

        // Al cerrar modal
        $('#modalForm').on('hidden.bs.modal', function() {
            // eliminamos los msj de errores
            $(".invalid-feedback").remove();
            $(".is-invalid").removeClass("is-invalid")
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
                dom: 'Bflrtip', //definimos los elementos del control de la tabla
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [1, 3, 4]
                        },
                        text: '<i class="fas fa-file-excel"></i>',
                        className: 'btn btn-success',
                        titleAttr: 'Exportar a Excel',

                    },


                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [1, 3, 4]
                        },
                        text: '<i class="fa fa-file-csv"></i>',
                        className: 'btn btn-warning',
                        titleAttr: 'Exportar a CSV',

                    },


                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [1, 3, 4]
                        },
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-info',
                        titleAttr: 'Imprimir',

                    },



                ],
                "ajax": "{{ route('articles.list') }}",
                "columns": [{
                        "data": 'buttons'
                    },
                    {
                        "data": 'description'
                    },
                    {
                        "data": "image",
                        "render": function(data, type, row) {
                            if (data != null) {
                                data = '<img src="storage/articlesImages/' + data +
                                    '" style="width:100px">';
                            } else {
                                data = '<strong>SIN IMAGEN</strong>';
                            }

                            return data;
                        },

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
                ],
                "order": [
                    [1, "asc"]
                ]
            });
        }

        init();
    </script>

@endsection

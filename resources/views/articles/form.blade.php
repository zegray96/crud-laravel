@extends('layouts.modalForm')

@if (isset($article))
    @section('modalForm-title', 'Editar Articulo')
@else
    @section('modalForm-title', 'Nuevo Articulo')
@endif

@section('modalForm-content')
    <form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}"
        method="{{ isset($article) ? 'PUT' : 'POST' }}" autocomplete="off" id="formArticle">
        <div class="modal-body">
            <div class="form-group">
                <label>Descripcion</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Precio</label>
                    <input type="text" class="form-control" name="price">
                </div>
                <div class="form-group col-md-6">
                    <label>Estado</label>
                    <select class="custom-select" name="status">
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="sumbit" class="btn btn-primary" onclick="event.preventDefault(); store($('#formArticle'), $('#myTable'));">Guardar</button>
        </div>

    </form>

@endsection

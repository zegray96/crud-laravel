<form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}"
    method="{{ isset($article) ? 'PUT' : 'POST' }}" autocomplete="off" id="formArticle">
    <div class="modal-header">
        <h5 class="modal-title">{{isset($article) ? 'Editar Articulo' : 'Nuevo Articulo'}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Descripcion</label>
            <input type="text" class="form-control" name="description" value="{{ isset($article) ? $article->description : '' }}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Precio</label>
                <input type="text" class="form-control" name="price" value="{{ isset($article) ? $article->price : '' }}">
            </div>
            <div class="form-group col-md-6">
                <label>Estado</label>
                <select class="custom-select" name="status">
                    <option value="ACTIVO" {{isset($article) ? ($article->status == 'ACTIVO' ? 'selected' : '' ) : ''}}>ACTIVO</option>
                    <option value="INACTIVO" {{isset($article) ? ($article->status == 'INACTIVO' ? 'selected' : '' ) : ''}}>INACTIVO</option>
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="sumbit" class="btn btn-primary" onclick="event.preventDefault(); store($('#formArticle'), $('#myTable'));">Guardar</button>
    </div>

</form>

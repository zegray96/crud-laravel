<form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}" method="POST"
    autocomplete="off" id="formArticle" enctype="multipart/form-data">

    @if (isset($article))
        {{-- Usamos este input hidden ya que formData usada para enviar los datos con axios no acepta el metodo PUT/PATCH --}}
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ isset($article) ? 'Editar Articulo' : 'Nuevo Articulo' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Descripcion</label>
            <input type="text" class="form-control" name="description"
                value="{{ isset($article) ? $article->description : '' }}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Precio</label>
                <input type="text" class="form-control" name="price"
                    value="{{ isset($article) ? $article->price : '' }}">
            </div>
            <div class="form-group col-md-6">
                <label>Estado</label>
                <select class="selectpicker form-control" name="status" data-live-search="true">
                    <option value="ACTIVO"
                        {{ isset($article) ? ($article->status == 'ACTIVO' ? 'selected' : '') : '' }}>ACTIVO</option>
                    <option value="INACTIVO"
                        {{ isset($article) ? ($article->status == 'INACTIVO' ? 'selected' : '') : '' }}>INACTIVO
                    </option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="d-flex justify-content-center">
                    <img id="imagePreview" class="img-thumbnail" width="150px" height="150px"
                        {{ isset($article->image) ? "src=storage/articlesImages/$article->image" : '' }}>
                </div>

            </div>

            <div class="form-group col-md-6">
                <label for="image" class="form-label">Imagen</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="sumbit" class="btn btn-primary"
            onclick="event.preventDefault(); store($('#formArticle'), $('#myTable'));">Guardar</button>
    </div>

</form>

<script>
    // Colocamos el inicializador de selectpicker aca ya que el formulario se dibuja cada vez que llamamos a los botones nuevo o editar
    $('.selectpicker').selectpicker();

    // Image Preview
    $('#image').on('change', function() {
        loadImagePreview(this);
    });

    function loadImagePreview(input) {
        let reader = new FileReader();
        reader.onload = function(e) {
            // Asignamos el atributo src a la tag de imagen
            $('#imagePreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>

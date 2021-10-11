<form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST"
    autocomplete="off" id="formUser" enctype="multipart/form-data">

    @if (isset($user))
        {{-- Usamos este input hidden ya que formData usada para enviar los datos con axios no acepta el metodo PUT/PATCH --}}
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ isset($user) ? 'Editar Usuario' : 'Nuevo Usuario' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nombre</label>
                <input type="text" class="form-control" name="name"
                    value="{{ isset($user) ? $user->name : '' }}">
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="text" class="form-control" name="email"
                    value="{{ isset($user) ? $user->email : '' }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Contraseña</label>
                <input type="text" class="form-control" name="password">
            </div>
            <div class="form-group col-md-6">
                <label>Repita Contraseña</label>
                <input type="text" class="form-control" name="password_confirmation">
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="sumbit" class="btn btn-primary"
            onclick="event.preventDefault(); store($('#formUser'), $('#myTable'));">Guardar</button>
    </div>

</form>

<script>
    // Colocamos el inicializador de selectpicker aca ya que el formulario se dibuja cada vez que llamamos a los botones nuevo o editar
    $('.selectpicker').selectpicker();

</script>
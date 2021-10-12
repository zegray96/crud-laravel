<form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST"
    autocomplete="off" id="formRole">

    @if (isset($role))
        {{-- Usamos este input hidden ya que formData usada para enviar los datos con axios no acepta el metodo PUT/PATCH --}}
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ isset($role) ? 'Editar Rol' : 'Nuevo Rol' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" name="name" value="{{ isset($role) ? $role->name : '' }}">
        </div>

        <div class="form-group">
            <label>Permisos del rol</label>
            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$permission->id}}" {{isset($role) ? $role->permissions->contains($permission) ? 'checked' : '' : ''}}>
                    <label class="form-check-label">
                        {{$permission->description}}
                    </label>
                </div>
            @endforeach
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="sumbit" class="btn btn-primary"
            onclick="event.preventDefault(); store($('#formRole'), $('#myTable'));">Guardar</button>
    </div>

</form>

<script>
    // Colocamos el inicializador de selectpicker aca ya que el formulario se dibuja cada vez que llamamos a los botones nuevo o editar
    $('.selectpicker').selectpicker();
</script>

<a href="{{ route('roles.edit', $id) }}" onclick="event.preventDefault(); edit(this.href)"
    class="btn btn-success btn-sm">Editar</a>

<a href="{{ route('roles.destroy', $id) }}" onclick="event.preventDefault(); destroy(this.href, $('#myTable'))"
    class="btn btn-danger btn-sm">Eliminar</a>

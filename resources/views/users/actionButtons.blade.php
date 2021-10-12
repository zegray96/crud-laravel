@can('users.edit')
    <a href="{{ route('users.edit', $id) }}" onclick="event.preventDefault(); edit(this.href)"
        class="btn btn-success btn-sm">Editar</a>
@endcan

@can('users.delete')
    <a href="{{ route('users.destroy', $id) }}" onclick="event.preventDefault(); destroy(this.href, $('#myTable'))"
        class="btn btn-danger btn-sm">Eliminar</a>
@endcan

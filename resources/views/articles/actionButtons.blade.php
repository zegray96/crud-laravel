@can('articles.edit')
    <a href="{{ route('articles.edit', $id) }}" onclick="event.preventDefault(); edit(this.href)"
        class="btn btn-success btn-sm">Editar</a>
@endcan

@can('articles.delete')
    <a href="{{ route('articles.destroy', $id) }}" onclick="event.preventDefault(); destroy(this.href, $('#myTable'))"
        class="btn btn-danger btn-sm">Eliminar</a>
@endcan

<button type="button" class="btn btn-success btn-sm">Editar</button>
<a href="{{ route('articles.destroy', $id) }}" onclick="event.preventDefault(); destroy(this.href, $('#myTable'))" class="btn btn-danger btn-sm">Eliminar</a>

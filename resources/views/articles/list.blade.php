<table class="table" id="myTable">
    <thead>
        <tr>
            <th>Acción</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <tr>
                <th>
                    <button type="button" class="btn btn-success btn-sm">Editar</button>
                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                </th>
                <td>{{$article->description}}</td>
                <td>{{$article->price}}</td>
                <td>{{$article->stock}}</td>
                <td>{{$article->status}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table class="table table-responsive" id="insumos-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Descripción</th>
            <th colspan="3">Acción</th>
        </tr>
    </thead>
    <tbody>
    @foreach($insumos as $insumo)
        <tr>
            <td>{!! $insumo->nombre !!}</td>
            <td>{!! $insumo->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['insumos.destroy', $insumo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('insumos.show', [$insumo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('insumos.edit', [$insumo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
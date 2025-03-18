<h2>Informe de Ventas</h2>
<table>
    <tr>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Total</th>
    </tr>
    @foreach($ventas as $venta)
        <tr>
            <td>{{ $venta->client->name }}</td>
            <td>{{ $venta->created_at->format('Y-m-d') }}</td>
            <td>${{ number_format($venta->total, 2) }}</td>
        </tr>
    @endforeach
</table>
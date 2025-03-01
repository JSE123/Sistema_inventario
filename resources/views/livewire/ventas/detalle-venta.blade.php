
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Detalles de la Venta</h2>

    <!-- Información de la Venta -->
    <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <p><strong>Número de Venta:</strong> {{ $sale->id }}</p>
        <p><strong>Cliente:</strong> {{ $sale->client->name }}</p>
        <p><strong>Fecha:</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Total:</strong> ${{ number_format($sale->total, 2) }}</p>
    </div>

    <!-- Tabla de Productos Vendidos -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Producto</th>
                    <th class="p-3 text-center">Cantidad</th>
                    <th class="p-3 text-center">Precio Unitario</th>
                    <th class="p-3 text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->saleDetails as $detail)
                {{-- {{$detail}} --}}
                <tr class="border-b hover:bg-gray-100">
                    <td class="p-3">{{ $detail->product->name }}</td>
                    <td class="p-3 text-center">{{ $detail->quantity }}</td>
                    <td class="p-3 text-center">${{ number_format($detail->product->price, 2) }}</td>
                    <td class="p-3 text-center">${{ number_format($detail->sub_total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botón para regresar -->
    <div class="mt-4">
        <a href="{{ route('ventas.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Volver a Ventas
        </a>
    </div>
</div>

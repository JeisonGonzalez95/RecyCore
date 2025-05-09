@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Inventarios - Salidas</h2>
                </div>
                <a href="{{ route('inventaryOf') }}" class="btn btn-outline-primary"><i class="fa-solid fa-user-plus"></i> Sacar Producto</a>
            </div>

            <div class="table-responsive">
                <table id="tablaEmpleados" class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Mov N°</th>
                            <th>Provedor</th>
                            <th>Productos</th>
                            <th>Cantidad Total</th>
                            <th>Descripción</th>
                            <th>Fecha de salida</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moviments as $moviment)
                        <tr onclick="window.location='{{ route('descInvOut', ['id' => $moviment->id]) }}';"
                            style="cursor:pointer;">
                            <td>{{ $moviment->id }}</td>
                            <td>{{ $moviment->provider->name ?? 'Sin Proveedor' }}</td>
                            <td style="white-space: nowrap;">
                                <ul class="text-start m-0 p-0" style="list-style-position: inside;">
                                    @foreach ($moviment->products as $product)
                                        <li style="line-height: 1.2;">
                                            {{ $product->product->product_name ?? 'Producto desconocido' }}
                                            ({{ floatval(str_replace(',', '.', $product->amount_kg)) }} Kg)
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>${{ number_format($moviment->products->sum('price_product')) }}</td>
                            <td>{{ $moviment->description ?? 'Sin descripción' }}</td>
                            <td>{{ $moviment->date_out }}</td>
                            <td>{{ $moviment->employee->fullname ?? 'Sin usuario' }}</td>
                            <td>
                                <a href="{{ route('descFac', ['id' => $moviment->id, 'type' => 2]) }}"
                                    class="btn btn-outline-secondary" title="Imprimir factura">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
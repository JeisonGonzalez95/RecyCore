@extends('source.index')

@section('contentR')
    <div class="content-wrapper">
        <div class="card bg-glass shadow-sm">
            <div class="card-body px-4 py-5 px-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                        <h2 class="fw-bold mb-0">Inventarios - Entradas</h2>
                    </div>
                    {{-- <a href="{{ route('inventaryIf') }}" class="btn btn-outline-primary"><i class="fa-solid fa-user-plus"></i> Agregar Producto</a> --}}
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user-plus"></i> Agregar Producto
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('inventaryIf', ['tp' => 1]) }}">Recolector</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('inventaryIf', ['tp' => 2]) }}">Fuente</a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="tablaEmpleados"
                        class="table table-striped table-hover table-bordered text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Mov N°</th>
                                <th>Cliente</th>
                                <th>Productos</th>
                                <th>Costo Total</th>
                                <th>Descripción</th>
                                <th>Fecha de ingreso</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($moviments as $moviment)
                                <tr onclick="window.location='{{ route('descInvIn', ['id' => $moviment->id]) }}';"
                                    style="cursor:pointer;">
                                    <td>{{ $moviment->id }}</td>
                                    <td>{{ $moviment->client_data->name ?? 'Sin cliente' }}</td>
                                    <td style="white-space: nowrap;">
                                        <ul class="text-start m-0 p-0" style="list-style-position: inside;">
                                            @foreach ($moviment->products as $product)
                                                <li style="line-height: 1.2;">
                                                    {{ $product->product->product_name ?? 'Producto desconocido' }}
                                                    ({{ number_format(floatval(str_replace(',', '.', $product->amount_kg)) - floatval(str_replace(',', '.', $product->amount_dev_kg)), 2, ',', '') }}
                                                    Kg)
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>${{ number_format($moviment->products->sum('price_product')) }}</td>
                                    <td>{{ $moviment->description ?? 'Sin descripción' }}</td>
                                    <td>{{ $moviment->date_in }}</td>
                                    <td>{{ $moviment->employee->fullname ?? 'Sin usuario' }}</td>
                                    <td>
                                        <a href="{{ route('descFac', ['id' => $moviment->id]) }}"
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

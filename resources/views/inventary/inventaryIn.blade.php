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
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-plus"></i> Agregar Producto
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('inventaryIf', ['tp' => 1]) }}">Persona natural</a></li>
                        <li><a class="dropdown-item" href="{{ route('inventaryIf', ['tp' => 2]) }}">Empresa</a></li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive">
                <table id="tablaEmpleados" class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Mov N°</th>
                            <th>Productos</th>
                            <th>Costo Total</th>
                            <th>Descripción</th>
                            <th>Fecha de ingreso</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moviments as $moviment)
                        <tr>
                            <td>{{ $moviment->id }}</td>
                            <td>
                                <ul class="text-start">
                                    @if($moviment->products && $moviment->products->count())
                                    @foreach ($moviment->products as $product)
                                    <li>{{ $product->product->product_name ?? 'Producto desconocido' }} ({{ $product->amount_kg }} Kg)</li>
                                    @endforeach
                                    @else
                                    <li>Sin productos</li>
                                    @endif
                                </ul>
                            </td>
                            <td>
                                ${{ round($moviment->products->sum('price_product'), 2) }}
                            </td>
                            <td>{{ $moviment->description ?? 'Sin descripción' }}</td>
                            <td>{{ $moviment->date_in }}</td>
                            <td>{{ $moviment->employee->fullname ?? 'Sin usuario' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
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
                <a href="{{ route('registerEc') }}" class="btn btn-outline-primary"><i class="fa-solid fa-user-plus"></i> Agregar Producto</a>
            </div>

            <div class="table-responsive">
                <table id="tablaEmpleados" class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad (Kg)</th>
                            <th>Descripcion</th>
                            <th>Fecha de ingreso</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product->product_name }}</td>
                            <td>{{ $product->amount_kg }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->date_out }}</td>
                            <td>{{ $product->employee->fullname }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
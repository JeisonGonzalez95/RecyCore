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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="#" class="text-warning me-3" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="javascript:void(0);" class="text-danger btn-delete"  title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

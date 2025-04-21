@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Cargos</h2>
                </div>
                <a href="{{ route('registerP') }}" class="btn btn-outline-primary"><i class="fa-solid fa-user-plus"></i> Agregar Cargo</a>
            </div>
            <div class="table-responsive">
                <table id="tablaEmpleados" class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Nombre</th>
                            <th>Identificación</th>
                            <th>Area</th>
                            <th>Cargo</th>
                            <th>Rol</th>
                            <th>Jefe</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->employee->fullname }}</td>
                            <td>{{ $position->employee->dni }}</td>
                            <td>{{ $position->area->name_area }}</td>
                            <td>{{ $position->position->name_position }}</td>
                            <td>{{ $position->role->name_role }}</td>
                            <td>{{ $position->supervisor->fullname }}</td>
                            <td>
                                <a href="{{ route('positionsEdit', $position->id) }}" class="text-warning me-3" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="javascript:void(0);" class="text-danger btn-delete" data-url="{{ route('delete_pos', $position->id) }}" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
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
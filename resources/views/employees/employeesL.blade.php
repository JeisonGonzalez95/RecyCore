@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Empleados</h2>
                </div>
                <a href="{{ route('registerEc') }}" class="btn btn-outline-primary"><i class="fa-solid fa-user-plus"></i> Agregar Empleado</a>
            </div>

            <div class="table-responsive">
                <table id="tablaEmpleados" class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Nombre</th>
                            <th>Identificación</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Area</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->fullname }}</td>
                            <td>{{ $employee->dni }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->rol->name_role }}</td>
                            <td>{{ $employee->area->name_area }}</td>
                            @php
                            $dataItem = [
                            'id' => $employee->userApp->id ?? '',
                            'username' => $employee->userApp->username ?? ''
                            ];
                            @endphp

                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault{{ $employee->id }}" name="state_emp_e" value="1" data-url="{{ route('delete_e', ['id' => $employee->id]) }}" onchange="desactivarMenu(this)" {{ $employee->state == 1 ? 'checked' : '' }}>
                                    </div>
                                    <a href="{{ route('employeesEdit', $employee->id) }}" class="text-warning me-3" title="Editar Usuario">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <button type="button" class="btn btn-link text-danger me-3 p-0" title="Editar"
                                        popovertarget="empPsw" popovertargetaction="show"
                                        data-form="formUserE" data-user-id='@json($dataItem)' onclick="mostrarFormulario(this)">
                                        <i class="fa-solid fa-key"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="empPsw" popover class="popover-bootstrap">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-body">
                    @include('employees.userResetPsw')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
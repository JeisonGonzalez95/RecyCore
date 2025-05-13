@extends('source.index')

@section('contentR')
    <div class="content-wrapper">
        <div class="card bg-glass shadow-sm">
            <div class="card-body px-4 py-5 px-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                        <h2 class="fw-bold mb-0">Permisos</h2>
                    </div>
                </div>
                <div class="text-center mb-4">
                    <button popovertarget="licenceR" popovertargetaction="show" class="btn btn-outline-primary"
                        data-form="formLicenceR" onclick="mostrarFormulario(this)"><i class="fa-solid fa-user-plus"></i>
                        Agregar Permisos</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre Empleado</th>
                                <th>Menus</th>
                                <th>Items</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($licencesL as $licence)
                                <tr>
                                    <td>{{ $licence->id }}</td>
                                    <td>{{ $licence->users->fullname }}</td>
                                    <td>{{ $licence->menus_text }}</td>
                                    <td>{{ $licence->items_text }}</td>
                                    <td>{{ $licence->state == 1 ? 'Activo' : 'Inactivo' }}
                                    </td>
                                    @php
                                        $dataLicence = [
                                            'id' => $licence->id,
                                            'user' => $licence->id_user,
                                            'menus' => $licence->id_menus,
                                            'items' => $licence->id_items,
                                            'state' => $licence->state,
                                        ];
                                        $mai = 1;
                                    @endphp
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-link text-warning me-3 p-0" title="Editar"
                                                popovertarget="licenceE" popovertargetaction="show" data-form="formlicenceE"
                                                data-licence-id='@json($dataLicence)'
                                                onclick="mostrarFormulario(this)">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="switchCheckDefault{{ $licence->id }}" name="state_menu_e"
                                                    value="1"
                                                    data-url="{{ route('licenceD', ['id' => $licence->id]) }}"
                                                    onchange="desactivarMenu(this)"
                                                    {{ $licence->state == 1 ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div id="licenceR" popover class="popover-bootstrap">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content shadow">
                        <div class="modal-body">

                            @include('licences.licencesR')
                        </div>
                    </div>
                </div>
            </div>
            <div id="licenceE" popover class="popover-bootstrap">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content shadow">
                        <div class="modal-body">

                            @include('licences.licencesE')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

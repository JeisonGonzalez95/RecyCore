@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Provedores</h2>
                </div>
                <button popovertarget="providersR" popovertargetaction="show" class="btn btn-outline-primary" data-form="formProvR" onclick="mostrarFormulario(this)"><i class="fa-solid fa-user-plus"></i> Agregar Provedor</button>
            </div>
            <div class="table-responsive">
                <table id="tablaEmpleados" class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Item</th>
                            <th>Nombre</th>
                            <th>NIT</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Direccion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($providers as $provider)
                        <tr>
                            <td>{{ $provider->id }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->nit }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>{{ $provider->address }}</td>
                            <td>{{ $provider->state == 1 ? 'Activo' : 'Inactivo' }}</td>
                            @php
                            $dataProvider = [
                            'id' => $provider->id,
                            'name' => $provider->name,
                            'nit' => $provider->nit,
                            'phone' => $provider->phone,
                            'email' => $provider->email,
                            'address' => $provider->address,
                            'state' => $provider->state
                            ];
                            @endphp
                            <td>
                                <button type="button" class="btn btn-link text-warning me-3 p-0" title="Editar" popovertarget="providersE" popovertargetaction="show" data-form="formProviderE" data-provider-id='@json($dataProvider)' onclick="mostrarFormulario(this)">
                                    <i class="fa-solid fa-pen"></i>Editar
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div id="providersR" popover class="popover-bootstrap">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-body">
                                @include('providers.providersR')
                            </div>
                        </div>
                    </div>
                </div>
                <div id="providersE" popover class="popover-bootstrap">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-body">
                                @include('providers.providersE')
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Clientes</h2>
                </div>
                <button popovertarget="clientsR" popovertargetaction="show" class="btn btn-outline-primary" data-form="formProdR" onclick="mostrarFormulario(this)"><i class="fa-solid fa-user-plus"></i> Agregar Cliente</button>
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
                        @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->nit }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->state == 1 ? 'Activo' : 'Inactivo' }}</td>
                            @php
                            $dataClient = [
                            'id' => $client->id,
                            'name' => $client->name,
                            'nit' => $client->nit,
                            'phone' => $client->phone,
                            'email' => $client->email,
                            'address' => $client->address,
                            'state' => $client->state
                            ];
                            @endphp
                            <td>
                                <button type="button" class="btn btn-link text-warning me-3 p-0" title="Editar" popovertarget="clientE" popovertargetaction="show" data-form="formClientE" data-client-id='@json($dataClient)' onclick="mostrarFormulario(this)">
                                    <i class="fa-solid fa-pen"></i>Editar
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div id="clientsR" popover class="popover-bootstrap">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-body">
                                @include('clients.clientsR')
                            </div>
                        </div>
                    </div>
                </div>
                <div id="clientE" popover class="popover-bootstrap">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-body">
                                @include('clients.clientsE')
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
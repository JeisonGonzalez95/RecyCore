@extends('source.index')

@section('contentR')
    <div class="content-wrapper">
        <div class="card bg-glass shadow-sm">
            <div class="card-body px-4 py-5 px-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                        <h2 class="fw-bold mb-0">Recolectores</h2>
                    </div>
                    <button popovertarget="collectorsR" popovertargetaction="show" class="btn btn-outline-primary"
                        data-form="formProdR" onclick="mostrarFormulario(this)"><i class="fa-solid fa-user-plus"></i>
                        Agregar Recoletor</button>
                </div>
                <div class="table-responsive">
                    <table id="tablaEmpleados"
                        class="table table-striped table-hover table-bordered text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Id Recolector</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Direccion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collectors as $collector)
                                <tr>
                                    <td>{{ $collector->id }}</td>
                                    <td>{{ $collector->name }}</td>
                                    <td>
                                        <b>{{ $collector->type->code }}:</b> {{ $collector->dni }} <br>
                                        País: {{ $countryNames[$collector->country] ?? 'Desconocido' }}
                                    </td>
                                    <td>{{ $collector->phone ?: 'No tiene Teléfono' }}</td>
                                    <td>{{ $collector->email ?: 'No tiene Correo' }}</td>
                                    <td>{{ $collector->address ?: 'No tiene Dirección' }}</td>
                                    <td>{{ $collector->state ? 'Activo' : 'Inactivo' }}</td>

                                    @php
                                        $dataCollector = [
                                            'id' => $collector->id,
                                            'name' => $collector->name,
                                            'type_dni' => $collector->type_dni,
                                            'dni' => $collector->dni,
                                            'country' => $collector->country,
                                            'phone' => $collector->phone,
                                            'email' => $collector->email,
                                            'address' => $collector->address,
                                            'state' => $collector->state,
                                        ];
                                    @endphp

                                    <td>
                                        <button type="button" class="btn btn-link text-warning me-3 p-0" title="Editar"
                                            popovertarget="collectorE" popovertargetaction="show" data-form="formCollectorE"
                                            data-collector-id='@json($dataCollector)'
                                            onclick="mostrarFormulario(this)">
                                            <i class="fa-solid fa-pen"></i> Editar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div id="collectorsR" popover class="popover-bootstrap">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow">
                                <div class="modal-body">
                                    @include('collectors.collectorsR')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collectorE" popover class="popover-bootstrap">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow">
                                <div class="modal-body">
                                    @include('collectors.collectorsE')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

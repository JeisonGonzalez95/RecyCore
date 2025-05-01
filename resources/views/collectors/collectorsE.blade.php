<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">

        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="collectorE" popovertargetaction="hide"></button>
        </div>

        <div id="formCollectorE" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Editar Recolector</h2>
                </div>
            </div>

            <form action="{{ route('collectorsE') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id_coll">
                <div class="row mb-4">
                    <div class="col-md-4 mb-4">
                        <label for="nombre">Nombre del recolector:</label>
                        <input class="form-control" type="text" name="name_coll_e" id="name_coll_e" placeholder="Nombre Completo" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="dni">Documento:</label>
                        <div class="input-group">
                            <select name="type_doc_e" id="type_doc_e" class="form-select" style="max-width: 80px;">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" title="{{ $type->name }}">{{ $type->code }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="dni_coll_e" id="dni_coll_e" class="form-control" placeholder="Número de documento" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="descripcion">Pais:</label>
                        <select id="country_e" name="country_e" class="form-control">
                            <option value="">Seleccione Uno...</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Telefono:</label>
                        <input class="form-control" type="number" name="phn_coll_e" id="phn_coll_e">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Correo:</label>
                        <input class="form-control" type="text" name="email_coll_e" id="email_coll_e">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Direccion:</label>
                        <input class="form-control" type="text" name="address_e" id="address_e">
                    </div>
                </div>
                <div class="row mb-4 justify-content-center text-center">
                    <div class="col-auto">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <label class="form-check-label mb-0" for="state_coll_e">Inactivo</label>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" role="switch" id="state_coll_e"
                                    name="state_coll_e" value="1">
                            </div>
                            <label class="form-check-label mb-0" for="state_coll_e">Activo</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Editar Recolector</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

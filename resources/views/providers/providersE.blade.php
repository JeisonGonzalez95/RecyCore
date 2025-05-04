<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">
        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="providersE" popovertargetaction="hide"></button>
        </div>
        <div id="formProviderE" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Editar Provedor</h2>
                </div>
            </div>
            <form action="{{ route('providerE') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id_provider">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="nombre">Nombre del provedor:</label>
                        <input class="form-control" type="text" name="name_provider_e" id="name_provider_e" required>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">NIT:</label>
                        <input class="form-control" type="text" name="nit_provider_e" id="nit_provider_e" required>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Telefono:</label>
                        <input class="form-control" type="number" name="phn_provider_e" id="phn_provider_e" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Correo:</label>
                        <input class="form-control" type="text" name="email_provider_e" id="email_provider_e" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Direccion:</label>
                        <input class="form-control" type="text" name="address_e" id="address_e" required>
                    </div>
                </div>
                <div class="row mb-4 justify-content-center text-center">
                    <div class="col-auto">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <label class="form-check-label mb-0" for="state_provider_e">Inactivo</label>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" role="switch" id="state_provider_e" name="state_provider_e" value="1">
                            </div>
                            <label class="form-check-label mb-0" for="state_provider_e">Activo</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Editar Provedor</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">
        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="providersR" popovertargetaction="hide"></button>
        </div>
        <div id="formProvR" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Agregar Provedor</h2>
                </div>
            </div>
            <form action="{{ route('providerR') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="nombre">Nombre de la provedor:</label>
                        <input class="form-control" type="text" name="name_provider" id="name_provider" required>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">NIT:</label>
                        <input class="form-control" type="text" name="nit_provider" id="nit_provider" required>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Telefono:</label>
                        <input class="form-control" type="number" name="phn_provider" id="phn_provider" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Correo:</label>
                        <input class="form-control" type="text" name="email_provider" id="email_provider" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Direccion:</label>
                        <input class="form-control" type="text" name="address" id="address" required>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Registrar Provedor</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
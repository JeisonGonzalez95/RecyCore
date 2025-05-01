<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">

        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="collectorsR" popovertargetaction="hide"></button>
        </div>

        <div id="formProdR" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Agregar Recolector</h2>
                </div>
            </div>

            <form action="{{ route('collectorR') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4 mb-4">
                        <label for="nombre">Nombre del recolector:</label>
                        <input class="form-control" type="text" name="name_coll" id="name_coll"
                            placeholder="Nombre Completo" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="dni">Documento:</label>
                        <div class="input-group">
                            <select name="type_doc" id="type_doc" class="form-select" style="max-width: 80px;"
                                required>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" title="{{ $type->name }}">{{ $type->code }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="dni_coll" id="dni_coll" class="form-control"
                                placeholder="Número de documento" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="descripcion">Pais:</label>
                        <select id="country" name="country" class="form-control">
                            <option value="">Seleccione Uno...</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Telefono:</label>
                        <input class="form-control" type="number" name="phn_coll" id="phn_coll">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Correo:</label>
                        <input class="form-control" type="text" name="email_coll" id="email_coll">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Direccion:</label>
                        <input class="form-control" type="text" name="address" id="address">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Registrar recolector</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

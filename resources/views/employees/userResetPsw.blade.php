<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">

        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="empPsw" popovertargetaction="hide"></button>
        </div>
        <div id="formUserE" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Editar Usuario</h2>
                </div>
            </div>

            <form action="{{ route('editUser') }}" method="POST">
                @csrf
                <input type="hidden" id="user_id" name="user_id">
                <div class="row mb-4">
                    <input type="hidden" name="id_user">
                    <div class="col-md-4">
                        <label for="nombre">Usuario:</label>
                        <input class="form-control" type="text" name="username_e" id="username_e" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Contraseña:</label>
                        <input class="form-control" type="password" name="pass_e" id="pass_e" required minlength="2">
                        <div id="passwordStrengthMeter">
                            <div id="strength-bar" style="height: 5px; width: 0%; background-color: red;"></div>
                        </div>
                        <small id="passwordStrengthMessage" class="form-text text-muted"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Confirmar Contraseña:</label>
                        <input class="form-control" type="password" name="pass_er" id="pass_er" required minlength="2">
                        <small id="passwordMatchMessage" class="text-danger" style="display: none;">Las contraseñas no coinciden.</small>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Editar Usuario</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
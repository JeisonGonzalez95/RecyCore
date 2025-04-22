@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex align-items-center mb-5 pb-1">
                <i class="fas fa-cubes fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                <span class="h1 fw-bold mb-0">Registrar</span>
            </div>
            <form id="register" autocomplete="off" action="{{ route('register_e') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre completo" required>
                        <label class="form-label" for="form3Example1">Nombre Completo</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="dni" name="dni" class="form-control" placeholder="Numero de documento / DNI" required>
                        <label class="form-label" for="form3Example3">Documento</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" id="phone" name="phone" class="form-control" placeholder="Telefono" required>
                        <label class="form-label" for="form3Example4">Telefono</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electronico" required>
                        <label class="form-label" for="form3Example2">Correo</label>
                    </div>
                    <div class="col-md-4">
                        <select name="rol" id="rol" class="form-control">
                            <option value="">Seleccione Uno...</option>
                            @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}"> {{ $rol->name_role }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="form3Example2">Cargo</label>
                    </div>
                    <div class="col-md-4">
                        <select name="area" id="area" class="form-control">
                            <option value="">Seleccione Uno...</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}"> {{ $area->name_area }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="form3Example2">Area</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Usuario (Sin espacios ni caracteres especiales)" required>
                        <label class="form-label" for="form3Example3">Usuario</label>
                    </div>
                    <div class="col-md-4">
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required>
                        <label class="form-label" for="form3Example2">Contraseña</label>
                        <div id="passwordStrengthMeter">
                            <div id="strength-bar" style="height: 5px; width: 0%; background-color: red;"></div>
                        </div>
                        <small id="passwordStrengthMessage" class="form-text text-muted"></small>
                    </div>
                    <div class="col-md-4">
                        <input type="password" id="pass_r" name="pass_r" class="form-control" placeholder="Confirme Contraseña" required>
                        <label class="form-label" for="form3Example2">Confirmar Contraseña</label>
                        <small id="passwordMatchMessage" class="text-danger" style="display: none;">Las contraseñas no coinciden.</small>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-3">
                        <button class="btn btn-success w-100" type="submit"> Registrar</button>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('employeesList') }}" class="btn btn-danger w-100">Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
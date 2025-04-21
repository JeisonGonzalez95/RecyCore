@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass">
        <div class="card-body px-4 py-5 px-md-5">

            <!-- Header section -->
            <div class="d-flex align-items-center mb-5 pb-1">
                <i class="fas fa-cubes fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                <span class="h1 fw-bold mb-0">Registrarse</span>
            </div>

            <form id="register" autocomplete="off" action="{{ route('register_u') }}" method="POST">
                @csrf
                <!-- First row with input fields -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre completo" required>
                        <label class="form-label" for="form3Example1">Nombre</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="lastaname" name="lastname" class="form-control" placeholder="Apellidos" required>
                        <label class="form-label" for="form3Example2">Apellidos</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="dni" name="dni" class="form-control" placeholder="Numero de documento / DNI" required>
                        <label class="form-label" for="form3Example3">Documento</label>
                    </div>
                </div>

                <!-- Second row with input fields -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <input type="email" id="form3Example4" name="correo" class="form-control" placeholder="Correo electronico" required>
                        <label class="form-label" for="form3Example4">Correo Electrónico</label>
                    </div>
                    <div class="col-md-4">
                        <input type="password" id="pass_1" name="contraseña" class="form-control" placeholder="Contraseña" required>
                        <label class="form-label" for="form3Example5">Contraseña</label>
                    </div>
                    <div class="col-md-4">
                        <input type="password" id="pass_2" name="contraseña_confirmation" class="form-control" placeholder="Repita su contraseña" required>
                        <label class="form-label" for="form3Example6">Confirme su contraseña</label>
                    </div>
                </div>

                <!-- Submit button row -->
                <div class="row justify-content-center mb-5">
                    <div class="col-3">
                        <button class="btn btn-success w-100" type="submit"> Registrar</button>
                    </div>
                </div>

            </form>
        </div> 
    </div>
</div>


@endsection
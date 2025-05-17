@extends('app')
@section('message')
    <div class="col-lg-6 mb-5 mb-lg-0 welcome text-center">
        <img class="img-logo-s" src="{{ asset('images/logo.png') }}" alt="Logo RecyCore">

        <h1 class="my-5 display-6 fw-bold titulo">
            Plataforma organizacional de productos reciclados.
        </h1>
        <p class="mb-4 parrafo">
            Gestion efectiva de productos de reciclaje.<br>
            Reciclar esta en tus manos.
        </p>
    </div>
@endsection

@section('content')
    <div class="card bg-glass">
        <div class="card-body px-4 py-5 px-md-5">
            <form action="{{ route('login') }}" method='post'>
                @csrf
                <div class="text-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0">Iniciar Sesion</span>
                </div>
                <div data-mdb-input-init class="form-outline mb-3">
                    <input type="username" id="username" name="username" class="form-control" required>
                    <label class="form-label" for="form3Example3">Usuario</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-3">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <label class="form-label" for="form3Example4">Contraseña</label>
                </div>
                <div class="row mb-4">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-2">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

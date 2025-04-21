@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex align-items-center mb-5 pb-1">
                <i class="fas fa-cubes fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                <span class="h1 fw-bold mb-0">Registrar Cargo</span>
            </div>

            <form id="register" autocomplete="off" action="{{ route('register_ep') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4">
                        <select name="nameE" id="nameE" class="form-control">
                            <option value="">Seleccione Uno...</option>
                            @foreach($usersC as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="form3Example1">Nombre</label>
                    </div>
                    <div class="col-md-4">
                        <select name="dniE" id="dniE" class="form-control">
                            <option value="">Seleccione Uno...</option>
                            @foreach($usersC as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->dni }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="form3Example3">Documento</label>
                    </div>
                    <div class="col-md-4">
                        <select name="area" id="area" class="form-control">
                            <option value="">Seleccione Uno...</option>
                            @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name_area }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="area">Area</label>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4">
                        <select name="role" id="role" class="form-control">
                            <option value="">Seleccione Uno...</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name_role }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="role">Rol</label>
                    </div>
                    <div class="col-md-4">
                        <select name="position" id="position" class="form-control" disabled>
                            <option value="">Seleccione un departamento primero...</option>
                        </select>
                        <label class="form-label" for="position">Cargo</label>
                    </div>
                    <div class="col-md-4">
                        <select name="boss" id="boss" class="form-control">
                            <option value="">Seleccione Uno...</option>
                            @foreach($usersB as $boss)
                            <option value="{{ $boss->id }}">{{ $boss->fullname }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="boss">Jefe</label>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-3">
                        <button class="btn btn-success w-100" type="submit"> Registrar</button>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('positionList') }}" class="btn btn-danger w-100">Volver</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection
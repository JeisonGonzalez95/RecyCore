<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">
        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="licenceR" popovertargetaction="hide"></button>
        </div>
        <div id="formLicenceR" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Agregar Permiso Menu - Item</h2>
                </div>
            </div>

            <form action="{{ route('licenceR') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="nombre">Empleado:</label>
                        <select class="form-control" name="employee" id="employee">
                            <option value="">Seleccione Uno...</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"> {{ $user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Menus:</label>
                        <select class="form-control selectpicker" id="menus" name="menus[]" multiple>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name_menu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Items:</label>
                        <select class="form-control selectpicker" id="items" name="items[]" multiple>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}"> {{ $item->name_item }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Registrar Permisos</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">

        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="licenceE" popovertargetaction="hide"></button>
        </div>

        {{-- Formulario Menú --}}
        <div id="formlicenceE" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Editar Permisos</h2>
                </div>
            </div>

            <form action="{{ route('licenceE') }}" method="POST">
                @csrf
                <input type="hidden" id="id_licence" name="id_licence">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="nombre">Empleado:</label>
                        <select name="employee_e" id="employee_e" class="form-control" disabled>
                            @foreach ($usersE as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Menus:</label>
                        <select name="menus_e[]" id="menus_e" class="form-control selectpicker" multiple>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name_menu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Items:</label>
                        <select name="items_e[]" id="items_e" class="form-control selectpicker" multiple>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Editar Menú</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

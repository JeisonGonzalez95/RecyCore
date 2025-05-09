<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">


        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="menuR" popovertargetaction="hide"></button>
        </div>


        {{-- Formulario Menú --}}
        <div id="formMenuR" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Agregar Menú</h2>
                </div>
            </div>

            <form action="{{ route('register_mn') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="nombre">Nombre del menu:</label>
                        <input class="form-control" type="text" name="name_menu" id="name_menu" required>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Sigla:</label>
                        <input class="form-control" type="text" name="slug_menu" id="slug_menu" required>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Estado:</label>
                        <select class="form-control" name="state_menu" id="state_menu">
                            <option value="0">Inactivo</option>
                            <option value="1" selected>Activo</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Registrar Menú</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Formulario Ítem --}}
        <div id="formItemR" class="formulario" style="display: none;">

            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Agregar Items</h2>
                </div>
            </div>
            <form action="{{ route('register_it') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="nombre">Nombre del item:</label>
                        <input class="form-control" type="text" name="name_item" id="name_item">
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Ruta:</label>
                        <input class="form-control" type="text" name="route" id="route">
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Menu Principal:</label>
                        <select class="form-control" type="text" name="main_menu" id="main_menu">
                            <option value="">Seleccione Uno...</option>
                            @foreach ($menus as $menu)
                            <option value="{{ $menu->id}}">{{ $menu->name_menu }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Estado:</label>
                        <select class="form-select" name="state" id="state">
                            <option value="0">Inactivo</option>
                            <option value="1" selected>Activo</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <button class="btn btn-success w-100" type="submit">Registrar Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
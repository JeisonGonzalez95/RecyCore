<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">

        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="menuE" popovertargetaction="hide"></button>
        </div>

        {{-- Formulario Menú --}}
        <div id="formMenuE" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Editar Menú</h2>
                </div>
            </div>

            <form action="{{ route('edit_mn') }}" method="POST">
                @csrf
                <input type="hidden" id="menu_id" name="menu_id">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="nombre">Nombre del menu:</label>
                        <input class="form-control" type="text" name="name_menu_e" id="name_menu_e" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Sigla:</label>
                        <input class="form-control" type="text" name="slug_menu_e" id="slug_menu_e" required minlength="2">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Editar Menú</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Formulario Ítem --}}
        <div id="formItemE" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Editar Items</h2>
                </div>
            </div>
            <form action="{{ route('edit_it') }}" method="POST">
                @csrf
                <input type="hidden" id="item_id" name="item_id">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="nombre">Nombre del item:</label>
                        <input class="form-control" type="text" name="name_item_e" id="name_item_e">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Ruta:</label>
                        <input class="form-control" type="text" name="route_e" id="route_e">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Menu Principal:</label>
                        <select class="form-control" type="text" name="main_menu_e" id="main_menu_e">
                            <option value="">Seleccione Uno...</option>
                            @foreach ($menusL as $menu)
                            <option value="{{ $menu->id}}">{{ $menu->name_menu }}</option>                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <button class="btn btn-success w-100" type="submit">Editar Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
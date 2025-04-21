@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Menus e Items</h2>
                </div>
            </div>

            <ul class="nav nav-tabs mb-4" id="menuTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="menus-tab" data-bs-toggle="tab" data-bs-target="#menus" type="button" role="tab">Menús</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="items-tab" data-bs-toggle="tab" data-bs-target="#items" type="button" role="tab">Items</button>
                </li>
            </ul>

            <div class="tab-content" id="menuTabsContent">
                <!-- Menús -->
                <div class="tab-pane fade show active" id="menus" role="tabpanel">

                    <div class="text-center mb-4">
                        <button popovertarget="menuR" popovertargetaction="show" class="btn btn-outline-primary" data-form="formMenuR" onclick="mostrarFormulario(this)"><i class="fa-solid fa-user-plus"></i> Agregar Menu</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del menú</th>
                                    <th>Sigla</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menusL as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->name_menu }}</td>
                                    <td>{{ $menu->slug_menu }}</td>
                                    <td>{{ $menu->state == 1 ? 'Activo' : 'Inactivo' }}
                                    </td>
                                    @php
                                    $dataMenu = [
                                    'id' => $menu->id,
                                    'name' => $menu->name_menu,
                                    'slug' => $menu->slug_menu,
                                    'state' => $menu->state
                                    ];
                                    $mai = 1;
                                    @endphp
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-link text-warning me-3 p-0" title="Editar" popovertarget="menuE" popovertargetaction="show" data-form="formMenuE" data-menu-id='@json($dataMenu)' onclick="mostrarFormulario(this)">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault{{ $menu->id }}" name="state_menu_e" value="1" data-url="{{ route('delete_mai', ['id' => $menu->id, 'mai' => 1]) }}" onchange="desactivarMenu(this)" {{ $menu->state == 1 ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Items -->
                <div class="tab-pane fade" id="items" role="tabpanel">
                    <div class="text-center mb-4">
                        <button popovertarget="menuR" popovertargetaction="show" class="btn btn-outline-primary" data-form="formItemR" onclick="mostrarFormulario(this)"><i class="fa-solid fa-user-plus"></i> Agregar Item</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Item</th>
                                    <th>Ruta</th>
                                    <th>Menú correspondiente</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemsL as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name_item }}</td>
                                    <td>{{ $item->route_item }}</td>
                                    <td>{{ $item->mainMenu->name_menu }}</td>
                                    <td>{{ $item->state == 1 ? 'Activo' : 'Inactivo' }}</td>
                                    @php
                                    $dataItem = [
                                    'id' => $item->id,
                                    'name' => $item->name_item,
                                    'route' => $item->route_item,
                                    'main' => $item->mainMenu->id,
                                    'state' => $item->state
                                    ];
                                    @endphp

                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-link text-warning me-3 p-0" title="Editar" popovertarget="menuE" popovertargetaction="show" data-form="formItemE" data-item-id='@json($dataItem)' onclick="mostrarFormulario(this)">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault{{ $item->id }}" name="state_item_e" value="1" data-url="{{ route('delete_mai', ['id' => $item->id, 'mai' => 2]) }}" onchange="desactivarMenu(this)" {{ $item->state == 1 ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="menuR" popover class="popover-bootstrap">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content shadow">
                        <div class="modal-body">

                            @include('menus.menusRm')
                        </div>
                    </div>
                </div>
            </div>
            <div id="menuE" popover class="popover-bootstrap">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content shadow">
                        <div class="modal-body">

                            @include('menus.menusEm')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
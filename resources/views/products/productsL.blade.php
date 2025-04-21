@extends('source.index')

@section('contentR')

<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Productos</h2>
                </div>
                <button popovertarget="prodR" popovertargetaction="show" class="btn btn-outline-primary" data-form="formProdR" onclick="mostrarFormulario(this)"><i class="fa-solid fa-user-plus"></i> Agregar Producto</button>
            </div>
            <div class="table-responsive">
                <table id="tablaEmpleados" class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Item</th>
                            <th>Nombre</th>
                            <th>Sigla</th>
                            <th>Precio de compra</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->slug_product }}</td>
                            <td>{{ $product->price_product }}</td>
                            <td>{{ $product->state == 1 ? 'Activo' : 'Inactivo' }}</td>
                            @php
                            $dataProd = [
                            'id' => $product->id,
                            'name' => $product->product_name,
                            'slug' => $product->slug_product,
                            'price' => $product->price_product,
                            'state' => $product->state
                            ];
                            @endphp
                            <td>
                                <button type="button" class="btn btn-link text-warning me-3 p-0" title="Editar" popovertarget="prodE" popovertargetaction="show" data-form="formProdE" data-prod-id='@json($dataProd)' onclick="mostrarFormulario(this)">
                                    <i class="fa-solid fa-pen"></i>Editar
                                </button>
                                <!-- <a href="javascript:void(0);" class="text-danger btn-delete" data-url="{{ route('delete_pos', $product->id) }}" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </a> -->
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div id="prodR" popover class="popover-bootstrap">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-body">
                                @include('products.productsR')
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prodE" popover class="popover-bootstrap">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-body">
                                @include('products.productsE')
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
@extends('source.index')
@section('contentR')
    <div class="content-wrapper">
        <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
                <div class="prod">
                    Entrada N° {{ $lastId }}
                </div>
                @php
                    $priceField = $tp == 1 ? 'price_product_purch_c' : 'price_product_purch_f';
                    $tipo = $tp == 1 ? 'Recolector' : 'Fuente';
                @endphp
                <div class="d-flex align-items-center mb-5 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <span class="h3 fw-bold mb-0">Registrar Entrada - {{ $tipo }}</span>
                </div>
                <form id="register" autocomplete="off" action="{{ route('addMoviment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="movId" value="{{ $lastId }}">
                    <div class="container-white mb-4">
                        <div class="row">

                            @if ($tp == 1)
                                <input type="hidden" name="type_c" id="type_c" value="1">
                                <div class="col-md-4 d-flex align-items-center mb-3">
                                    <label for="client" class="me-2 mb-0" style="white-space: nowrap;">Recolector:</label>
                                    <select name="client" id="client" class="form-control" required>
                                        <option value="">Seleccione Uno...</option>
                                        @foreach ($collectors as $collector)
                                            <option value="{{ $collector->id }}"> {{ $collector->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="type_c" id="type_c" value="2">
                                <div class="col-md-4 d-flex align-items-center mb-3">
                                    <label for="client" class="me-2 mb-0" style="white-space: nowrap;">Fuente:</label>
                                    <select name="client" id="client" class="form-control" required>
                                        <option value="">Seleccione Uno...</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"> {{ $client->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-md-4 d-flex align-items-center mb-3">
                                <label for="user" class="me-2 mb-0" style="white-space: nowrap;">Usuario:</label>
                                <input type="text" id="user" name="user" class="form-control"
                                    value="{{ session('fullname') }}" required disabled>
                            </div>
                            <div class="col-md-4 d-flex align-items-center mb-3">
                                <label for="date_in" class="me-2 mb-0" style="white-space: nowrap;">Fecha de
                                    ingreso:</label>
                                <input type="text" id="date_in" name="date_in" class="form-control"
                                    value=" {{ now()->format('d-m-Y h:i') }} " required disabled>
                            </div>
                        </div>
                    </div>

                    <div class="container-white container-white-4 mb-4 text-center">
                        <div class="product-container">
                            <!-- Este es el primer "row" que se mostrará inicialmente -->
                            <div class="row product-item">
                                <div class="col-md-3 d-flex align-items-center mb-3">
                                    <label for="product" class="me-2 mb-0" style="white-space: nowrap;">Producto:</label>
                                    <select name="product[]" class="form-control product-select" required>
                                        <option value="">Seleccione Uno...</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->$priceField }}">
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-center mb-3">
                                    <label for="amount" class="me-2 mb-0" style="white-space: nowrap;">Cant (Kg):</label>
                                    <input type="text" id="amount" name="amount[]" class="form-control numeric-comma"
                                        value="0" required>
                                </div>
                                @if ($tp == 2)
                                    <div class="col-md-2 d-flex align-items-center mb-3">
                                        <label for="amount" class="me-2 mb-0" style="white-space: nowrap;">Dev
                                            (Kg):</label>
                                        <input type="text" id="amountDev" name="amountDev[]"
                                            class="form-control numeric-comma" value="0">
                                    </div>
                                @endif
                                <div class="col-md-3 d-flex align-items-center mb-3">
                                    <label for="price" class="me-2 mb-0" style="white-space: nowrap;">Precio:</label>
                                    <input type="number" id="price" name="price[]" class="form-control" min="1"
                                        value="0" required readonly>
                                </div>
                                <div class="col-md-1 d-flex align-items-center mb-3">
                                    <a href="#" id="delete_item" class="btn btn-outline-danger" disabled>
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="button-plus mb-4">
                            <a href="#" id="add-item">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </div>
                        <div class="align-items-center">
                            Descripcion:
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center mb-5">
                    <div class="col-3">
                        <button class="btn btn-success w-100" type="submit" form="register">Registrar</button>
                    </div>
                    <div class="col-3">
                        <form action="{{ route('delMov') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $lastId }}">
                            <button class="btn btn-danger w-100" type="submit">Volver</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

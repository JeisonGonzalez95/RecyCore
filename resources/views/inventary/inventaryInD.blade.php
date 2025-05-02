@extends('source.index')

@section('contentR')
    <div class="content-wrapper">
        <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
                <div class="d-flex align-items-center mb-5 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <span class="h3 fw-bold mb-0">Detalle de Entrada N°: {{ $invin->id }}</span>
                </div>
                <div class="container-white mb-4">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center mb-3">
                            <label for="client" class="me-2 mb-0" style="white-space: nowrap;">Cliente:</label>
                            <input type="text" id="client" name="client" class="form-control"
                                value="{{ $invin->client_data->name }}" disabled>
                        </div>
                        <div class="col-md-4 d-flex align-items-center mb-3">
                            <label for="user" class="me-2 mb-0" style="white-space: nowrap;">Usuario:</label>
                            <input type="text" id="user" name="user" class="form-control"
                                value="{{ $invin->employee->fullname }}" disabled>
                        </div>
                        <div class="col-md-4 d-flex align-items-center mb-3">
                            <label for="date_in" class="me-2 mb-0" style="white-space: nowrap;">Fecha de ingreso:</label>
                            <input type="text" id="date_in" name="date_in" class="form-control"
                                value=" {{ $invin->date_in }} " disabled>
                        </div>
                    </div>
                </div>
                <div class="container-white container-white mb-4 text-center">
                    <div class="product-container mb-4">
                        @foreach ($invproducts as $invproduct)
                            <div class="row">
                                <div class="col-md-3 d-flex align-items-center mb-3">
                                    <label for="product" class="me-2 mb-0" style="white-space: nowrap;">Producto:</label>
                                    <input type="text" name="product" id="product" class="form-control"
                                        value="{{ $invproduct->product->product_name }}" disabled>
                                </div>
                                <div class="col-md-3 d-flex align-items-center mb-3">
                                    <label for="amount" class="me-2 mb-0" style="white-space: nowrap;">Cant (Kg):</label>
                                    <input type="number" id="amount" name="amount" class="form-control"
                                        value="{{ $invproduct->amount_kg }}" disabled>
                                </div>
                                <div class="col-md-2 d-flex align-items-center mb-3">
                                    <label for="amount" class="me-2 mb-0" style="white-space: nowrap;">Dev (Kg):</label>
                                    <input type="number" id="amount" name="amount" class="form-control"
                                        value="{{ $invproduct->amount_dev_kg }}" disabled>
                                </div>
                                <div class="col-md-2 d-flex align-items-center mb-3">
                                    <label for="price" class="me-2 mb-0" style="white-space: nowrap;">Precio:</label>
                                    <input type="number" id="price" name="price" class="form-control"
                                        value="{{ $invproduct->price_product }}" disabled>
                                </div>
                            </div>
                        @endforeach
                        Precio total: ${{ $totalPrice }}

                    </div>
                    <div class="align-items-center">
                        Descripcion:
                        <textarea name="description" id="description" class="form-control" disabled>{{ $invin->description }}</textarea>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-3">
                        <a href="{{ route('inventaryI') }}" class="btn btn-danger w-100">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

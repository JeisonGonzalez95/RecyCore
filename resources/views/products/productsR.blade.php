<div class="card bg-glass shadow-sm">
    <div class="card-body px-4 py-5 px-md-5">

        <div class="bg-glass shadow-sm position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Cerrar"
                popovertarget="prodR" popovertargetaction="hide"></button>
        </div>

        <div id="formProdR" class="formulario" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color:rgb(25, 171, 255);"></i>
                    <h2 class="fw-bold mb-0">Agregar Producto</h2>
                </div>
            </div>

            <form action="{{ route('productR') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="nombre">Nombre del producto:</label>
                        <input class="form-control" type="text" name="name_prod" id="name_prod" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Sigla:</label>
                        <input class="form-control" type="text" name="slug_product" id="slug_product" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Precio de venta (COP$):</label>
                        <input class="form-control" type="number" name="price_product_sale" id="price_product_sale" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion">Precio de compra (COP$):</label>
                        <input class="form-control" type="number" name="price_product_purch" id="price_product_purch" min="0" required>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-success w-100" type="submit">Registrar Producto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
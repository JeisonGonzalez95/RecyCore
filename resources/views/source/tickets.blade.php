@extends('source.index')

@section('contentR')

<link href="{{ asset('../css/machine.css') }}" rel="stylesheet">

<div class="content-wrapper">
    <div class="card bg-glass">
        <div class="card-body px-4 py-5 px-md-5">
            <div id="tragamonedas" class="carrusel-container">
                <?php for ($i = 1; $i <= 3; $i++) { ?>
                    <div class="carrusel">
                        <div class="contenedor">
                            <div class="slide"><img src="{{ asset('images/ruleta/icono1.png') }}"></div>
                            <div class="slide"><img src="{{ asset('images/ruleta/icono2.png') }}"></div>
                            <div class="slide"><img src="{{ asset('images/ruleta/icono3.png') }}"></div>
                            <div class="slide"><img src="{{ asset('images/ruleta/icono4.png') }}"></div>
                            <div class="slide"><img src="{{ asset('images/ruleta/icono5.png') }}"></div>
                        </div>
                    </div>
                <?php } ?>
                <div id="mensaje" class="mensaje"></div>
            </div>

            <div class="botones">
                <button class="girar" id="girar">Girar</button>
            </div>
        </div>
    </div>
</div>

@endsection
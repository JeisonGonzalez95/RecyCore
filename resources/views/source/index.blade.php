@extends('app')

@section('contentM')
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('images/recycorerz.webp') }}">
            </a>

            <div class="menu-superior">
                @foreach ($menus as $menu)
                    <a href="javascript:void(0)" data-target="{{ $menu->slug_menu }}">
                        {{ $menu->name_menu }}
                    </a>
                @endforeach
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </ul>
                <span class="text-center txt-smll">
                    {{ session('fullname') }} <br>
                    <p id="hora">: </p>
                </span>
            </div>
        </div>
    </nav>

    <div id="menu-data" data-slugs="{{ htmlspecialchars(json_encode($menus->pluck('slug_menu')), ENT_QUOTES, 'UTF-8') }}">
    </div>
    <div class="sidebar" id="sidebar">
        <button id="menuToggle" class="menu-toggle">☰</button>
        @foreach ($menus as $menu)
            <div id="{{ $menu->slug_menu }}" class="sidebar-section {{ !$loop->first ? 'hidden' : '' }}">
                <a href="{{ route('index') }}" class="menu-item active">Inicio</a>
                @foreach ($menu->items as $item)
                    <a href="{{ route($item->route_item) }}" class="menu-item">
                        {{ $item->name_item }}
                    </a>
                @endforeach
                <form action="{{ route('logout') }}" method="POST" onsubmit="localStorage.clear()">
                    @csrf
                    <button type="submit" id="logout-link" class="menu-item logout-link">Cerrar sesión</button>
                </form>

            </div>
        @endforeach
    </div>
@endsection

@section('contentR')
    @if (isset($data))
        <div class="content-wrapper">
            <div class="card bg-glass shadow-sm">
                <div class="card-body px-4 py-5 px-md-5 text-center">
                    <div class="container">
                        <h2 class="mb-4">Dashboard de Movimientos</h2>
                        <div id="chart-data" data-labels='@json($data->pluck('product_name'))'
                            data-quantities='@json($data->pluck('total_kg'))' data-costs='@json($data->pluck('total_cost'))'>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <canvas id="chartPie" style="max-width: 70%; max-height: 70%;"></canvas>
                            </div>
                            <div class="col-md-6 mb-4">
                                <canvas id="chartLine"></canvas>
                            </div>
                            <div class="col-md-6 mb-4">
                                <canvas id="chartBar"></canvas>
                            </div>
                            <div class="col-md-6 mb-4">
                                <canvas id="chartBarHorizontal"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

{{-- Toast para mostrar alerta de cantidades en bodega (solo admins) --}}
@if (auth()->check() && session('stock_alert'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="stockToast" class="toast border-0 shadow-lg rounded-3" role="alert" aria-live="assertive"
            aria-atomic="true" data-bs-delay="10000" data-bs-autohide="true">
            <div class="toast-header bg-warning text-white rounded-top-3">
                <img src="{{ asset('images/recycorerz.webp') }}" class="rounded me-2" alt="check" width="20"
                    height="20">
                <strong class="me-auto">¡Atención!</strong>
                <small>{{ now()->format('H:i') }}</small>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Cerrar"></button>
            </div>
            <div class="toast-body">
                {!! session('stock_alert') !!}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('stockToast');
            if (toastEl) {
                setTimeout(() => {
                    const toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }, 3000); // Mostrar después de 3 segundos
            }
        });
    </script>
@endif

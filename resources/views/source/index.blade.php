@extends('app')

@section('contentM')
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img class="img-logo" src="{{ asset('images/recycore.png') }}" alt="Logo PsicoAlianza">
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </ul>
            <span class="text-center txt-smll">
                {{ session('fullname') }} <br>
                <p id="hora">: </p>
            </span>
            <form action="{{ route('logout') }}" method="POST" onsubmit="localStorage.clear()">
                @csrf
                <button type="submit" class="btn btn-outline-success" title="Cerrar Sesión">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- Pasar slugs al frontend usando data-* seguro --}}
<div id="menu-data" data-slugs="{{ htmlspecialchars(json_encode($menus->pluck('slug_menu')), ENT_QUOTES, 'UTF-8') }}"></div>

<div class="sidebar" id="sidebar">
    @foreach ($menus as $menu)
    <div id="{{ $menu->slug_menu }}" class="sidebar-section {{ !$loop->first ? 'hidden' : '' }}">
        <a href="{{ route('index') }}" class="menu-item active">Inicio</a>
        @foreach ($menu->items as $item)
        <a href="{{ route($item->route_item) }}" class="menu-item">
            {{ $item->name_item }}
        </a>
        @endforeach
    </div>
    @endforeach
</div>
@endsection

@section('contentR')
<div class="content-wrapper">
    <div class="card bg-glass shadow-sm">
        <div class="card-body px-4 py-5 px-md-5 text-center">
            <div class="mb-4">
                <h1 class="fw-bold mb-0">Bienvenido!<br> {{ session('fullname') }}!</h1>
            </div>
            <p class="fw-semibold mb-4 text-muted">Añade los datos personales de tus empleados y después agrega su cargo en tu empresa.</p>

            <a class="btn btn-lg" href="{{ route('registerEc') }}">
                <img class="img-logo-u" src="{{ asset('images/user.png') }}" alt=""><br>Registrar Usuario
            </a>
        </div>
    </div>
</div>
@endsection
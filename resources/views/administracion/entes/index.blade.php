<x-app-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
        </style>
        <link href="https://getbootstrap.com/docs/5.3/examples/headers/headers.css" rel="stylesheet">
    </x-slot>
    <x-slot name="scripts">
        
    </x-slot>
    <x-slot name="header">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{route('dashboard')}}" class="nav-link px-2 link-body-emphasis">Inicio</a></li>
        @if (Auth::user()->name=='admin')
    <!-- The current user can update the post... -->
    <li><a href="{{route('users')}}" class="nav-link px-2 link-body-emphasis">Colaboradores</a></li>
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-body-emphasis" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Campos de usuario
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('dependencias.index')}}">Dependencia / Departamento</a></li>
            <li><a class="dropdown-item" href="{{route('entes.index')}}">Ente / Organismo</a></li>
            <li><a class="dropdown-item" href="{{route('areas.index')}}">Area</a></li>
            <li><a class="dropdown-item" href="{{route('ubicaciones.index')}}">Ubicación Física</a></li>
          </ul>
        </li>
        @endif 
          <!-- 
          <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Inventory</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Customers</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li>
          -->
        </ul>
        

       
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
           <!-- 
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
      -->
        </form>
        

        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('img/Sample_User_Icon.png')}}" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            
            <!-- 
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            -->
            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
          </ul>
        </div>
        </div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entes / Organismos') }}
        </h2>
    </x-slot>

    <a class="btn btn-primary py-2" href="{{ route('entes.create')}}"> Dar de alta nueva ente</a>

    <div class="table-responsive small">
        <table class="table table-striped table-sm" id="myTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          @forelse ($entes as $ente)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$ente->name}}</td>
              <td>
              <a href="{{ route('entes.edit', $ente->id )}}" class="btn btn-success btn-sm">Editar</a>
              </td>
              <td>
              <form method="POST" action="{{ route('entes.destroy', $ente->id )}}">
                @method('DELETE')
                @csrf
                <x-button class="btn btn-danger btn-sm">
                        {{ __('Eliminar') }}
                </x-button>
              </form>
              </td>
              
            </tr>
          @empty
            <p>No hay entes</p>
          @endforelse
          </tbody>
        </table>
      </div>
</x-app-layout>
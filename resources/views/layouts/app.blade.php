<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fisioterapia - Panel de Administración</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/Bootstrap/css/bootstrap.min.css') }}">

<!-- jQuery -->
<script src="{{ asset('vendor/JQuery/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('vendor/Bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- FontAwesome -->
<link rel="stylesheet" href="{{ asset('vendor/FontAwesome/css/all.min.css') }}">


<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('vendor/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/DataTables/dataTables.bootstrap5.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/css/custom-datatable.css') }}">


<!-- DataTables JS -->
<script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>


<!-- Sweetalert2 JS -->
<script src="{{ asset('vendor/Sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- Sweetalert2 CSS -->
<link rel="stylesheet" href="{{ asset('vendor/Sweetalert2/sweetalert2.min.css') }}">

    <style>
        /* Estilo para el panel lateral */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
            transition: transform 0.3s ease;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        .content {
            margin-left: 230px;
            padding: 20px;
        }
        .btn-logout {
            background-color: #e74a3b;
            color: white;
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }
        .nav-link.active {
            background-color: #495057;
        }

        /* Estilos para el sidebar en móviles */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content {
            margin-left: 0px;
            padding: 20px;
        }
        }
    </style>
</head>
<body>

    <!-- Barra lateral -->
    <div class="sidebar" id="sidebar">
        <a href="{{ url('/') }}" class="navbar-brand">Terapia</a>
        @if (Auth::user()->role->rol == 'Administrador')
        <div class="navbar-nav">
            <a href="{{ route('users.index') }}" class="nav-link @if(request()->routeIs('users.index')) active @endif">Usuarios</a>
            <a href="{{ route('terapeuta.index') }}" class="nav-link @if(request()->routeIs('terapeuta.index')) active @endif">Terapeuta</a>
            <a href="{{ route('pacientes.index') }}" class="nav-link @if(request()->routeIs('pacientes.index')) active @endif">Pacientes</a>
            <a href="{{ route('historiales.index') }}" class="nav-link @if(request()->routeIs('historiales.index')) active @endif">Historiales</a>    
        </div>
        @endif
        
        @auth
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-logout btn-sm w-100">Cerrar sesión</button>
        </form>
        @endauth
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button id="menu-toggle" class="btn d-lg-none" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                @if (Auth::user())
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none text-body fw-bold">
                    {{ Auth::user()->name }} ({{ Auth::user()->role->rol }})
                </span>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link text-body fw-bold px-0" style="background: none; border: none;">
                        <i class="fas fa-sign-out-alt me-sm-1"></i>
                        <span class="d-sm-inline d-none">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </nav>
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <script>
        // Función para abrir y cerrar el sidebar en móviles
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    </script>

</body>
</html>
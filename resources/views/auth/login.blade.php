<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fisioterapia</title>
    <!-- Agregar Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4" style="max-width: 400px; width: 100%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>

        <!-- Formulario de Login -->
        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Recordar sesión -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>
</div>

<script>
    // Al cargar la página, verificamos si hay un correo guardado en localStorage
    window.onload = function() {
        if (localStorage.getItem('email')) {
            document.getElementById('email').value = localStorage.getItem('email');
        }
    };

    // Función para guardar el correo en localStorage si "Recordar sesión" está marcado
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        if (document.getElementById('rememberMe').checked) {
            localStorage.setItem('email', document.getElementById('email').value);
        } else {
            localStorage.removeItem('email');  // Eliminar el correo si no se marca el checkbox
        }
    });
</script>

</body>
</html>

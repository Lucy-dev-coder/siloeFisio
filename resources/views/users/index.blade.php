@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Usuarios</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">Crear Usuario</button>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->rol }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editUser({{ $user }})" data-bs-toggle="modal" data-bs-target="#editUserModal">Editar</button>
                        
                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Crear Usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nombre:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Rol:</label>
                        <select name="role_id" class="form-control" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->rol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" id="editUserId">
                    <div class="mb-3">
                        <label>Nombre:</label>
                        <input type="text" id="editUserName" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" id="editUserEmail" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Rol:</label>
                        <select id="editUserRole" name="role_id" class="form-control" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->rol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Script -->
<script>
    function editUser(user) {
        document.getElementById('editUserId').value = user.id;
        document.getElementById('editUserName').value = user.name;
        document.getElementById('editUserEmail').value = user.email;
        document.getElementById('editUserRole').value = user.role_id;
        document.getElementById('editUserForm').action = `/users/${user.id}`;
    }

    function confirmDelete(userId) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, eliminar"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("delete-form-" + userId).submit();
            }
        });
    }

 
    @if(session('success'))
        Swal.fire({
            title: "Éxito",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 800, // Se cierra automáticamente en 800ms
            showConfirmButton: false
        });
    @endif


</script>
@endsection

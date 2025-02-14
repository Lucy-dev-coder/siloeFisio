

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Gestión de Pacientes</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPacienteModal">Crear
            Paciente</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>CI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->nombres }}</td>
                        <td>{{ $paciente->apellidos }}</td>
                        <td>{{ $paciente->ci }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" 
                            onclick='editPaciente(@json($paciente))'
                            data-bs-toggle="modal" 
                            data-bs-target="#editPacienteModal">
                        Editar
                    </button>

                            <form id="delete-form-{{ $paciente->id }}"
                                action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $paciente->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Crear Paciente -->
    <div class="modal fade" id="createPacienteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createPacienteForm" action="{{ route('pacientes.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombres:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nombres" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Apellidos:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="apellidos" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">CI:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ci" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fecha de Nacimiento:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fecha_nacimiento" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Celular:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="celular" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Correo Electrónico:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="email" class="form-control" name="correo" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dirección:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="direccion">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grupo Sanguíneo:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="grupo_sanguineo">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contacto de Emergencia:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="contacto_emergencia">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Paciente -->
    <div class="modal fade" id="editPacienteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editPacienteForm" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" id="editPacienteId">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombres:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteNombres" name="nombres"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Apellidos:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteApellidos"
                                        name="apellidos" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">CI:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteCI" name="ci"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fecha de Nacimiento:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="editPacienteFechaNacimiento"
                                        name="fecha_nacimiento" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Celular:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteCelular" name="celular"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Correo Electrónico:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="editPacienteCorreo" name="correo"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dirección:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteDireccion"
                                        name="direccion">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grupo Sanguíneo:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteGrupoSanguineo"
                                        name="grupo_sanguineo">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contacto de Emergencia:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteContactoEmergencia"
                                        name="contacto_emergencia">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editPaciente(paciente) {
    console.log('Paciente a editar:', paciente); // Para debug
    
    // Asegúrate que el ID existe
    if (!paciente.id) {
        console.error('ID de paciente no encontrado');
        return;
    }

    // Llenar los campos del formulario
    document.getElementById('editPacienteId').value = paciente.id;
    document.getElementById('editPacienteNombres').value = paciente.nombres;
    document.getElementById('editPacienteApellidos').value = paciente.apellidos;
    document.getElementById('editPacienteCI').value = paciente.ci;
    document.getElementById('editPacienteFechaNacimiento').value = paciente.fecha_nacimiento;
    document.getElementById('editPacienteCelular').value = paciente.celular;
    document.getElementById('editPacienteCorreo').value = paciente.correo;
    document.getElementById('editPacienteDireccion').value = paciente.direccion || '';
    document.getElementById('editPacienteGrupoSanguineo').value = paciente.grupo_sanguineo || '';
    document.getElementById('editPacienteContactoEmergencia').value = paciente.contacto_emergencia || '';

    // Actualizar la URL del formulario
    const form = document.getElementById('editPacienteForm');
    form.action = "{{ url('/pacientes') }}/" + paciente.id;
    console.log('URL del formulario:', form.action); // Para debug
}

        function confirmDelete(pacienteId) {
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
                    document.getElementById("delete-form-" + pacienteId).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                title: "Éxito",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 800,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Gestión de Pacientes</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPacienteModal">Crear
            Paciente</button>

            <table id="pacientesTable" class="table dataTable">

            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>CI</th>
                    <th>Celular</th>
                    <th>Tipo sangre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
                        <td>{{ $paciente->ci }}</td>
                        <td>{{ $paciente->celular }}</td>
                        <td>{{ $paciente->grupo_sanguineo }}</td>
                        <td>
                            <!-- Ver detalles -->
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewPacienteModal{{ $paciente->id }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Editar -->
                            <button class="btn btn-warning btn-sm" onclick='editPaciente(@json($paciente))'
                                data-bs-toggle="modal" data-bs-target="#editPacienteModal">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Eliminar -->
                            <form id="delete-form-{{ $paciente->id }}"
                                action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $paciente->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
                                    <input type="text" class="form-control" id="editPacienteApellidos" name="apellidos"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">CI:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editPacienteCI" name="ci" required>
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
                                    <input type="text" class="form-control" id="editPacienteDireccion" name="direccion">
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
    @foreach ($pacientes as $paciente)
        <div class="modal fade" id="viewPacienteModal{{ $paciente->id }}" tabindex="-1"
            aria-labelledby="viewPacienteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewPacienteModalLabel">Detalles del paciente:
                            {{ $paciente->nombres }} {{ $paciente->apellidos }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nombres:</strong> {{ $paciente->nombres }} {{ $paciente->apellidos }}</p>
                        <p><strong>CI:</strong> {{ $paciente->ci }}</p>
                        <p><strong>Fecha de nacimiento:</strong>
                            {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('Y-m-d') }}</p>

                        <p><strong>Celular:</strong> {{ $paciente->celular }}</p>
                        <p><strong>Correo:</strong> {{ $paciente->correo }}</p>
                        <p><strong>Dirección:</strong> {{ $paciente->direccion }}</p>
                        <p><strong>Grupo sanguíneo:</strong> {{ $paciente->grupo_sanguineo }}</p>
                        <p><strong>Contacto de emergencia:</strong> {{ $paciente->contacto_emergencia }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

                        <!-- Nombres -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombres:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nombres" required
                                    value="{{ old('nombres') }}">
                                @error('nombres')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Apellidos -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Apellidos:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="apellidos" required
                                    value="{{ old('apellidos') }}">
                                @error('apellidos')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- CI -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">CI:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ci" required
                                    value="{{ old('ci') }}">
                                @error('ci')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fecha de Nacimiento:</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="fecha_nacimiento" required
                                    value="{{ old('fecha_nacimiento') }}">
                                @error('fecha_nacimiento')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Celular -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Celular:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="celular" value="{{ old('celular') }}">
                                @error('celular')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Correo Electrónico:</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="correo" required
                                    value="{{ old('correo') }}">
                                @error('correo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dirección:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="direccion"
                                    value="{{ old('direccion') }}">
                                @error('direccion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Grupo Sanguíneo -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grupo Sanguíneo:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="grupo_sanguineo"
                                    value="{{ old('grupo_sanguineo') }}">
                                @error('grupo_sanguineo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contacto de Emergencia -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contacto de Emergencia:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contacto_emergencia"
                                    value="{{ old('contacto_emergencia') }}">
                                @error('contacto_emergencia')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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

            // Asegúrate que el ID existe
            if (!paciente.id) {

                return;
            }
            // Llenar los campos del formulario
            document.getElementById('editPacienteId').value = paciente.id;
            document.getElementById('editPacienteNombres').value = paciente.nombres;
            document.getElementById('editPacienteApellidos').value = paciente.apellidos;
            document.getElementById('editPacienteCI').value = paciente.ci;
            document.getElementById('editPacienteFechaNacimiento').value =
                '{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('Y-m-d') }}';

            document.getElementById('editPacienteCelular').value = paciente.celular;
            document.getElementById('editPacienteCorreo').value = paciente.correo;
            document.getElementById('editPacienteDireccion').value = paciente.direccion || '';
            document.getElementById('editPacienteGrupoSanguineo').value = paciente.grupo_sanguineo || '';
            document.getElementById('editPacienteContactoEmergencia').value = paciente.contacto_emergencia || '';

            // Actualizar la URL del formulario
            const form = document.getElementById('editPacienteForm');
            form.action = "{{ url('/pacientes') }}/" + paciente.id;

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

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ $errors->first() }}',
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#pacientesTable').DataTable({
                scrollX: true,
                ordering: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Todos"]
                ],
                // Ajusta el DOM para ubicar buscador y paginación
                dom: '<"row" <"col-sm-6"l><"col-sm-6 text-end"f> >' +
                    'rt' +
                    '<"row" <"col-sm-6"i><"col-sm-6 text-end"p> >',
                language: {
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    search: "<i class='fas fa-search'></i> Buscar:",
                    paginate: {
                        first: "<i class='fas fa-angle-double-left'></i>",
                        last: "<i class='fas fa-angle-double-right'></i>",
                        next: "<i class='fas fa-angle-right'></i>",
                        previous: "<i class='fas fa-angle-left'></i>"
                    }
                },
                initComplete: function() {
                    // Añadir clases de Bootstrap a los elementos de control
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

        });
    </script>
@endsection

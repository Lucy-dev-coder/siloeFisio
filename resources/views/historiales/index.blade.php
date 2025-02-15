@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Historiales Clínicos</h1>

    <!-- Botón para abrir el modal de nuevo historial -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearHistorialModal">
        Nuevo Historial
    </button>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabla de historiales -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Motivo de Consulta</th>
                <th>Registrado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historiales as $historial)
            <tr>
                <td>{{ $historial->id }}</td>
                <td>{{ $historial->paciente->nombres }} {{ $historial->paciente->apellidos }}</td>
                <td>{{ $historial->motivo_consulta }}</td>
                <td>{{ $historial->user->name ?? 'Desconocido' }}</td>
                <td>
                    <!-- Botón Ver -->
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verHistorialModal{{ $historial->id }}">
                        Ver
                    </button>

                    <!-- Botón Editar -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarHistorialModal{{ $historial->id }}">
                        Editar
                    </button>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('historiales.destroy', $historial) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Modal de Ver Detalles -->
            <div class="modal fade" id="verHistorialModal{{ $historial->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalles del Historial</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Paciente:</strong> {{ $historial->paciente->nombres }} {{ $historial->paciente->apellidos }}</p>
                            <p><strong>Motivo de Consulta:</strong> {{ $historial->motivo_consulta }}</p>
                            <p><strong>Registrado por:</strong> {{ $historial->user->name ?? 'Desconocido' }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de Editar Historial -->
            <div class="modal fade" id="editarHistorialModal{{ $historial->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Historial</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('historiales.update', $historial) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="motivo_consulta" class="form-label">Motivo de Consulta</label>
                                    <textarea name="motivo_consulta" class="form-control" rows="3" required>{{ $historial->motivo_consulta }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Actualizar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal de Nuevo Historial -->
<div class="modal fade" id="crearHistorialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Historial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('historiales.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="paciente_id" class="form-label">Paciente</label>
                        <select name="paciente_id" class="form-control" required>
                            <option value="">Seleccione un paciente</option>
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">{{ $paciente->nombres }} {{ $paciente->apellidos }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="motivo_consulta" class="form-label">Motivo de Consulta</label>
                        <textarea name="motivo_consulta" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

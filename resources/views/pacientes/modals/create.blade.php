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
                    <div class="mb-3">
                        <label class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombres" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CI</label>
                        <input type="text" class="form-control" name="ci" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nacimiento" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Celular</label>
                        <input type="text" class="form-control" name="celular" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grupo Sanguíneo</label>
                        <input type="text" class="form-control" name="grupo_sanguineo">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contacto de Emergencia</label>
                        <input type="text" class="form-control" name="contacto_emergencia">
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

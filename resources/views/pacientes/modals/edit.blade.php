<div class="modal fade" id="editPacienteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editPacienteForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editPacienteId" name="id">

                    <div class="mb-3">
                        <label class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="editPacienteNombres" name="nombres" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="editPacienteApellidos" name="apellidos" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CI</label>
                        <input type="text" class="form-control" id="editPacienteCI" name="ci" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="editPacienteFechaNacimiento" name="fecha_nacimiento" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Celular</label>
                        <input type="text" class="form-control" id="editPacienteCelular" name="celular" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="editPacienteCorreo" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="editPacienteDireccion" name="direccion">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grupo Sanguíneo</label>
                        <input type="text" class="form-control" id="editPacienteGrupoSanguineo" name="grupo_sanguineo">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contacto de Emergencia</label>
                        <input type="text" class="form-control" id="editPacienteContactoEmergencia" name="contacto_emergencia">
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editPaciente(paciente) {
        document.getElementById('editPacienteId').value = paciente.id;
        document.getElementById('editPacienteNombres').value = paciente.nombres;
        document.getElementById('editPacienteApellidos').value = paciente.apellidos;
        document.getElementById('editPacienteCI').value = paciente.ci;
        document.getElementById('editPacienteFechaNacimiento').value = paciente.fecha_nacimiento;
        document.getElementById('editPacienteCelular').value = paciente.celular;
        document.getElementById('editPacienteCorreo').value = paciente.correo;
        document.getElementById('editPacienteDireccion').value = paciente.direccion;
        document.getElementById('editPacienteGrupoSanguineo').value = paciente.grupo_sanguineo;
        document.getElementById('editPacienteContactoEmergencia').value = paciente.contacto_emergencia;

        document.getElementById('editPacienteForm').action = `/pacientes/${paciente.id}`;
    }
</script>

function validarFormulario() {
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const fecha = document.getElementById('fecha').value;
    const horaInicio = document.getElementById('hora_inicio').value;
    const horaFin = document.getElementById('hora_fin').value;

    if (nombre.trim() === '' || correo.trim() === '' || fecha.trim() === '' || horaInicio.trim() === '' || horaFin.trim() === '') {
        alert('Por favor, rellene todos los campos.');
        return false;
    }

    const inicio = new Date(fecha + ' ' + horaInicio);
    const fin = new Date(fecha + ' ' + horaFin);
    if (inicio >= fin) {
        alert('La hora de inicio debe ser antes de la hora de fin.');
        return false;
    }

    return true;
}
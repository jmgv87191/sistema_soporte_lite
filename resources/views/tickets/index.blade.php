@extends('adminlte::page')

@section('title', 'Crear Ticket')

@section('content_header')
    <h1>Crear nuevo Ticket</h1>
@stop

@section('content')
<form id="ticketForm">
    @csrf

    {{-- 🔹 Selector de tipo de problema --}}
    <div class="form-group">
        <label>Tipo de problema</label>
        <select id="title" class="form-control" required>
            <option value="">-- Selecciona un problema --</option>
            <option value="teclado">Problemas con teclado</option>
            <option value="mouse">Problemas con mouse</option>
            <option value="monitor">Problemas con monitor</option>
            <option value="CPU">Problemas con CPU</option>
            <option value="impresora">Problemas con impresora</option>
            <option value="internet">Problemas de red o internet</option>
            <option value="software">Problemas con software o aplicaciones</option>
            <option value="programas">Solicitud de instalación de programas</option>
            <option value="Mantenimiento">Mantenimiento preventivo del equipo</option>
            <option value="Otro tipo de problema">Otro tipo de problema</option>
        </select>
    </div>

    <div class="form-group">
        <label>Descripción</label>
        <textarea id="description" class="form-control" required placeholder="Describe el problema con detalle..."></textarea>
    </div>

    {{-- 🔹 Prioridad fija en "Baja" (solo informativa y oculta) --}}
    <div class="form-group" style="visibility: hidden">
        <label>Prioridad</label>
        <input type="text" class="form-control" value="Baja" disabled>
    </div>

    <button type="button" id="enviar" class="btn btn-primary mt-2">
        Crear Ticket
    </button>
</form>

<div id="respuesta" class="mt-3"></div>
@stop

@section('js')
<script>
document.getElementById('enviar').addEventListener('click', async function() {
    const token = localStorage.getItem('auth_token'); 

    if (!token) {
        alert("No hay token guardado en localStorage");
        return;
    }

    const data = {
        title: document.getElementById('title').value.trim(),
        description: document.getElementById('description').value.trim(),
        priority: "low"
    };

    if (!data.title || !data.description) {
        alert("Completa todos los campos antes de enviar.");
        return;
    }

    try {
        const response = await fetch('/ticketspinoy/public/api/ticket', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token, 
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            document.getElementById('respuesta').innerHTML = 
                `<div class="alert alert-success">${result.message}</div>`;
            document.getElementById('ticketForm').reset();
        } else {
            document.getElementById('respuesta').innerHTML = 
                `<div class="alert alert-danger">${result.message || 'Error al crear el ticket'}</div>`;
        }

        console.log(result);
    } catch (err) {
        console.error(err);
        document.getElementById('respuesta').innerHTML = 
            `<div class="alert alert-danger">Ocurrió un error en la conexión.</div>`;
    }
});
</script>
@stop

@section('js')
<script>
document.getElementById('enviar').addEventListener('click', async function() {

    const token = localStorage.getItem('auth_token'); 

    if (!token) {
        alert("No hay token guardado en localStorage");
        return;
    }

    const data = {
        title: document.getElementById('title').value.trim(),
        description: document.getElementById('description').value.trim(),
        priority: "low" // 🔹 Se fija la prioridad a "low"
    };

    if (!data.title || !data.description) {
        alert("Completa todos los campos antes de enviar.");
        return;
    }

    try {
        const response = await fetch('/ticketspinoy/public/api/ticket', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token, 
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            document.getElementById('respuesta').innerHTML = 
                `<div class="alert alert-success">${result.message}</div>`;
            document.getElementById('ticketForm').reset();
        } else {
            document.getElementById('respuesta').innerHTML = 
                `<div class="alert alert-danger">${result.message || 'Error al crear el ticket'}</div>`;
        }

        console.log(result);
    } catch (err) {
        console.error(err);
        document.getElementById('respuesta').innerHTML = 
            `<div class="alert alert-danger">Ocurrió un error en la conexión.</div>`;
    }
});
</script>
@stop

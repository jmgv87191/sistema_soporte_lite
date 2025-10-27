@extends('adminlte::page')

@section('title', 'Crear Ticket')

@section('content_header')
    <h1>Crear nuevo Ticket</h1>
@stop

@section('content')
<form id="ticketForm">
    @csrf

    <div class="form-group">
        <label>Título</label>
        <input type="text" id="title" class="form-control">
    </div>

    <div class="form-group">
        <label>Descripción</label>
        <textarea id="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Prioridad</label>
        <select id="priority" class="form-control">
            <option value="low">Baja</option>
            <option value="medium">Media</option>
            <option value="high">Alta</option>
        </select>
    </div>

    <button type="button" id="enviar" class="btn btn-primary">
        Crear Ticket
    </button>
</form>

<div id="respuesta" class="mt-3"></div>

@stop

@section('js')
<script>
document.getElementById('enviar').addEventListener('click', async function() {

    const token = localStorage.getItem('auth_token'); 

    if(!token) {
        alert("No hay token guardado en localStorage");
        return;
    }

    const data = {
        title: document.getElementById('title').value,
        description: document.getElementById('description').value,
        priority: document.getElementById('priority').value,
    };

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

    document.getElementById('respuesta').innerHTML =
        `<pre>${JSON.stringify(result, null, 2)}</pre>`;

});
</script>
@stop

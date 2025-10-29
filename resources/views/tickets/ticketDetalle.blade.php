@extends('adminlte::page')

@section('title', 'Detalle Ticket')

@section('content_header')
    <h1>Detalle del Ticket</h1>
@stop

@section('content')
<div id="ticketDetalle" class="card">
    <div class="card-body">
        <h3 id="title"></h3>
        <p><strong>Código:</strong> <span id="code"></span></p>
        <p><strong>Descripción:</strong> <span id="description"></span></p>
        <p><strong>Prioridad:</strong> <span id="priority" class="badge"></span></p>

        <div id="statusContainer">
            <p><strong>Estado:</strong> <span id="status"></span></p>
        </div>

        <p><strong>Fecha:</strong> <span id="created_at"></span></p>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header"><strong>Respuestas</strong></div>
    <div class="card-body" id="repliesContainer"></div>
</div>

<div class="card mt-4">
    <div class="card-header"><strong>Responder Ticket</strong></div>
    <div class="card-body">
        <textarea id="replyContent" class="form-control" placeholder="Escribe tu respuesta..."></textarea>
        <button id="sendReply" class="btn btn-primary mt-2">Enviar respuesta</button>
    </div>
</div>

<div class="mt-4" id="adminActions" style="display: none;">
    <div class="card">
        <div class="card-header"><strong>Acciones del administrador</strong></div>
        <div class="card-body">
            <label for="statusSelect">Cambiar estado:</label>
            <select id="statusSelect" class="form-select mb-3">
                <option value="open">Abierto</option>
                <option value="onprogress">En progreso</option>
                <option value="rejected">Rechazado</option>
            </select>

            <button id="updateStatus" class="btn btn-warning me-2">Actualizar estado</button>
            <button id="closeTicket" class="btn btn-danger">Cerrar ticket</button>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const token = localStorage.getItem('auth_token');
    const user = JSON.parse(localStorage.getItem('user')); // <- debes guardar user en localStorage al loguear
    const code = window.location.pathname.split('/').pop();

    if (!token) {
        alert("No hay token guardado.");
        return;
    }

    const ticketRes = await fetch(`http://localhost/ticketspinoy/public/api/ticket/${code}`, {
        headers: { "Authorization": "Bearer " + token }
    });

    const result = await ticketRes.json();
    const ticket = result.data;

    // Mostrar datos generales
    document.getElementById('title').textContent = ticket.title;
    document.getElementById('code').textContent = ticket.code;
    document.getElementById('description').textContent = ticket.description;
    document.getElementById('priority').textContent = ticket.priority;
    document.getElementById('priority').classList.add(
        ticket.priority === 'high' ? 'bg-danger' :
        ticket.priority === 'medium' ? 'bg-warning' : 'bg-success'
    );
    document.getElementById('status').textContent = ticket.status ?? 'open';
    document.getElementById('created_at').textContent = new Date(ticket.created_at).toLocaleString();

    // Mostrar respuestas
    const repliesContainer = document.getElementById('repliesContainer');
    repliesContainer.innerHTML = '';

    if (ticket.ticket_replies && ticket.ticket_replies.length > 0) {
        ticket.ticket_replies.forEach(reply => {
            const div = document.createElement('div');
            div.classList.add('border', 'p-2', 'mb-2', 'rounded');
            div.innerHTML = `
                <p><strong>${reply.user.name}</strong> (${new Date(reply.created_at).toLocaleString()})</p>
                <p>${reply.content}</p>
            `;
            repliesContainer.appendChild(div);
        });
    } else {
        repliesContainer.innerHTML = '<p>No hay respuestas aún.</p>';
    }

    // Si es admin, mostrar las acciones
    if (user && user.role === 'admin') {
        document.getElementById('adminActions').style.display = 'block';
        document.getElementById('statusSelect').value = ticket.status ?? 'open';
    }

    // Enviar respuesta
    document.getElementById('sendReply').addEventListener('click', async () => {
        const content = document.getElementById('replyContent').value.trim();
        const status = user.role === 'admin' ? document.getElementById('statusSelect').value : ticket.status;

        if (!content) {
            alert("Escribe algo antes de enviar.");
            return;
        }

        const response = await fetch(`http://localhost/ticketspinoy/public/api/ticket-reply/${code}`, {
            method: 'POST',
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ content, status })
        });

        const replyData = await response.json();
        alert(replyData.message);
        location.reload();
    });

    // Actualizar estado manualmente (solo admin)
    document.getElementById('updateStatus').addEventListener('click', async () => {
        const status = document.getElementById('statusSelect').value;

        const response = await fetch(`http://localhost/ticketspinoy/public/api/ticket-reply/${code}`, {
            method: 'POST',
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                content: "Cambio de estado a " + status,
                status: status
            })
        });

        const data = await response.json();
        alert(data.message);
        location.reload();
    });

    // Cerrar ticket (solo admin)
    document.getElementById('closeTicket').addEventListener('click', async () => {
        if (!confirm("¿Seguro que quieres cerrar este ticket?")) return;

        const response = await fetch(`http://localhost/ticketspinoy/public/api/ticket-reply/${code}`, {
            method: 'POST',
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                content: "Ticket cerrado por el administrador.",
                status: "resolved"
            })
        });

        const data = await response.json();
        alert(data.message);
        location.reload();
    });
});



/* logout */
document.addEventListener('DOMContentLoaded', function() {
    const logoutBtn = document.querySelector('.logout-btn');
    if(logoutBtn) {
        logoutBtn.addEventListener('click', async function(e) {
            e.preventDefault();
            const token = localStorage.getItem('auth_token');
            if(!token) return alert('No hay token guardado');

            try {
                const res = await fetch('/ticketspinoy/public/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const result = await res.json();
                if(res.ok) {
                    localStorage.removeItem('auth_token');
                    localStorage.removeItem('user');
                    window.location.href = '/ticketspinoy/public/login';
                } else {
                    alert(result.message || 'Error al cerrar sesión');
                }

            } catch(err) {
                console.error(err);
                alert('Error de conexión');
            }
        });
    }
});



</script>
@stop

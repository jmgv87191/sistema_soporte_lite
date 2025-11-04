@extends('adminlte::page')

@section('title', 'Buscar Ticket')

@section('content_header')
<h1>Buscar Ticket</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="form-group">
            <input type="text" id="ticketCode" class="form-control" placeholder="Ingresa el código del ticket">
        </div>
        <button id="searchTicket" class="btn btn-primary mt-2">Buscar</button>
    </div>
</div>

<div id="ticketResult" class="card mt-4 d-none">
    <div class="card-body">
        <h3 id="title"></h3>
        <p><strong>Código:</strong> <span id="code"></span></p>
        <p><strong>Descripción:</strong> <span id="description"></span></p>
        <p><strong>Estado:</strong> <span id="status"></span></p>
        <p><strong>Fecha:</strong> <span id="created_at"></span></p>

        <div id="repliesSection" class="mt-4">
            <h5>Respuestas del Ticket</h5>
            <ul id="repliesList" class="list-group"></ul>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const token = localStorage.getItem('auth_token');

    if(!token){
        alert("No hay token guardado.");
        window.location.href = "/sistema_soporte_lite/public/login";
        return;
    }

    const searchBtn = document.getElementById('searchTicket');
    const ticketResult = document.getElementById('ticketResult');
    const repliesList = document.getElementById('repliesList');

    searchBtn.addEventListener('click', async () => {
        const code = document.getElementById('ticketCode').value.trim();
        if(!code){
            alert("Ingresa un código de ticket.");
            return;
        }

        try {
            const res = await fetch(`http://localhost/sistema_soporte_lite/public/api/ticket/${code}`, {
                headers: { "Authorization": "Bearer " + token }
            });

            const result = await res.json();

            if(res.ok){
                const ticket = result.data;

                document.getElementById('title').textContent = ticket.title;
                document.getElementById('code').textContent = ticket.code;
                document.getElementById('description').textContent = ticket.description;
                document.getElementById('status').textContent = ticket.status;
                document.getElementById('created_at').textContent = new Date(ticket.created_at).toLocaleString();

                // Replies
// Replies
repliesList.innerHTML = '';
if (ticket.ticket_replies && ticket.ticket_replies.length > 0) {
    ticket.ticket_replies.forEach(reply => {
        const li = document.createElement('li');
        li.classList.add('list-group-item');

        const userName = reply.user?.name || `Usuario #${reply.user_id || 'desconocido'}`;
        const message = reply.content || '(Sin mensaje)'; // 🔹 aquí cambiamos a "content"
        const date = reply.created_at ? new Date(reply.created_at).toLocaleString() : 'Fecha desconocida';

        li.innerHTML = `
            <strong>${userName}</strong> 
            <span class="text-muted">(${date})</span><br>
            ${message}
        `;
        repliesList.appendChild(li);
    });
} else {
    repliesList.innerHTML = '<li class="list-group-item text-muted">No hay respuestas todavía.</li>';
}


                ticketResult.classList.remove('d-none');

            } else {
                ticketResult.classList.add('d-none');
                alert(result.message || "No se encontró el ticket.");
            }
        } catch(err){
            console.error(err);
            alert("Error al buscar el ticket.");
        }
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
                const res = await fetch('/sistema_soporte_lite/public/api/logout', {
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
                    window.location.href = '/sistema_soporte_lite/public/login';
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

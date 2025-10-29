@extends('adminlte::page')

@section('title', 'Mis Tickets')

@section('content_header')
    <h1>Listado de Tickets</h1>
@stop

@section('content')
    <div class="table-responsive">
        <table class="table table-striped" id="ticketsTable">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const token = localStorage.getItem('auth_token');

    if (!token) {
        alert("No hay token guardado. Inicia sesión primero.");
        return;
    }

    try {
        const response = await fetch('http://localhost/ticketspinoy/public/api/ticket', {
            method: 'GET',
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        });

        const data = await response.json();
        console.log(data);

        const tbody = document.querySelector('#ticketsTable tbody');
        tbody.innerHTML = '';

        if (data.data && data.data.length > 0) {
            data.data.forEach(ticket => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${ticket.code}</td>
                    <td>${ticket.title}</td>
                    <td>${ticket.description}</td>
                    <td>
                        <span class="badge 
                            ${ticket.priority === 'high' ? 'bg-danger' : 
                            ticket.priority === 'medium' ? 'bg-warning' : 'bg-success'}">
                            ${ticket.priority}
                        </span>
                    </td>
                    <td>${ticket.status ?? 'open'}</td>
                    <td>${new Date(ticket.created_at).toLocaleString()}</td>
                `;

                row.style.cursor = 'pointer';
                row.addEventListener('click', () => {
                    window.location.href = `/ticketspinoy/public/ticket/${ticket.code}`;
                });

                tbody.appendChild(row);
            });
        } else {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center">No hay tickets disponibles</td></tr>';
        }

    } catch (error) {
        console.error("Error al cargar los tickets:", error);
    }

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

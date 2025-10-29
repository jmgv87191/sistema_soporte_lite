@extends('adminlte::page')

@section('title', 'Crear Ticket')

@section('content_header')
    <h1>Crear nuevo Ticket</h1>
@stop

@section('content')
<form id="ticketForm">
    @csrf

    {{-- 🔹 Selector de categoría --}}
    <div class="form-group">
        <label>Categoría</label>
        <select id="categoria" class="form-control" required>
            <option value="">-- Selecciona una categoría --</option>
            <option value="hardware">Hardware</option>
            <option value="software">Software</option>
            <option value="redes">Redes</option>
        </select>
    </div>

    {{-- 🔹 Selector de tipo de problema según categoría --}}
    <div class="form-group" id="tipoProblemaContainer" style="display:none;">
        <label>Tipo de problema</label>
        <select id="tipoProblema" class="form-control" required>
            <option value="">-- Selecciona un problema --</option>
        </select>
    </div>

    {{-- 🔹 Subproblemas dinámicos --}}
    <div class="form-group" id="subproblemaContainer" style="display:none;">
        <label>Detalle del problema</label>
        <select id="detalleProblema" class="form-control" required>
            <option value="">-- Selecciona una opción --</option>
        </select>
    </div>

    {{-- 🔹 Campos manuales (solo si elige “otro”) --}}
    <div class="form-group" id="otroProblemaContainer" style="display:none;">
        <label>Especifica el tipo de problema</label>
        <input type="text" id="otroTipo" class="form-control" placeholder="Ejemplo: Fuente de poder" />

        <label class="mt-2">Detalle del problema</label>
        <input type="text" id="otroDetalle" class="form-control" placeholder="Ejemplo: No enciende correctamente" />
    </div>

    {{-- 🔹 Prioridad fija en "Baja" (oculta) --}}
    <div class="form-group" style="visibility: hidden">
        <label>Prioridad</label>
        <input type="text" class="form-control" value="Baja" disabled>
    </div>

    <button type="button" id="enviar" class="btn btn-primary mt-2">
        Crear Ticket
    </button>
</form>

{{-- 🔹 Modal de mensaje bloqueante --}}
<div id="modalMensaje" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:white; padding:20px 30px; border-radius:10px; position:relative; width:400px; text-align:center;">
        <button id="cerrarModal" 
                style="position:absolute; top:10px; right:15px; border:none; background:none; font-size:20px; cursor:pointer;">
            &times;
        </button>
        <h4 id="modalTitulo"></h4>
        <p id="modalTexto"></p>
    </div>
</div>
@stop

@section('js')
<script>
// 🔹 Datos de subproblemas según categoría
const opcionesPorCategoria = {
    hardware: {
        cpu: ["El CPU no enciende", "El CPU se apaga", "El CPU se reinicia", "El CPU hace ruido"],
        teclado: ["El teclado no funciona", "Algunas teclas no funcionan"],
        mouse: ["El mouse no funciona nada", "El mouse funciona mal"],
        regulador: ["El regulador hace ruido", "El regulador no funciona"],
        monitor: ["El monitor no prende", "El monitor se ve mal"],
        impresora: ["La impresora no prende", "Papel atascado","Imprime mal"],
    },
    software: {
        software: ["Mi Office no funciona", "Windows se reinicia", "Pantalla azul", "Compaq con problemas"]
    },
    redes: {
        redes: ["Mi cable no funciona","cable dañado", "No tengo internet"]
    }
};

// 🔹 Cuando cambia la categoría
document.getElementById('categoria').addEventListener('change', function() {
    const cat = this.value;
    const tipoContainer = document.getElementById('tipoProblemaContainer');
    const tipoSelect = document.getElementById('tipoProblema');
    const subContainer = document.getElementById('subproblemaContainer');
    const subSelect = document.getElementById('detalleProblema');
    const otroContainer = document.getElementById('otroProblemaContainer');

    tipoSelect.innerHTML = '<option value="">-- Selecciona un problema --</option>';
    subSelect.innerHTML = '<option value="">-- Selecciona una opción --</option>';
    tipoContainer.style.display = 'none';
    subContainer.style.display = 'none';
    otroContainer.style.display = 'none';

    if (!cat) return;

    // Llenar tipo de problema según categoría
    const tipos = Object.keys(opcionesPorCategoria[cat]);
    tipos.forEach(t => {
        const option = document.createElement('option');
        option.value = t;
        option.textContent = t.charAt(0).toUpperCase() + t.slice(1);
        tipoSelect.appendChild(option);
    });
    tipoContainer.style.display = 'block';
});

// 🔹 Cuando cambia el tipo de problema
document.getElementById('tipoProblema').addEventListener('change', function() {
    const cat = document.getElementById('categoria').value;
    const tipo = this.value;
    const subContainer = document.getElementById('subproblemaContainer');
    const subSelect = document.getElementById('detalleProblema');
    const otroContainer = document.getElementById('otroProblemaContainer');

    subSelect.innerHTML = '<option value="">-- Selecciona una opción --</option>';
    subContainer.style.display = 'none';
    otroContainer.style.display = 'none';

    if (tipo === 'otro') {
        otroContainer.style.display = 'block';
    } else if (opcionesPorCategoria[cat][tipo]) {
        opcionesPorCategoria[cat][tipo].forEach(texto => {
            const option = document.createElement('option');
            option.value = texto;
            option.textContent = texto;
            subSelect.appendChild(option);
        });
        subContainer.style.display = 'block';
    }
});

// 🔹 Enviar ticket
document.getElementById('enviar').addEventListener('click', async function() {
    const token = localStorage.getItem('auth_token');
    if (!token) { alert("No hay token guardado"); return; }

    const tipo = document.getElementById('tipoProblema').value.trim();
    const detalle = document.getElementById('detalleProblema').value.trim();
    const otroTipo = document.getElementById('otroTipo').value.trim();
    const otroDetalle = document.getElementById('otroDetalle').value.trim();

    let title = '';
    let description = '';

    if (tipo === 'otro') {
        if (!otroTipo || !otroDetalle) { alert("Completa campos de problema personalizado"); return; }
        title = otroTipo;
        description = otroDetalle;
    } else {
        if (!tipo) { alert("Selecciona un tipo de problema"); return; }
        title = tipo;
        description = detalle ? detalle : tipo;
    }

    const data = { title, description, priority: "low" };

    try {
        const response = await fetch('/ticketspinoy/public/api/ticket', {
            method: 'POST',
            headers: { "Content-Type":"application/json","Authorization":"Bearer "+token,"Accept":"application/json" },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            mostrarModal(`✅ Ticket creado exitosamente`, `Tu código de ticket es: <strong>${result.data?.code || 'N/A'}</strong>`);
            document.getElementById('ticketForm').reset();
            document.getElementById('tipoProblemaContainer').style.display='none';
            document.getElementById('subproblemaContainer').style.display='none';
            document.getElementById('otroProblemaContainer').style.display='none';
        } else {
            mostrarModal(`❌ Error`, result.message || 'Error al crear el ticket');
        }
    } catch(err) {
        console.error(err);
        mostrarModal(`⚠️ Error de conexión`, `Ocurrió un problema con la conexión al servidor.`);
    }
});

// 🔹 Modal bloqueante
function mostrarModal(titulo, mensaje) {
    const modal = document.getElementById('modalMensaje');
    document.getElementById('modalTitulo').innerHTML = titulo;
    document.getElementById('modalTexto').innerHTML = mensaje;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
document.getElementById('cerrarModal').addEventListener('click', function() {
    document.getElementById('modalMensaje').style.display = 'none';
    document.body.style.overflow = 'auto';
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

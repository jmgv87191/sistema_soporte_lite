@extends('adminlte::page')

@section('title', 'Crear Ticket')

@section('content_header')
    <h1>Crear nuevo Ticket</h1>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')


<form id="ticketForm">
    @csrf

    <div class="form-group" id="nameContainer">
        <label>Nombre</label>
        <input type="text" id="name" class="form-control" placeholder="Juan" />
    </div>

{{--     <div class="form-group" id="areaContainer" >
        <label>Area</label>
        <input type="text" id="area" class="form-control" placeholder="general" />
    </div> --}}


        <div class="form-group">
        <label for="area" >Area</label>
        <select id="area" name="area" class="form-control" required>
            <option value="">-- Selecciona el area a la que perteneces --</option>
            <option value="DIRECTOR GENERAL">DIRECTOR GENERAL</option>
            <option value="SECRETARÍA TÉCNICA">SECRETARÍA TÉCNICA</option>
            <option value="SECRETARÍA EJECUTIVA">SECRETARÍA EJECUTIVA</option>
            <option value="COORDINACIÓN DE POTABILIZACIÓN Y TRATAMIENTO">COORDINACIÓN DE POTABILIZACIÓN Y TRATAMIENTO</option>
            <option value="DEPARTAMENTO DE MANTENIMIENTO GENERAL">DEPARTAMENTO DE MANTENIMIENTO GENERAL</option>
            <option value="DEPARTAMENTO LABORATORIO">DEPARTAMENTO LABORATORIO</option>
            <option value="DEPARTAMENTO DE CALIDAD Y PROCESOS DE PTAR">DEPARTAMENTO DE CALIDAD Y PROCESOS DE PTAR</option>
            <option value="DEPARTAMENTO DE CALIDAD Y PROCESOS DE POTABILIZACIÓN">DEPARTAMENTO DE CALIDAD Y PROCESOS DE POTABILIZACIÓN</option>
            <option value="UNIDAD DE APOYO ADMINISTRATIVO">UNIDAD DE APOYO ADMINISTRATIVO</option>
            <option value="COORDINACIÓN DE SISTEMAS FORÁNEOS">COORDINACIÓN DE SISTEMAS FORÁNEOS</option>
            <option value="UNIDAD DE MEJORA REGULATORIA">UNIDAD DE MEJORA REGULATORIA</option>
            <option value="ASESORÍA JURÍDICA">ASESORÍA JURÍDICA</option>
            <option value="CONTRALORÍA INTERNA">CONTRALORÍA INTERNA</option>
            <option value="COMUNICACIÓN SOCIAL Y CULTURA DEL AGUA">COMUNICACIÓN SOCIAL Y CULTURA DEL AGUA</option>
            <option value="DIRECCIÓN ADMINISTRATIVA Y FINANCIERA">DIRECCIÓN ADMINISTRATIVA Y FINANCIERA</option>
            <option value="COORDINACIÓN DE RECURSOS FINANCIEROS">COORDINACIÓN DE RECURSOS FINANCIEROS</option>
            <option value="DEPARTAMENTO DE TESORERÍA">DEPARTAMENTO DE TESORERÍA</option>
            <option value="DEPARTAMENTO DE PROGRAMACIÓN Y PRESUPUESTO">DEPARTAMENTO DE PROGRAMACIÓN Y PRESUPUESTO</option>
            <option value="DEPARTAMENTO DE CONTABILIDAD">DEPARTAMENTO DE CONTABILIDAD</option>
            <option value="COORDINACIÓN DE RECURSOS MATERIALES">COORDINACIÓN DE RECURSOS MATERIALES</option>
            <option value="DEPARTAMENTO DE ADQUISICIONES">DEPARTAMENTO DE ADQUISICIONES</option>
            <option value="DEPARTAMENTO DE ALMACÉN">DEPARTAMENTO DE ALMACÉN</option>
            <option value="DEPARTAMENTO DE INVENTARIOS">DEPARTAMENTO DE ALMACÉN</option>
            <option value="DEPARTAMENTO DE TALLER Y PARQUE VEHICULAR">DEPARTAMENTO DE TALLER Y PARQUE VEHICULAR</option>
            <option value="DEPARTAMENTO DE SERVICIOS GENERALES">DEPARTAMENTO DE SERVICIOS GENERALES</option>
            <option value="DEPARTAMENTO DE ARCHIVO">DEPARTAMENTO DE ARCHIVO</option>
            <option value="COORDINACIÓN DE RECURSOS HUMANOS">COORDINACIÓN DE RECURSOS HUMANOS</option>
            <option value="DEPARTAMENTO DE ADMINISTRACIÓN DE PERSONAL">DEPARTAMENTO DE ADMINISTRACIÓN DE PERSONAL</option>
            <option value="CONTRATACIÓN Y NÓMINA">CONTRATACIÓN Y NÓMINA</option>
            <option value="CAPACITACIÓN Y EVALUACIÓN AL DESEMPEÑO">CAPACITACIÓN Y EVALUACIÓN AL DESEMPEÑO</option>
            <option value="DEPARTAMENTO DE INFORMÁTICA">DEPARTAMENTO DE INFORMÁTICA</option>
            <option value="UNIDAD DE SOPORTE TÉCNICO">UNIDAD DE SOPORTE TÉCNICO</option>
            <option value="UNIDAD DE PROGRAMACIÓN">UNIDAD DE PROGRAMACIÓN</option>
            <option value="UNIDAD DE APOYO ADMINISTRATIVO">UNIDAD DE APOYO ADMINISTRATIVO</option>
            <option value="DIRECCIÓN COMERCIAL">DIRECCIÓN COMERCIAL</option>
            <option value="COORDINACIÓN DE PADRÓN DE USUARIOS">COORDINACIÓN DE PADRÓN DE USUARIOS</option>
            <option value="JEFATURA DE ADMINISTRACIÓN DEL PADRÓN DE USUARIOS">JEFATURA DE ADMINISTRACIÓN DEL PADRÓN DE USUARIOS</option>
            <option value="JEFATURA DE CONTRATACIÓN">JEFATURA DE CONTRATACIÓN</option>
            <option value="COORDINACIÓN DE FACTURACIÓN Y MEDICIÓN">COORDINACIÓN DE FACTURACIÓN Y MEDICIÓN</option>
            <option value="JEFATURA DE MEDICIÓN">JEFATURA DE MEDICIÓN</option>
            <option value="JEFATURA DE FACTURACIÓN">JEFATURA DE FACTURACIÓN</option>
            <option value="COORDINACIÓN DEL CONTROL DEL REZAGO">COORDINACIÓN DEL CONTROL DEL REZAGO</option>
            <option value="JEFATURA DE SANCIÓN A USUARIOS">JEFATURA DE SANCIÓN A USUARIOS</option>
            <option value="JEFATURA DE REANUDACIÓN DE SERVICIOS">JEFATURA DE REANUDACIÓN DE SERVICIOS</option>
            <option value="COORDINACIÓN DE ATENCIÓN A USUARIOS">COORDINACIÓN DE ATENCIÓN A USUARIOS</option>
            <option value="JEFATURA DE CAJAS">JEFATURA DE CAJAS</option>
            <option value="JEFATURA DE OFICINAS COMERCIALES">JEFATURA DE OFICINAS COMERCIALES</option>
            <option value="UNIDAD DE APOYO ADMINISTRATIVO">UNIDAD DE APOYO ADMINISTRATIVO</option>
            <option value="DIRECCIÓN OPERATIVA">DIRECCIÓN OPERATIVA</option>
            <option value="COORDINACIÓN DE AGUA POTABLE">COORDINACIÓN DE AGUA POTABLE</option>
            <option value="UNIDAD DE CONTROL Y TELEMETRÍA">UNIDAD DE CONTROL Y TELEMETRÍA</option>
            <option value="DEPARTAMENTO DE CONTROL DE GARZAS Y DISTRIBUCIÓN DE AGUA EN PIPAS">
                DEPARTAMENTO DE CONTROL DE GARZAS Y DISTRIBUCIÓN DE AGUA EN PIPAS</option>
            <option value="DEPARTAMENTO DE REPARACIÓN DE FUGAS">DEPARTAMENTO DE REPARACIÓN DE FUGAS</option>
            <option value="DEPARTAMENTO DE CONTROL DE VÁLVULAS, BASES DE BOMBEO Y TANQUES">DEPARTAMENTO DE CONTROL DE VÁLVULAS, BASES DE BOMBEO Y TANQUES</option>
            <option value="CORDINACIÓN DE ALCANTARILLADO">CORDINACIÓN DE ALCANTARILLADO</option>
            <option value="DEPARTAMENTO DE MANTENIMIENTO DE REDES Y ATENCIÓN A DERRAMES">
                DEPARTAMENTO DE MANTENIMIENTO DE REDES Y ATENCIÓN A DERRAMES
            </option>
            <option value="DEPARTAMENTO DE OPERACIÓN DE CÁRCAMOS">
                DEPARTAMENTO DE OPERACIÓN DE CÁRCAMOS
            </option>
            <option value="COORDINACIÓN DE ELECTROMECÁNICA">
                COORDINACIÓN DE ELECTROMECÁNICA
            </option>
            <option value="UNIDAD DE APOYO TÉCNICO Y PLANEACIÓN">
                UNIDAD DE APOYO TÉCNICO Y PLANEACIÓN
            </option>
            <option value="UNIDAD DE APOYO ADMINISTRATIVO">
                UNIDAD DE APOYO ADMINISTRATIVO
            </option>
            <option value="DIRECCIÓN TÉCNICA">
                DIRECCIÓN TÉCNICA
            </option>
            <option value="DEPARTAMENTO DE FACTIBILIDADES">
                DEPARTAMENTO DE FACTIBILIDADES
            </option>
            <option value="DEPARTAMENTO DE ESTUDIOS Y PROYECTOS">
                DEPARTAMENTO DE ESTUDIOS Y PROYECTOS
            </option>
            <option value="DEPARTAMENTO DE CONTRATACIÓN Y SEGUIMIENTO DE OBRA">
                DEPARTAMENTO DE CONTRATACIÓN Y SEGUIMIENTO DE OBRA
            </option>
            <option value="DEPARTAMENTO DE CONTRATACIÓN Y SEGUIMIENTO DE OBRA">
                DEPARTAMENTO DE CONSTRUCCIÓN
            </option>
            <option value="UNIDAD DE APOYO ADMINISTRATIVO">
                UNIDAD DE APOYO ADMINISTRATIVO
            </option>
            <option value="UNIDAD DE PROMOCIÓN DE OBRAS">
                UNIDAD DE PROMOCIÓN DE OBRAS
            </option>
        </select>
    </div>


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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
// 🔹 Inicializar Select2
$(document).ready(function() {
    $('#area').select2({
        width: 'resolve',
        placeholder: 'Selecciona el área a la que perteneces',
        theme: 'classic',
        allowClear: true,
    });
});


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
    const nameContainer = document.getElementById('nameContainer');
    const areaContainer = document.getElementById('areaContainer');

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
const name = document.getElementById('name').value.trim();
const area = document.getElementById('area').value.trim();


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

    const data = { title, description, priority: "low",name,area };

    try {
        const response = await fetch('/sistema_soporte_lite/public/api/ticket', {
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

    document.addEventListener("DOMContentLoaded", () => cargarDashboard());


        const token = localStorage.getItem("auth_token");

    async function cargarDashboard(filtro = "") {
        if (!token) {
            alert("No estás autenticado. Inicia sesión.");
            window.location.href = "/sistema_soporte_lite/public/login";
            return;
        }


    }

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


<script>
    const userRole = @json(auth()->user()->role);
    console.log("Rol del usuario:", userRole);
</script>
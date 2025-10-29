@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
    }
    h1 {
      text-align: center;
      color: #333;
    }
    .stats {
      display: flex;
      justify-content: space-around;
      margin-bottom: 40px;
    }
    .card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      width: 200px;
      text-align: center;
    }
    canvas {
      display: block;
      margin: 0 auto;
      max-width: 400px;
    }
    #filter {
      display: block;
      margin: 20px auto;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>

  <h1 style="margin: 50px 0;">Dashboard - Administrador</h1>

  {{-- 🔹 FILTRO POR TÍTULO --}}
  <div style="text-align: center;">
    <label for="filter">Filtrar por tipo de problema:</label>
    <select id="filter">
      <option value="">-- Todos los tickets --</option>
      <option value="teclado">Problemas con teclado</option>
      <option value="mouse">Problemas con mouse</option>
      <option value="monitor">Problemas con monitor</option>
      <option value="cpu">Problemas con CPU</option>
      <option value="impresora">Problemas con impresora</option>
      <option value="red">Problemas de red o internet</option>
      <option value="correo">Problemas con correo electrónico</option>
      <option value="software">Problemas con software o aplicaciones</option>
      <option value="instalacion">Solicitud de instalación de programas</option>
      <option value="mantenimiento">Mantenimiento preventivo</option>
    </select>
  </div>

  <div class="stats">
    <div class="card">
      <h3>Total Tickets</h3>
      <p id="total_tickets">0</p>
    </div>
    <div class="card">
      <h3>Activos</h3>
      <p id="active_tickets">0</p>
    </div>
    <div class="card">
      <h3>Resueltos</h3>
      <p id="resolved_tickets">0</p>
    </div>
  </div>

  <canvas id="statusChart"></canvas>

  <script>
    const token = localStorage.getItem("auth_token");
    let chart; // Guardamos la instancia de la gráfica

    async function cargarDashboard(filtro = "") {
      if (!token) {
        alert("No estás autenticado. Inicia sesión.");
        window.location.href = "/ticketspinoy/public/login";
        return;
      }

      try {
        // 🔹 Construimos la URL con el parámetro de filtro si existe
        let url = "http://localhost/ticketspinoy/public/api/dashboard/statistics";
        if (filtro) {
          url += "?title=" + encodeURIComponent(filtro);
        }

        const res = await fetch(url, {
          headers: { "Authorization": `Bearer ${token}` }
        });

        const result = await res.json();

        if (!res.ok) {
          alert("Error al obtener estadísticas del dashboard.");
          console.error(result);
          return;
        }

        const data = result.data;
        document.getElementById("total_tickets").textContent = data.total_tickets;
        document.getElementById("active_tickets").textContent = data.active_tickets;
        document.getElementById("resolved_tickets").textContent = data.resolved_tickets;

        // 🔹 Si ya hay una gráfica, destrúyela antes de crear otra
        if (chart) chart.destroy();

        const ctx = document.getElementById("statusChart");
        chart = new Chart(ctx, {
          type: "doughnut",
          data: {
            labels: Object.keys(data.status_distribution),
            datasets: [{
              data: Object.values(data.status_distribution),
              backgroundColor: ["#36a2eb", "#ffcd56", "#4bc0c0", "#ff6384"]
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: "bottom" }
            }
          }
        });

      } catch (error) {
        console.error("Error al cargar el dashboard:", error);
        alert("No se pudo conectar con el servidor.");
      }
    }

    // 🔹 Evento: cuando cambia el filtro, recarga los datos
    document.getElementById("filter").addEventListener("change", (e) => {
      const filtro = e.target.value;
      cargarDashboard(filtro);
    });

    // 🔹 Cargar dashboard al inicio
    document.addEventListener("DOMContentLoaded", () => cargarDashboard());
  </script>
</body>
</html>
@stop

@section('css')
@stop

@section('js')
@stop

<script>
const userRole = @json(auth()->user()->role);
console.log("Rol del usuario:", userRole);
</script>

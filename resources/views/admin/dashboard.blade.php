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
    #logout {
      display: block;
      margin: 20px auto;
      background-color: #d33;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    #logout:hover {
      background-color: #b22;
    }
  </style>
</head>
<body>
  <h1 style="margin: 50px 0;" >Dashboard - Administrador</h1>
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

  <button id="logout">Cerrar sesión</button>

  <script>
    document.addEventListener("DOMContentLoaded", async () => {
      const token = localStorage.getItem("auth_token");

      if (!token) {
        alert("No estás autenticado. Inicia sesión.");
        window.location.href = "/ticketspinoy/public/login";
        return;
      }

      try {
        const res = await fetch("http://localhost/ticketspinoy/public/api/dashboard/statistics", {
          headers: {
            "Authorization": `Bearer ${token}`
          }
        });

        const result = await res.json();

        if (!res.ok) {
          alert("Error al obtener estadísticas del dashboard.");
          console.error(result);
          return;
        }

        // Mostrar los valores
        const data = result.data;
        document.getElementById("total_tickets").textContent = data.total_tickets;
        document.getElementById("active_tickets").textContent = data.active_tickets;
        document.getElementById("resolved_tickets").textContent = data.resolved_tickets;

        // Gráfica de estado de tickets
        const ctx = document.getElementById("statusChart");
        new Chart(ctx, {
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
    });

    document.getElementById("logout").addEventListener("click", () => {
      console.log('loguot')
/*       localStorage.removeItem("auth_token");
      window.location.href = "/ticketspinoy/public/";
 */    });
  </script>
</body>
</html>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

<script>
    const userRole = @json(auth()->user()->role);
    console.log("Rol del usuario:", userRole);

</script>
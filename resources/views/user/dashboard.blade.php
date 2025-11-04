@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')



  <script>
    const token = localStorage.getItem("auth_token");

    async function cargarDashboard(filtro = "") {
      if (!token) {
        alert("No estás autenticado. Inicia sesión.");
        window.location.href = "/sistema_soporte_lite/public/login";
        return;
      }


    }



    // 🔹 Cargar dashboard al inicio
    document.addEventListener("DOMContentLoaded", () => cargarDashboard());

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
</body>
</html>
@stop




@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')


@stop

<script>
    const userRole = @json(auth()->user()->role);
    console.log("Rol del usuario:", userRole);
    
</script>

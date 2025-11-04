@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')



@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')



    <script>




/* logout */
document.addEventListener('DOMContentLoaded', function() {


    const token = localStorage.getItem('auth_token');

    if(!token){
        alert("No hay token guardado.");
        window.location.href = "/sistema_soporte_lite/public/login";
        return;
    } 


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
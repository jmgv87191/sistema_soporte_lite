@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content')
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
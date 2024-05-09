@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Pagina criada para a dashboard de usuario.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
    </script>
@stop

{{--mostra mensagem de suceso se existir a variavel sucess--}}
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: '{{ session('success') }}',
        })
    </script>
@endif

{{--mostra mensagem de erro se existir a variavel error--}}
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: '{{ session('error') }}',
        })
    </script>
@endif

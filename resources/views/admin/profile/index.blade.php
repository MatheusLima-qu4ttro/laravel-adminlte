@extends('adminlte::page')
@include('vendor.scripts')
@section('title', 'Perfil')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')
    <div class="container">
        <div class="main-body">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Perfil</a></li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="profile-pic">
                                    <img src="{{ asset('vendor/adminlte/'.$user->image) }}" alt="Admin" class="rounded-circle" width="150">
                                    <i class="edit-icon fa-solid fa-pen-to-square" id="edit-profile-pic"></i>
                                </div>
                                <div class="mt-3">
                                    <h4>{{ $user->name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nome Completo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$user->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$user->email}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->phone ? '(' . substr($user->phone, 0, 2) . ') ' . substr($user->phone, 2, 5) . '-' . substr($user->phone, 7) : 'Não informado' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Endereço</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    @if($user->country && $user->city && $user->uf && $user->address && $user->number)
                                        {{$user->address . ', ' . $user->number . ' - ' . DB::table('ufs')->find($user->uf)->nome . ', ' . DB::table('cities')->find($user->city)->nome . ', ' .DB::table('countries')->find($user->country)->nome  }}
                                    @else
                                        Não informado
                                    @endif

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <a class="btn btn-info" data-toggle="modal" data-target="#editProfileModal">Editar</a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#editPasswordModal">Alterar Senha</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('admin.profile.modal-profile')
    @include('admin.profile.modal-password')
    @include('admin.profile.modal-croppie')
@stop


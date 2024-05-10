@extends('adminlte::page')
@include('vendor.scripts')
@section('title', 'Perfil')

@section('content_header')
    <div class="row m-1">
        <div class="col-2">
            <h1>Usuários</h1>
        </div>
        <div class="col-10 text-right">
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="main-body">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb bg-dark">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Usuários</a></li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="GET" action="{{ route('user.list') }}">
                                <input type="text" name="term" placeholder="Pesquisar..." class="form-control mb-3" value="{{ request('term') }}">
                                <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
                            </form>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Perfil</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('vendor/adminlte/'.$user->image) }}" alt="Foto de perfil" class="img-thumbnail" style="width: 50px; height: 50px;">
                                            </td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role}}</td>
                                            <td>
                                                <a href="/user/index?id={{$user->id}}" class="btn btn-primary">Editar</a>
                                                <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger delete">Deletar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- Adicionando links de paginação -->
                                {{ $users->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.delete').click(function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                })
            });
        });
    </script>
@stop

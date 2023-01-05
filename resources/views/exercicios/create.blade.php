@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Cadastro de Perfil</h3>
                </div>
                <form id="create" action="{{ route('roles.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @include('roles.components._form')
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('roles.index') }}" class="btn btn btn-secondary m-1 float-right">
                            <i class="fas fa-arrow-left"></i>
                            Voltar
                        </a>
                        <button type="submit" class="btn btn btn-success m-1 float-right">
                            <i class="fas fa-check"></i>
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
  </section>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

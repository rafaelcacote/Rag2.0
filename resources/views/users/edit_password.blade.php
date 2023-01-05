@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuário</h1>
@stop

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Editar Senha </h3>
                </div>
                <form action="{{ route('user.update.password', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body pb-0">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">Senha</label>
                                            <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                                            <label for="confirm-password">Confirmar Senha</label>
                                            <input type="password" id="confirm-password" name="confirm-password" class="form-control">
                                            @if ($errors->has('confirm-password'))
                                            <p class="help-block" style="color: red">
                                                    {{ $errors->first('confirm-password') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                <div class="col-sm-6">
                                    <p class="text-muted"><b><i class="fa fa-warning"></i></b> Editando Senha
                                        <b>{{ $user->name }}</b>.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn btn-secondary m-1 float-right">
                            <i class="fas fa-arrow-left"></i>
                            Voltar
                        </a>
                        <button type="submit" class="btn btn btn-primary m-1 float-right">
                            <i class="fas fa-check"></i>
                            Editar
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

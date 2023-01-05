@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
            <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Cadastro de Usuário</h3>
                </div>
                <form id="create" action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">
                                        Nome
                                        <span class="red-text">*</span>
                                    </label>
                                    <input type="text" placeholder="Nome"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                        name="name" value="{{ $user->name ?? old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">
                                        Email
                                    </label>
                                    <input type="email" placeholder="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                                        name="email" value="{{ $user->email ?? old('email') }}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password">Senha</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                        @if ($errors->has('password'))
                                            <p class="help-block">
                                                {{ $errors->first('password') }}
                                            </p>
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

                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                                    <label for="setor">Setores</label>
                                    <select name="setores[]" class="form-control select2-multiple" multiple="multiple"
                                        data-placeholder=" Vincular Área Usuário" required="">
                                        @foreach ($setores as $id => $setor)
                                            <option value="{{ $id }}"> {{ $setor }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('setores'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('setores') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                                    <label for="roles">Perfil*</label>
                                    <select name="roles[]" id="roles" class="form-control select2-multiple" multiple="multiple">
                                        @foreach ($roles as $id => $roles)
                                            @if (isset($userRole)) {
                                                <option value="{{ $id }}"
                                                {{ in_array($id, old('roles', [])) || (isset($user) && $userRole) ? 'selected' : '' }}>
                                                {{ $roles }}
                                            </option>
                                            }
                                            @else
                                            <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                                                {{ $roles }}
                                            </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('roles'))
                                    <p class="help-block" style="color: red">
                                            {{ $errors->first('roles') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn btn-secondary m-1 float-right">
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

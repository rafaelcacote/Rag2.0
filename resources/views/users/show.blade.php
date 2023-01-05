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
            <div class="card card-info">
                <div class="card-header">
                <h3 class="card-title">Visualizar Usuário</h3>
                </div>

                    <div class="card-body pb-0">
                        <div class="card">
                            <div class="card-body p-0">
                              <table class="table table-bordered table-striped">
                                <tbody>
                                  <tr>
                                    <td width="200px"><strong>Name:</strong></td>
                                    <td>{{ $user->name }}</td>
                                  </tr>

                                  <tr>
                                    <td width="200px"><strong>Email:</strong></td>
                                    <td>{{ $user->email }}</td>
                                  </tr>
                                  <tr>
                                    <td width="200px"><strong>Perfil:</strong></td>
                                    <td>@if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif</td>
                                  </tr>
                                  <tr>
                                    <td width="200px"><strong>Setores:</strong></td>
                                    <td>
                                            @if(!empty($user->setores))
                                                @foreach ($user->setores as $key => $setor)
                                                <label class="badge badge-info">{{ $setor->name }}</label>
                                                @endforeach
                                            @endif
                                   </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn btn-secondary m-1 float-right">
                            <i class="fas fa-arrow-left"></i>
                            Voltar
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn btn-primary m-1 float-right">
                            <i class="fa-solid fa-pencil"></i>
                            Editar
                        </a>
                    </div>

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

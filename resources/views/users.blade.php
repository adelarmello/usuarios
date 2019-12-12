@extends('layouts.app')
@section('content')
    <center>
        <h3>Sistema de Cadastro de Usuários</h3>
    </center>
    @if (Session::has('success'))
        <h3>{{ Session::get('success')}}</h3>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="5" >Código</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>
                            <a href="{{URL('users/create')}}" class="btn btn-sucess btn-xs">Cadastrar novo usuário</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                                <td>
                                    <center>
                                    <a href="{{URL('users/' .$user->id . '/edit')}}" class="btn btn-xs btn-info">Editar</a>
                                    <form action="{{URL('users/')}}" method="POST">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-xs btn-danger">Excluir</a></button>
                                    </form>
                                    <a href="{{URL('users/' .$user->id) }}" class="btn btn-xs btn-primary">Detalhes</a>
                                    
                                    </center>
                                </td>
                            </tr>
    
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
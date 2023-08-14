@extends('layouts.plantilla-admin')

@section('title', 'Usuarios')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center display-4">Usuarios</h3> 
        </div>
    </div> 
    {{--  tabla   --}}
    <div class="row mt-5 mb-5">
        <div class="col-md-12 col-sm-12">
            <div class="card card-stats">
                <div class="card-footer">
                    <div class="w-100 table-responsive">
                            <table class= "table table-striped table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th><button type="button" class="btn w-100 btn-info btn-sm" data-toggle="modal" data-target="#modalCrearCliente"><i class="fas fa-plus"></i></button></th>
                                        <th colspan="8">
                                            <form method="POST" action="{{route('usufiltroname')}}">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control" placeholder="Ingrese nombre completo" name="name" autocomplete="off" id="nameFiltro">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="#" class="btn btn-primary" type="button" onclick="$('#nameFiltro').val('')"><i class="fas fa-eraser"></i></a>
                                                    </div>
                                                </div> 
                                            </form>                                        
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Direccion</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Compleaños</th>
                                        <th class="text-center">Fecha Creacion</th>
                                        <th class="text-center">Fecha Actualizacion</th>
                                        <th class="text-center">Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                        @forelse($usuarios as $usu)
                                    <tr>
                                        <td class="text-center">{{$usu->idOwner}}</td>
                                        <td class="text-center">{{$usu->name}}</td>
                                        <td class="text-center">{{$usu->addres}}</td>
                                        <td> <img class="fluid" src="{{asset($usu->foto)}}" alt="{{ $usu->name}}" width="290px"> </td>
                                        <td class="text-center">{{$usu->birday}}</td>
                                        <td class="text-center">{{$usu->created_at}}</td>
                                        <td class="text-center">{{$usu->updated_at}}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal1{{$usu->idOwner}}"><i class="fas fa-user-edit"></i></button>
                                                <form action="{{ route('usuarios.destroy',$usu->idOwner) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            </div>
                                        </td>
                                        {{--  editar   --}}
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{--  <!-- Modal -->  --}}
                                                    <div class="modal fade" id="myModal1{{$usu->idOwner}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        {{--  <!-- Modal content-->  --}}
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Editar Usuario</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                                <form class="col-12" method="POST" action="{{route('usuactualizar')}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input value="{{$usu->idOwner}}" type="hidden" class="form-control" name="idOwner">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nombre</label>
                                                                        <input type="text" class="form-control" name="name" value="{{$usu->name}}" aria-describedby="emailHelp" placeholder="Ingresar nombre completo" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Direccion</label>
                                                                        <input type="text" class="form-control" name="addres" value="{{$usu->addres}}" aria-describedby="emailHelp" placeholder="Ingrese direccion" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Foto</label>
                                                                        <input type="file" class="form-control" name="foto" id="exampleInputPassword1"><br> <img value="{{$usu->foto}}" class="fluid" src="{{asset($usu->foto)}}" alt="{{ $usu->name}}" width="290px"> 
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Cumpleaños</label>
                                                                        <input type="date" class="form-control" name="birday" value="{{$usu->birday}}" aria-describedby="emailHelp"  required>
                                                                    </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Editar Usuario</button>
                                                            </form>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  editar   --}}
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay registros</td>
                                    </tr>
                        @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            @if($usuarios != null)
                                                {{$usuarios->links()}}
                                                {{--  {{$clientes->appends(['busqueda'=>$busqueda])}}  --}}
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   {{--  tabla   --}}

               {{--  <!-- Modal -->  --}}
            <div class="modal fade" id="modalCrearCliente" role="dialog">
                <div class="modal-dialog">
                        {{--  <!-- Modal content-->  --}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Crear Usuario</h4>
                            </div>
                            <div class="modal-body">
                                    <form class="col-12" method="POST"  action="{{route('usuarios.insertar')}}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre</label>
                                            <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Ingresar nombre completo" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Direccion</label>
                                            <input type="text" class="form-control" name="addres" aria-describedby="emailHelp" placeholder="Ingrese direccion" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Foto</label>
                                            <input type="file" class="form-control" name="foto" id="exampleInputPassword1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cumpleaños</label>
                                            <input type="date" class="form-control" name="birday" aria-describedby="emailHelp"  required>
                                        </div>
                            </div>
                            <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                                    </form>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                </div>
            </div>

</div>
@endsection
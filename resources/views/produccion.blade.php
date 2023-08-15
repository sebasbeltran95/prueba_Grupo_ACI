@extends('layouts.plantilla-admin')

@section('title', 'Produccion')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center display-4">Produccion</h3> 
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
                                        <th colspan="11">
                                            <form method="POST" action="{{route('produccionfiltroname')}}">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control" placeholder="Ingrese nombre de la propiedad" name="name" autocomplete="off" id="nameFiltro">
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
                                        <th class="text-center">REF</th>
                                        <th class="text-center">Operario</th>
                                        <th class="text-center">Piezas Buenas</th>
                                        <th class="text-center">Piezas Malas</th>
                                        <th class="text-center">Fecha Inicio</th>
                                        <th class="text-center">Fecha Fin</th>
                                        <th class="text-center">Gastos Adicionales</th>
                                        <th class="text-center">Observaciones</th>
                                        <th class="text-center">Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                        @forelse($usuarios as $usu)
                                    <tr>
                                        <td class="text-center">{{$usu->id}}</td>
                                        <td class="text-center">{{$usu->ref}}</td>
                                        <td class="text-center">{{$usu->operario}}</td>
                                        <td class="text-center">$ {{$usu->piezas_buenas}}</td>
                                        <td class="text-center">{{$usu->piezas_malas}}</td>
                                        <td class="text-center">{{$usu->fecha_inicio}}</td>
                                        <td class="text-center">{{$usu->fecha_fin}}</td>
                                        <td class="text-center">{{number_format($usu->gastos_adicionales)}}</td>
                                        <td class="text-center">{{$usu->observaciones}}</td>
                                        <td class="text-center">{{$usu->created_at}}</td>
                                        <td class="text-center">{{$usu->updated_at}}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal1{{$usu->idProperty}}"><i class="fas fa-user-edit"></i></button>
                                                <form action="{{ route('propiedades.destroy',$usu->idProperty) }}" method="POST">
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
                                                    <div class="modal fade" id="myModal1{{$usu->idProperty}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        {{--  <!-- Modal content-->  --}}
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Editar Produccion</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                                <form class="col-12" method="POST" action="{{route('produccionactualizar')}}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input value="{{$usu->idProperty}}" type="hidden" class="form-control" name="idProperty">
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
                                                                        <label for="exampleInputEmail1">Precio</label>
                                                                        <input type="text" class="form-control" name="price" value="{{$usu->price}}" aria-describedby="emailHelp" placeholder="Ingrese valor de la propiedad" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Codigo Internacional</label>
                                                                        <input type="text" class="form-control" name="codeinternacional" value="{{$usu->codeinternacional}}" aria-describedby="emailHelp" placeholder="Ingrese el codigo internacional" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Año</label>
                                                                        <input type="date" class="form-control" name="year"  value="{{$usu->year}}" aria-describedby="emailHelp"  required>
                                                                    </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Editar Produccion</button>
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
                                        <td colspan="11" class="text-center">No hay registros</td>
                                    </tr>
                        @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="11">
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
                        <h4 class="modal-title">Crear Produccion</h4>
                    </div>
                    <div class="modal-body">
                            <form class="col-12" method="POST"  action="{{route('produccion.insertar')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ERF</label>
                                    <input type="text" class="form-control" name="ref" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operario</label>
                                    <input type="text" class="form-control" name="operario" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Piezas Buenas</label>
                                    <input type="number" class="form-control" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Piezas Malas</label>
                                    <input type="text" class="form-control" name="piezas_malas" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Inicio</label>
                                    <input type="date" class="form-control" name="fecha_inicio" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Fin</label>
                                    <input type="date" class="form-control" name="fecha_fin" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gastos  Adicionales</label>
                                    <input type="number" class="form-control" name="gastos_adicionales" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Observaciones</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="observaciones" rows="3" required></textarea>
                                </div>
                    </div>
                    <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Registrar Produccion</button>
                            </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
        </div>
    </div>

</div>
@endsection
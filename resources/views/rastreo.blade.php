@extends('layouts.plantilla-admin')

@section('title', 'Usuarios')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center display-4">Rastreo Propiedades</h3> 
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
                                            <form method="POST" action="{{route('rastreofiltroname')}}">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control" placeholder="Ingrese nombre del asesor" name="name" autocomplete="off" id="nameFiltro">
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
                                        <th class="text-center">Fecha Venta</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Impuestos</th>
                                        <th class="text-center">Propiedad</th>
                                        <th class="text-center">Fecha Creacion</th>
                                        <th class="text-center">Fecha Actualizacion</th>
                                        <th class="text-center">Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                        @forelse($rastreo as $usu)
                                    <tr>
                                        <td class="text-center">{{$usu->idPropertyTrace}}</td>
                                        <td class="text-center">{{$usu->datesale}}</td>
                                        <td class="text-center">{{$usu->name}}</td>
                                        <td class="text-center">$ {{number_format($usu->value)}}</td>
                                        <td class="text-center">$ {{number_format($usu->tax)}}</td>
                                        @if ($usu->PROPIEDADES != null)
                                        <td class="text-center">{{$usu->PROPIEDADES->name}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td class="text-center">{{$usu->created_at}}</td>
                                        <td class="text-center">{{$usu->updated_at}}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal1{{$usu->idPropertyTrace}}"><i class="fas fa-user-edit"></i></button>
                                                <form action="{{ route('rastreo.destroy',$usu->idPropertyTrace) }}" method="POST">
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
                                                    <div class="modal fade" id="myModal1{{$usu->idPropertyTrace}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        {{--  <!-- Modal content-->  --}}
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Editar Propiedad</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                                <form class="col-12" method="POST" action="{{route('rastreoactualizar')}}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input value="{{$usu->idPropertyTrace}}" type="hidden" class="form-control" name="idPropertyTrace">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Fecha de venta</label>
                                                                        <input type="date" class="form-control" name="datesale"  value="{{$usu->datesale}}" aria-describedby="emailHelp"  required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nombre</label>
                                                                        <input type="text" class="form-control" name="name" value="{{$usu->name}}" aria-describedby="emailHelp" placeholder="Ingresar nombre de la propiedad" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Valor</label>
                                                                        <input type="text" class="form-control" name="value" value="{{$usu->value}}" aria-describedby="emailHelp" placeholder="Ingrese valor de ña propiedad" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Impuestos</label>
                                                                        <input type="text" class="form-control" name="tax" value="{{$usu->tax}}" aria-describedby="emailHelp" placeholder="Ingrese impuestos de la propiedad" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="idProperty">Area</label>
                                                                        <select class="custom-select" name="idProperty" id="idProperty">
                                                                            <option value="" selected disabled>Seleccione una opción...</option>
                                                                            @php
                                                                            $proopi = App\Models\Propiedades::all();
                                                                            @endphp   
                                                                            @foreach($proopi as $ppp)
                                                                            <option value="{{ $ppp->idProperty }}"  @if($ppp->idProperty == $usu->idProperty ) selected @endif>{{ $ppp->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Editar Propiedad</button>
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
                                            @if($rastreo != null)
                                                {{$rastreo->links()}}
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
                                <h4 class="modal-title">Crear Propiedad</h4>
                            </div>
                            <div class="modal-body">
                                    <form class="col-12" method="POST"  action="{{route('rastreo.insertar')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha venta</label>
                                            <input type="date" class="form-control" name="datesale" aria-describedby="emailHelp"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre</label>
                                            <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Ingresar nombre completo" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Valor</label>
                                            <input type="text" class="form-control" name="value" aria-describedby="emailHelp" placeholder="Ingrese valor de la vivienda" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Impuestos</label>
                                            <input type="text" class="form-control" name="tax" aria-describedby="emailHelp" placeholder="Ingrese impuestos de la vivienda" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="idProperty">Propiedades</label>
                                            <select class="custom-select" name="idProperty" id="idProperty">
                                                <option value="" selected disabled>Seleccione una opción...</option>
                                                @php
                                                $Propiades = App\Models\Propiedades::all();
                                                @endphp   
                                                @foreach($Propiades as $propi)
                                                <option value="{{ $propi->idProperty }}">{{ $propi->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                            </div>
                            <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Registrar Propiedad</button>
                                    </form>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                </div>
            </div>

</div>
@endsection
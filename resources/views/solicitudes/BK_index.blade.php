@extends('adminlte::page')

@section('title', 'Listado')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')    
@stop

@section('content')
    <div class="container mt-12"> 
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">LISTADO DE SOLICITUDES</h1>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="solicitudes">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">PtoActual</th>
                            <th scope="col">PtoAnterior</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Ver</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Anular</th>
                            <th scope="col">Eliminar</th>
                        </tr>       
                    </thead>    
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                            <tr>
                                <th scope="row">{{$solicitud->id}}</th>
                                <td>{{$solicitud->nombre}}</td>
                                <td>{{$solicitud->ptoactual}}</td>
                                <td>{{$solicitud->ptoanterior}}</td>
                                <td>{{$solicitud->estado}}</td>
                                
                                <td>                     
                                    <a href="{{route('solicitudes.ver', $solicitud->id)}}"><button type="button" class="btn btn-secondary">Ver</button></a>
                                    <a href="{{route('solicitudes.editar', $solicitud->id)}}"><button type="button" class="btn btn-primary">Editar</button></a>                                                       
                                    <a href="{{route('solicitudes.anular', $solicitud->id)}}"><button type="button" class="btn btn-secondary">Anular</button></a>
                                    <a href="{{route('solicitudes.eliminar', $solicitud->id)}}"><button type="button" class="btn btn-primary">Eliminar</button></a>
                                </td>                            
                            </tr>
                        @endforeach
                    </tbody>                
                </table>            
            </div>
        </div>
    </div>
@stop

@section('css')
<!--
    <link rel="stylesheet" href="/css/admin_custom.css">
-->
@stop

@section('js')
    <script>
        $(document).ready(function() {
            
            $('#solicitudes').DataTable();
        })
    </script>
@stop

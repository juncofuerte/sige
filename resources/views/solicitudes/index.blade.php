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
                <!--
                    <a href="crear">
                        <button type="button" class="btn btn-success float-right">Crear Solicitud</button>
                    </a>
                </h2>
                -->
                <table class="table table-hover" id="buzonsolicitudes">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>       
                    </thead>                    
                </table>            
            </div>
        </div>
    </div>
@stop

@section('css')    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">   
    <link rel="stylesheet" href="{{ asset('css/anchobotonpersonal.css')}}"> 
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        var param ={!! $param !!}
        console.log(param)                
        $('#buzonsolicitudes').DataTable({
            "ajax": "{{ route('datatable.solicitudes',['param' => $param]) }}",
            "columns":[
                {data:'id'},
                {data:'nombre'},
                {data:'estadologico'},
                {data:'btn'}
            ],
            "order": [[ 1, "desc" ]],
            "columnDefs": [
                { width: 200, targets:3}
            ],            
            responsive: true,
            autoWidth: false,
            "language": {
                "lengthMenu": "Mostrar " + 
                                `<select class="custom-select" custom-select-sm form-control form-control-sm>
                                    <option value='10'>10</option>
                                    <option value='25'>25</option>
                                    <option value='50'>50</option>
                                    <option value='100'>100</option>
                                    <option value='-1'>Todos</option>
                                </select>` +
                                " registros por página",            
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Ningún registro disponible",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search':'Buscar',
                'paginate':{
                    'next':'siguiente',
                    'previous':'anterior'
                }
            }
        });
        /*
        Swal.fire(
            'Muy Bien!',
            'Haz Clic!',
            'success'
        )
        */
    </script>
@stop

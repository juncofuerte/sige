@extends('adminlte::page')

@section('title', 'Crear Solicitud')

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

@section('content_header')    
@stop

@section('content')
    <div class="container col-md-12 mt-12"> 
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">CREAR SOLICITUD</h1>
            </div>
            <div class="card-body">
            <!--INICIO DEL CUERPO DE LA SOLICITUD-->            
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#fondos" role="tab" aria-controls="fondos" aria-selected="true">
                            <span class="round-tabs two">
                                <i class="fas fa-file-alt"></i>
                                Solicitud de Fondos
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#gastos" role="tab" aria-controls="gastos" aria-selected="false">
                            <span class="round-tabs two">
                                <i class="far fa-list-alt"></i>
                                Solicitud de Gastos
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#adquisiciones" role="tab" aria-controls="adquisicion" aria-selected="false">
                            <span class="round-tabs two">
                                <i class="far fa-file-alt"></i>
                                    Formulario de Adquisiciones
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#documentos" role="tab" aria-controls="documentos" aria-selected="false">
                            <span class="round-tabs two">
                                <i class="fas fa-clone"></i>
                                Documentos Adjuntos
                            </span>
                        </a>
                    </li>
                </ul>
                <form name="frm_nsol"  method="POST" enctype="multipart/form-data" id="frm_subedoc">
                    @csrf
                    <div class="tab-content" id="pills-tabContent">
                        <!--TAB FONDOS-->
                        <div class="tab-pane fade show active mt-2" id="fondos" role="tabpanel" aria-labelledby="pills-home-tab">
                            <hr>
                            <!--PRIMERA FILA: FECHA, SC Y IDDOC -->
                            <div class="row container-fluid mt-1 justify-content-start">
                                <div class="col-4 align-self-start">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fecha"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="sc">S.C. N°</span>
                                        </div>
                                        <input type="text" name="nsol" class="form-control" placeholder="" aria-label="sc" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="col-4 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="iddoc">ID DOC</span>
                                        </div>
                                        <input id="idoc" type="text" name="idoc" class="form-control" placeholder="Ingrese número de ID DOC" aria-label="Username" aria-describedby="basic-addon1" onkeypress="return validaNumericos(event)">
                                    </div>
                                </div>
                            </div>
                            <!--SEGUNDA FILA: ANT Y MAT-->
                            <div class="row container-fluid mt-1 justify-content-start">
                                <div class="col-6 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="ant">ANT.</span>
                                        </div>
                                        <input id="antecedente" name="antecedente" type="text" class="form-control" placeholder="Ingrese Antecedente" aria-label="ant" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-6 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="mat">MAT.</span>
                                        </div>
                                        <input id="materia" name="materia" type="text" class="form-control" placeholder="Ingrese Materia" aria-label="mat" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <!--TERCERA FILA:  DE: Y A:-->
                            <div class="row container-fluid mt-1 justify-content-start">
                                <div class="col-6 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">DE: <?php //echo strtoupper($_SESSION['unidad']);?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">A: DIRECTOR DEM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--CUARTA FILA, TEXTAREA  SOLICITUD-->
                            <div class="container-fluid row mt-1">
                                <div class="col-12 align-self-start">
                                    <p>SOLICITUD</p>
                                </div>
                                <div class="col-12 form-group">
                                    <textarea id="solicitud" class="form-control" name="solicitud" rows="3"></textarea>
                                </div>
                            </div>
                            <!--FILA DE COMBOS TIPO DE COMPRA Y TIPO DE FONDO -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo De Compra</label>
                                        <select class="form-control select2" id="tipocompra" name="tipocompra[]" style="width: 100%;">
                                            <option></option>
                                            @foreach($tipocompras as $tipocompra)
                                                <option value="{{ $tipocompra->id }}">{{ $tipocompra->nombre }}</option>;
                                            @endforeach
                                        </select>
                                    </div>                                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo De Fondo</label>
                                        <select class="select2bs4" multiple="multiple" id="tipofondo" name="tipofondo[]" data-placeholder="Seleccione el/los fondos" style="width: 95%;">                                                        
                                            @foreach($tipofondos as $tipofondo)
                                                <option value="{{ $tipofondo->id }}">{{ $tipofondo->nombre }}</option>;
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>  
                            <!--LISTA DISTRIBUCIÓN AL PIE DE SOLICITUD / AGREGADO 01-12-2020-->
                            <div class="row container-fluid mt-1 justify-content-start">
                                <div class="col-md-6">
                                    <div class="container-fluid row mt-1">
                                        <div class="col-12 align-self-start">
                                            <p>LISTA DISTRIBUCIÓN</p>
                                        </div>
                                        <div class="col-12 form-group">
                                            <textarea id="listadistribucion" class="form-control" name="listadistribucion" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="ant">PROYECTO</span>
                                        </div>
                                        <input id="descproyecto" name="descproyecto" type="text" class="form-control" placeholder="Ingrese Nombre Proyecto" aria-label="ant" aria-describedby="basic-addon1">                                                
                                    </div>
                                </div>
                            </div>                                   
                        </div>
                        <!--TAB GASTOS-->
                        <div class="tab-pane fade" id="gastos" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <hr>
                            <div id="tipfondotros" class="row container-fluid mt-1 justify-content-start">
                                <div class="col-12 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="desd">DESCRIPCIÓN ADQUISICIÓN</span>
                                        </div>
                                        <input id="descadquisicion" name="descadquisicion" type="text" class="form-control" placeholder="Ingrese Descripción" aria-label="ant" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-12 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ÁREA</span>
                                        </div>
                                        <input id="area" name="area" type="text" class="form-control" placeholder="Ingrese Área" aria-label="mat" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-12 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="mat">DIMENSIÓN</span>
                                        </div>
                                        <input id="dimension" name="dimension" type="text" class="form-control" placeholder="Ingrese Dimensión" aria-label="mat" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                <!--REALIZACION ACTIVIDAD Y FECHA ACTIVIDAD-->
                                <div class="row container-fluid mt-1 justify-content-start">
                                    <div class="col-6 align-self-end">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="act">REALIZACIÓN DE ACTIVIDAD</span>
                                            </div>
                                            <select id="actividad" name="actividad[]" class="selectpicker" data-style="btn-info" title="Seleccione Opción">
                                                <option value="1" selected>No</option>;
                                                <option value="2">Sí</option>;
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 align-self-end">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="fech">FECHA DE EJECUCIÓN</span>
                                            </div>
                                            <input type='text' class="form-control" id='calendarioActividad' name="calendarioActividad" style='width: 300px;' > <br>
                                        </div>
                                    </div>
                                </div>
                                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                <div class="container-fluid row mt-1">
                                    <div class="col-12 align-self-start">
                                        <p>PRÁCTICAS A MEJORAR</p>
                                    </div>
                                    <div class="col-12 form-group">
                                        <textarea id="practicas" name="practicas" class="form-control" id="practicas" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="container-fluid row mt-1">
                                    <div class="col-12 align-self-start">
                                        <p>RESULTADOS ESPERADOS CON LA ADQUISICIÓN</p>
                                    </div>
                                    <div class="col-12 form-group">
                                        <textarea id="resultados" name="resultados" class="form-control" id="resultados" rows="3"></textarea>
                                    </div>
                                    <!--
                                    <div>
                                        <input type="button" value="borrar" id="borrar">
                                    </div>
                                    -->
                                </div>
                            </div>
                            <!-- =========================================================================== -->
                            <!--                      EN CASO DE TIPO COMPRA FAEP                                    -->
                            <!-- =========================================================================== -->
                            <div id="tipfondfaep" class="row container-fluid mt-1 justify-content-start">                                                                                        
                                <div class="container-fluid row mt-1">
                                    <div class="col-12 align-self-start">
                                        <p>COMPONENTE A LA CUAL CORRESPONDE LA SOLICITUD</p>
                                    </div>
                                    <div class="col-12 form-group">
                                        <textarea id="componente" name="componente" class="form-control" id="practicas" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="container-fluid row mt-1">
                                    <div class="col-12 align-self-start">
                                        <p>INICIATIVA A LA CUAL CORRESPONDE LA SOLICITUD</p>
                                    </div>
                                    <div class="col-12 form-group">
                                        <textarea id="iniciativa" name="iniciativa" class="form-control" id="resultados" rows="3"></textarea>
                                    </div>
                                </div>
                                <!--REALIZACION ACTIVIDAD Y FECHA ACTIVIDAD-->
                                <div class="row container-fluid mt-1 justify-content-start">
                                    <div class="col-6 align-self-end">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="act">REALIZACIÓN DE ACTIVIDAD</span>
                                            </div>
                                            <select id="actividadfaep" name="actividadfaep[]" class="selectpicker" data-style="btn-info" title="Seleccione Opción">
                                                <option value="1" selected>No</option>;
                                                <option value="2">Sí</option>;
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 align-self-end">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="fech">FECHA DE EJECUCIÓN</span>
                                            </div>
                                            <input type='text' class="form-control" id='calendarioActividadfaep' name="calendarioActividadfaep" style='width: 300px;' > <br>                                                            
                                        </div>                                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--TAB ADQUISICIONES-->
                        <div class="tab-pane fade" id="adquisiciones" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered" id="tabla">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="text-align: center">id Artículo</th>
                                                <th scope="col" style="text-align: center">Cantidad</th>
                                                <th scope="col" style="text-align: center">Unid. Medida</th>
                                                <th scope="col" style="text-align: center">Descripción</th>
                                                <th scope="col" style="text-align: center">Val.Net.Unit.</th>
                                                <th scope="col" style="text-align: center">% Rec. Desp.</th>
                                                <th scope="col" style="text-align: center">Total</th>
                                                <th scope="col" style="text-align: center">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- fila base para clonar y agregar al final -->
                                            <tr class="fila-base">
                                                <td scope="row" style="text-align: center"><input type="text" id="txtidarticulo" name="txtidarticulo[]" size="10" onkeypress='return validaNumericos(event)'/></td>
                                                <td style="text-align: center"><input type="text" id="txtcantidad" name="txtcantidad[]" size="3" onkeypress='return validaNumericos(event)'/></td>
                                                <td style="text-align: center"><input type="text" id="txtunidmedida" name="txtunidmedida[]" size="8"/></td>
                                                <td style="text-align: center"><input type="text" id="txtdescripcion" name="txtdescripcion[]" size="25"/></td>
                                                <td style="text-align: center"><input type="text" id="txtvalnetunid" name="txtvalnetunid[]" size="3" onkeypress='return validaNumericos(event)'/></td>
                                                <td style="text-align: center"><input type="text" id="txtrecargo" name="txtrecargo[]" size="3" value="0" onkeypress='return validaNumericos(event)'/></td>
                                                <td style="text-align: center"><input type="text" id="txttotal" name="txttotal[]" size="3" readonly/></td>
                                                <td style="text-align: center"><i class="fas fa-minus-circle eliminar"></i></td>                                                            
                                            </tr>
                                            <!-- fin de código: fila base -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3 align-self-end">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Total Solicitud</span>
                                        </div>
                                        <input name="totalsol" type="text" class="form-control" aria-label="ant" aria-describedby="basic-addon1" id="ttotal" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3">
                                    <button type="button" class="btn btn-info" id="agregaritem" style="width: 255px">Agregar Item</button>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-danger" id="limpiarfilas" style="width: 255px">Eliminar Filas</button>
                                </div>
                            </div>
                        </div>
                        <!--TAB DOCUMENTOS-->
                        <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <hr>                                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tipo De Documento a Adjuntar</label>
                                    <select class="select2bs4" multiple="multiple" id="adjuntos" name="adjuntos[]" data-placeholder="Seleccione documentos" style="width: 200%;">
                                        @foreach($tipoadjuntos as $tipoadjunto)
                                            <option value="{{ $tipoadjunto->id }}">{{ $tipoadjunto->nombre}}</option>;
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row container-fluid mt-1 justify-content-start">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">ARCHIVOS A ADJUNTAR</span>
                                    </div>
                                    <div class="col-md-6 col-md-offset-4">
                                        <input class="form-control p-1 border" type="file" name="archivos[]" id="archivos" multiple>
                                    </div>
                                    <div class="row container-fluid mt-1 justify-content-start">
                                        <div class="input-group my-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Máximo 5 archivos, de no más de 1 Mb cada uno y sólo se admiten archivos del tipo: *.txt, *.pdf, *.doc/*.docx (word), *.xls/*.xlsx (excel), *.jpg, *.png, *.gif</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 align-self-start">
                                        <button type="button" class="btn btn-success form-control mt-3" id="btn_subir">Enviar Solicitud</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN TAB DOCUMENTOS-->
                    </div>
                </form>                       
            <!--FIN DEL CUERPO DE LA SOLICITUD-->
            </div>

            <!--MODAL ERRORES-->
            <div class="modal fade" id="mostrarmodalerrores" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="cabeceramodalerrores"></h4>
                        </div>
                        <div class="modal-body">
                            <h6 id="cuerpomodalerrores"></h6>
                        </div>
                        <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN MODAL ERRORES-->

            <!--MODAL RESUMEN-->
            <div class="modal fade" id="mostrarmodalresumen" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p id="cabeceramodalresumen" align="center"></p>
                        </div>
                        <div class="modal-body">
                            <p id="cuerpomodalresumen"></p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" id="cerrarresumen" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN MODAL RESUMEN-->

            <!--MODAL REGISTRANDO SOLICITUD EN EL SISTEMA-->
            <div class="modal fade" id="mostrarmodalregistrandosolicitud" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p id="cabeceramodalregistra" align="center"><b>SIGED</b>   <i class="far fa-save"></i></p>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-center">
                                Grabando Solicitud. . .
                                <div class="spinner-border text-danger ml-auto" role="status" aria-hidden="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN MODAL REGISTRANDO SOLICITUD EN EL SISTEMA-->

        </div>
    </div>
@stop

@section('css')    
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">        
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">    
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}"> 
        <!-- Datepicker -->
        <link rel='stylesheet' href="{{ asset('plugins/datepicker/bootstrap-datepicker.min.css')}}">      
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">

        <style>
            .fila-base{
                display: none;
                } /* fila base oculta */

            .fila-baseDispon{
                display: none;
                } /* fila base oculta */
        </style>
@stop

@section('js')


        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- ChartJS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
        <!-- Summernote -->
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
        <!-- InputMask -->
        <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
        <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
        <!-- date-range-picker -->
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- bootstrap color picker -->
        <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <!-- Bootstrap Switch -->
        <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('dist/js/demo.js')}}"></script>
        <!-- Datepicker -->
        <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.es.min.js')}}"></script>  
        
        
        <script>
            $(document).ready(function() {
                nid=0;            

                function agregaFila()
                {
                    nid++;
                    //alert($("#tabla tbody tr:eq(0)"));
                    $("#tabla tbody tr:eq(0)").clone().removeClass('fila-base').attr("id",nid).appendTo("#tabla tbody");
                };

                function eliminaFilas()
                {
                    //OBTIENE EL NÚMERO DE FILAS DE LA TABLA
                    var n=0;
                    $("#tabla tbody tr").each(function ()
                    {
                        n++;
                    });
                    //console.log("n:"+n);
                    //for(i=n-1;i>0;i--)
                    for(i=n-1;i>1;i--)   //i>1 borra todas, pero deja 1 fila visible y la fila oculta ----- i>0 borra todas las filas visibles
                    {
                        $("#tabla tbody tr:eq('"+i+"')").remove();
                    };
                    //variable=$("#tabla tbody tr:eq(1));
                    //console.log(variable);
                    $("#tabla tbody tr:eq(1) td:eq(0) input").val("");
                    $("#tabla tbody tr:eq(1) td:eq(1) input").val("");
                    $("#tabla tbody tr:eq(1) td:eq(2) input").val("");
                    $("#tabla tbody tr:eq(1) td:eq(3) input").val("");
                    $("#tabla tbody tr:eq(1) td:eq(4) input").val("");
                    $("#tabla tbody tr:eq(1) td:eq(5) input").val("0");
                    $("#tabla tbody tr:eq(1) td:eq(6) input").val("");
                    $("#ttotal").val("");
                };

                /*
                function agregaFilaDispon()
                {
                    nid++;
                    //alert($("#tabla tbody tr:eq(0)"));
                    $("#tablaDispon tbody tr:eq(0)").clone().removeClass('fila-baseDispon').attr("id",nid).appendTo("#tablaDispon tbody");
                };                
                */

                /*
                function eliminaFilasDispon()
                {
                    //OBTIENE EL NÚMERO DE FILAS DE LA TABLA
                    var n=0;
                    $("#tablaDispon tbody tr").each(function ()
                    {
                        n++;
                    });
                    //console.log("n:"+n);
                    //for(i=n-1;i>0;i--)
                    for(i=n-1;i>1;i--)   //i>1 borra todas, pero deja 1 fila visible y la fila oculta ----- i>0 borra todas las filas visibles
                    {
                        $("#tablaDispon tbody tr:eq('"+i+"')").remove();
                    };
                    //variable=$("#tabla tbody tr:eq(1));
                    //console.log(variable);
                    $("#tablaDispon tbody tr:eq(1) td:eq(0) input").val("");
                    $("#tablaDispon tbody tr:eq(1) td:eq(1) input").val("");
                    $("#tablaDispon tbody tr:eq(1) td:eq(2) input").val("");
                    $("#tmonto").val("");
                };
                */

                (function(){
                    agregaFila();
                    eliminaFilas();
                }());

                /*
                (function(){
                    agregaFilaDispon();
                    eliminaFilasDispon();
                }());
                */

                $('#calendarioActividad').datepicker({
                    language: "es",
                    todayBtn: "linked",
                    clearBtn: true,
                    format: "dd/mm/yyyy",
                    multidate: false,
                    todayHighlight: true
                });

                $('#calendarioActividadfaep').datepicker({
                    language: "es",
                    todayBtn: "linked",
                    clearBtn: true,
                    format: "dd/mm/yyyy",
                    multidate: false,
                    todayHighlight: true
                });

                //DETECTA SI SE HA SELECCIONADO LA OPCIÓN
                //"OTROS, ESPECIFICAR" PARA ACTIVAR CUADRO DE DESCRIPCIÓN PROYECTO
                $('#tipofondo').on('select2:select', function (e) {
                    var data = e.params.data;
                    //console.log(data);
                    if(data.text=="OTROS, ESPECIFICAR"){
                        $("#descproyecto").attr("disabled",false);
                    }else if(data.text=="FAEP"){
                        $('#descadquisicion').val('');
                        $('#area').val('');
                        $('#dimension').val('');
                        $('#actividad').val('1');
                        $('#calendarioActividad').datepicker('setDate', null);
                        $("#calendarioActividad").attr("disabled",true);
                        $('#practicas').val('');
                        $('#resultados').val('');
                        $('#tipfondotros').hide();
                        $('#tipfondfaep').show();
                    }                    
                });
                
                //SE GATILLA CUANDO SE HACE CLIC EN LA "X" DE LA OPCIÓN
                //QUE ESTÁ SELECCIONADA, en select2 multiple
                $('#tipofondo').on('select2:unselect', function (e) {
                    var data = e.params.data;
                    //console.log(data);
                    if(data.text=="OTROS, ESPECIFICAR"){
                        $("#descproyecto").val('');
                        $("#descproyecto").attr("disabled",true);
                    }else if(data.text=="FAEP"){
                        $('#componente').val('');
                        $('#iniciativa').val('');
                        $('#actividadfaep').val('1');
                        $('#calendarioActividadfaep').datepicker('setDate', null);
                        $("#calendarioActividadfaep").attr("disabled",true);
                        $('#tipfondfaep').hide();
                        $('#tipfondotros').show();                        
                    }    
                });

                //SE GATILLA CUANDO SE ESTÁ EJECUTANDO LA ELIMINACIÓN 
                //DE LA OPCIÓN QUE ESTABA COMO OPCIÓN SELECCIONADA 
                //A LA CUAL PREVIAMENTE SE LE HIZO CLIC EN LA "X" 
                $('#tipofondo').on('select2:unselecting', function (e) {
                    var data = e.params.data;
                    //alert(data.text);
                    console.log(data);
                    //OJO: esto no lo estamos ocupando
                });

                $(document).on('change', '#actividad', function ()
                {
                    if($("#actividad").val()==1){
                        $('#calendarioActividad').datepicker('setDate', null);
                        $("#calendarioActividad").attr("disabled",true);
                    }else{
                        $("#calendarioActividad").attr("disabled",false);
                        $('#calendarioActividad').datepicker("setDate", new Date());
                    }
                });

                $(document).on('change', '#actividadfaep', function ()
                {
                    if($("#actividadfaep").val()==1){
                        $('#calendarioActividadfaep').datepicker('setDate', null);
                        $("#calendarioActividadfaep").attr("disabled",true);
                    }else{
                        $("#calendarioActividadfaep").attr("disabled",false);
                        $('#calendarioActividadfaep').datepicker("setDate", new Date());
                    }
                });                

                // $(document).on('changeDate', '#calendarioActividad', function ()
                // {
                //     var f= $("#calendarioActividad").data('datepicker').getFormattedDate('dd-mm-yyyy');
                //     alert(f);
                // });

                $('#mostrarmodalerrores').on('hidden.bs.modal', function () {
                    $("#cabeceramodalerrores").empty();
                    $("#cuerpomodalerrores").empty();
                    //$('#mostrarmodal')[0].reset();
                });

                $('#mostrarmodalresumen').on('hidden.bs.modal', function () {
                    $("#cabeceramodalresumen").empty();
                    $("#cuerpomodalresumen").empty();
                    //$('#mostrarmodal')[0].reset();
                });

                $("#agregaritem").click(function(){
                    //agregaFilaDispon();
                    agregaFila();
                });

                $("#limpiarfilas").click(function(){
                    //agregaFila();
                    eliminaFilas();
                });

                $("#agregaritemDispon").click(function(){
                    alert("Hi");
                    agregaFilaDispon();
                });

                $("#limpiarfilasDispon").click(function(){
                    //agregaFila();
                    eliminaFilasDispon();
                });

                /**LAS SIGUIENTES DECLARACIONES SE UTILIZA $(document), pues estos elementos son dinámicos */
                $(document).on("click",".eliminar",function()
                {
                    var total=0;
                    var parent = $(this).parents().parents().get(0);
                    $(parent).remove();
                    calculatotalsolicitud();
                });

                $(document).on("click",".eliminarDispon",function()
                {
                    var total=0;
                    var parent = $(this).parents().parents().get(0);
                    $(parent).remove();
                    calculatotalcuenta();
                });

                // $(document).on("click",".eliminarDispon",function()
                // {
                //     var total=0;
                //     var parent = $(this).parents().parents().get(0);
                //     $(parent).remove();
                //     //calculatotalsolicitud();
                // });

                $(document).on("click","#calendarioActividad", function(){
                    //
                });

                $(document).on('blur', '#txtrecargo', function ()
                {
                    var $select = $(this);
                    var $row = $select.closest('tr'); //ubica la fila en la que está perdiendo el foco
                    calculatotalfila($row);
                    calculatotalsolicitud();
                });

                $(document).on('blur', '#txtvalnetunid', function ()
                {
                    var $select = $(this);
                    var $row = $select.closest('tr'); //ubica la fila en la que está perdiendo el foco
                    var valor0=$row.find("td:eq(4)").find("input").val();
                    var valor=valor0.replace(/\./g, "");
                    //console.log(valor);
                    if(!validanumeros(valor))
                    {
                        alert("Debe contener sólo números");
                        this.value="";
                        this.focus();
                    } ;
                    var valnetunid_formato=Number(valor).toLocaleString("de-DE", {minimumFractionDigits: 0});
                    //$('#txtvalnetunid').val(valnetunid_formato);
                    //DADO QUE SÍ ES NÚMERO, REALIZA LA ACTUALIZACIÓN
                    //DE TOTAL FILA Y TOTAL SOLICITUD
                    //console.log("valnetunid: "+valnetunid_formato);
                    $row.find("td:eq(4)").find("input").val(valnetunid_formato);
                    calculatotalfila($row);
                    calculatotalsolicitud();
                });

                $(document).on('blur', '#txtcantidad', function ()
                {
                    //PRIMERO VALIDA QUE HAYA INGRESADO UN NUMERO
                    var $select = $(this);
                    var $row = $select.closest('tr'); //ubica la fila en la que está perdiendo el foco
                    var valor0=$row.find("td:eq(1)").find("input").val();
                    var valor=valor0.replace(/\./g, "");
                    if(!validanumeros(valor))
                    {
                        alert("Debe contener sólo números");
                        this.value="";
                        this.focus();
                    } ;
                    var cant_formato=Number(valor).toLocaleString("de-DE", {minimumFractionDigits: 0});
                    //$('#txtcantidad').val(cant_formato);
                    //DADO QUE SÍ ES NÚMERO, REALIZA LA ACTUALIZACIÓN
                    //DE TOTAL FILA Y TOTAL SOLICITUD
                    //console.log("cant_formato: "+cant_formato);
                    $row.find("td:eq(1)").find("input").val(cant_formato);
                    calculatotalfila($row);
                    calculatotalsolicitud();
                });

                $(document).on('blur', '#txtmonto', function ()
                {
                    var $select = $(this);
                    var $row = $select.closest('tr'); //ubica la fila en la que está perdiendo el foco
                    var valor0=$row.find("td:eq(2)").find("input").val();
                    var valor=valor0.replace(/\./g, "");
                    //console.log(valor);
                    if(!validanumeros(valor))
                    {
                        alert("Debe contener sólo números");
                        this.value="";
                        this.focus();
                    } ;
                    var valnetunid_formato=Number(valor).toLocaleString("de-DE", {minimumFractionDigits: 0});
                    //$('#txtvalnetunid').val(valnetunid_formato);
                    //DADO QUE SÍ ES NÚMERO, REALIZA LA ACTUALIZACIÓN
                    //DE TOTAL FILA Y TOTAL SOLICITUD
                    //console.log("valnetunid: "+valnetunid_formato);
                    $row.find("td:eq(2)").find("input").val(valnetunid_formato);
                    //calculatotalfilaDispon($row);
                    calculatotalcuenta();
                });

                $("#btn_subir").click(function(e)
                {
                    e.preventDefault();

                    /***********************************************************************
                     SE VALIDA QUE LOS ARCHIVOS A SUBIR SEAN MÁXIMO 5
                    DE HASTA 1 Mb Y DE TIPOS DE ARCHIVOS ADMITIDOS
                    ************************************************************************/
                    var erroresCantidadArchivos = false; // Para comprobar si hay errores
                    var erroresTipoArchivos = false;
                    var erroresTamañoArchivos = false;
                    var flagCantidadArchivos='OK';
                    var flagTamañoArchivos='OK';
                    var flagTipoArchivos='OK';
                    var maximoDeArchivos = 5; // El número máximo de archivos que se podrán enviar
                    var pesoMaximoPorArchivo = 1*1024*1024; // El peso máximo en bytes por archivo.
                    var matrizDeTiposAdmitidos = new Array(
                        'image/jpeg',
                        'image/png',
                        'application/pdf',
                        'application/vnd.ms-excel',
                        'application/msword',
                        'image/gif',
                        'text/plain',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    );
                    // Los tipos de archivos que le vamos a admitir al usuario.
                    /* A partir de aquí, se identifican los archivos y se hace la prevalidación. */
                    /* Lo primero es crear una matriz con todos los archivos que el usuario haya incluido en el campo file */
                    var cuentaErrorTamaño=0;
                    var cuentaerrorTipo=0;
                    var archivosSeleccionados = $('#archivos')[0]['files'];
                    //alert(archivosSeleccionados);
                    // Si se excede el número de archivos, marcamos que hay error.
                    var cuentaArchivos=archivosSeleccionados.length;
                    if (archivosSeleccionados.length > maximoDeArchivos){
                        erroresCantidadArchivos=true;
                        flagCantidadArchivos='ERROR. . . '
                    };
                    var listaarchivos='';
                    for (var archivo in archivosSeleccionados){
                        if (archivo != parseInt(archivo)) continue;
                        //alert(archivosSeleccionados[archivo]['name']);
                        listaarchivos=listaarchivos+archivosSeleccionados[archivo]['name']+'<br>';
                        if (archivosSeleccionados[archivo]['size'] > pesoMaximoPorArchivo){
                            erroresTamañoArchivos = true;
                            cuentaErrorTamaño++;
                            flagTamañoArchivos='ERROR. . .';
                            //break;
                        };
                        if (matrizDeTiposAdmitidos.indexOf(archivosSeleccionados[archivo]['type']) < 0){
                            erroresTipoArchivos = true;
                            cuentaerrorTipo++;
                            flagTipoArchivos='ERROR. . .';
                        }
                    };
                    //SE VALIDA QUE TODOS LOS CAMPOS REQUERIDOS SE HAYAN INGRESADO
                    /*SE VALIDA PESTAÑA 1:
                    ID DOC, ANT., MAT., SOLICITUD, lista TIPO DE COMPRA Y lista TIPOS DE FONDO*/
                    
                    //SE DETERMINA SI ESTÁ SELECCIONADO EL TIPO DE FONDO "OTROS, ESPECIFICAR"
                    var flagDescProyecto=0;
                    var opcionseleccionada='';
                    $("#tipofondo option:selected").each(function() {
                        opcionseleccionada = $(this).text();
                        if(opcionseleccionada=="OTROS, ESPECIFICAR"){
                            flagDescProyecto=1;
                        }
                    });

                    var flagFaep=0;
                    var opcionFaep='';
                    $("#tipofondo option:selected").each(function() {
                        opcionFaep = $(this).text();
                        if(opcionFaep=="FAEP"){
                            flagFaep=1;
                        }
                    });

                    //SE INICIA EL CÓDIGO DE VALIDACIÓN
                    if($("#idoc").val().length<1){
                        alert("Debes ingresar un número ID DOC");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#idoc").focus();
                    }else if($("#antecedente").val().length<1){
                        alert("Debes ingresar un Antecedente");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#antecedente").focus();
                    }else if($("#materia").val().length<1){
                        alert("Debes ingresar una Materia");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#materia").focus();
                    }else if($("#solicitud").val().length<1){
                        alert("Debes ingresar una descripción de la Solicitud");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#solicitud").focus();
                    }else if($("#tipocompra").val().trim() === ''){
                        alert("Debes seleccionar un Tipo de Compra");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#tipocompra").focus();
                    }else if($("#tipofondo").val().length<1){
                        alert("Debes seleccionar un Tipo de Fondo");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#tipofondo").focus();
                    }else if($("#listadistribucion").val().length<1){
                        alert("Debes ingresar lista de distribución de la Solicitud");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#listadistribucion").focus();     
                    }else if((flagDescProyecto==1)&&($("#descproyecto").val().length<1)){ //agregado el 02-12-2020
                        alert("Debes ingresar el nombre del proyecto");
                        $('#pills-tab a[href="#fondos"]').tab('show');
                        $('#fondos').tab('show');
                        $("#descproyecto").focus();                    
                    //setTimeout(function(){$("#descproyecto").focus();}, 1);                
                    //SE VALIDA PESTAÑA 2:
                    //EN EL CASO QUE SE HAYA SELECCIONADO FAEP EN EL PRIMER TAB
                    }else if((flagFaep==0) && $("#descadquisicion").val().length<1){
                        alert("Debes ingresar una descripción de la adquisición");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#descadquisicion").focus();
                    }else if((flagFaep==0) && $("#area").val().length<1){
                        alert("Debes ingresar un área");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#area").focus();
                    }else if((flagFaep==0) && $("#dimension").val().length<1){
                        alert("Debes ingresar una dimensión");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#dimension").focus();
                    }else if((flagFaep==0) && $("#actividad").val().trim() === ''){
                        alert("Debes indicar si hay o no actividad asociada");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#actividad").focus();
                    }else if((flagFaep==0) && ($("#actividad").val()==2)&&($("#calendarioActividad").data('datepicker').getFormattedDate('dd-mm-yyyy')==='')){
                        alert("Debes seleccionar una fecha de ejecución de la actividad");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#calendarioActividad").focus();
                    }else if((flagFaep==0) && $("#practicas").val().length<1){
                        alert("Debes ingresar las prácticas a mejorar");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#practicas").focus();
                    }else if((flagFaep==0) && $("#resultados").val().length<1){
                        alert("Debes ingresar los resultados esperados");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#resultados").focus(); 
                    }else if((flagFaep==1) && $('#componente').val().length<1){
                        alert("Debes ingresar información del componente");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#componente").focus();
                    }else if((flagFaep==1) && $('#iniciativa').val().length<1){
                        alert("Debes ingresar información de la iniciativa");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#iniciativa").focus();
                    }else if((flagFaep==1) && ($("#actividadfaep").val()==2)&&($("#calendarioActividadfaep").data('datepicker').getFormattedDate('dd-mm-yyyy')==='')){
                        alert("Debes seleccionar una fecha de ejecución de la actividad");
                        $('#pills-tab a[href="#gastos"]').tab('show');
                        $('#gastos').tab('show');
                        $("#calendarioActividadfaep").focus();                    
                    //SE VALIDA PESTAÑA 3:
                    //SE VALIDA QUE EXISTA AL MENOS UNA FILA COMPLETA. LO ÚNICO QUE ////PUEDE IR EN BLANCO ES EL "%Rec.Desp.
                    }else if(!validatabadquisicion()){
                        alert("Ingrese todos los datos del formulario de adquisiciones, línea por línea");
                        $('#pills-tab a[href="#adquisiciones"]').tab('show');
                        $('#adquisiciones').tab('show');
                        //SE VALIDA PESTAÑA 4:
                        //lista DOCUMENTOS ADJUNTOS Y ARCHIVOS SELECCIONADOS//
                    }else if($("#adjuntos").val().length<1){
                        alert("Debes seleccionar los tipos de archivos que vas adjuntar");
                        //$('#pills-tab a[href="#fondos"]').tab('show');
                        //$('#fondos').tab('show');
                        $("#adjuntos").focus();
                    }else if($("#archivos").val().length<1){
                        alert("Debes seleccionar los archivos a subir");
                        //$('#pills-tab a[href="#fondos"]').tab('show');
                        //$('#fondos').tab('show');
                        $("#archivos").focus();
                    }else if(erroresCantidadArchivos||erroresTamañoArchivos||erroresTipoArchivos){
                        //alert('RESUMEN DE ARCHIVOS SELECCIONADOS\n\nCantidad de archivos seleccionados: '+cuentaArchivos+'  -->  '+flagCantidadArchivos+'\nCantidad de archivos excedidos en tamaño: '+cuentaErrorTamaño+'  -->  '+flagTamañoArchivos+'\nCantidad de archivos no admitidos: '+cuentaerrorTipo+'  -->  '+flagTipoArchivos+'\n\nVuelva a seleccionar máximo 5 archivos, de no más de 1 Mb cada uno y del tipo admitido *.png, *.jpg, *.pdf, *.gif, *.xls, *.xlsx, *.doc, *.docx, *.txt\n');
                        $("#mostrarmodalerrores").modal('show');
                        //$("#cabeceramodal").append('');
                        $("#cabeceramodalerrores").append('RESUMEN DE ARCHIVOS SELECCIONADOS');
                        $("#cuerpomodalerrores").append('Cantidad de archivos seleccionados: '+cuentaArchivos+'  -->  '+flagCantidadArchivos+'<br>Cantidad de archivos excedidos en tamaño: '+cuentaErrorTamaño+'  -->  '+flagTamañoArchivos+'<br>Cantidad de archivos no admitidos: '+cuentaerrorTipo+'  -->  '+flagTipoArchivos+'<br><br>Vuelva a seleccionar máximo 5 archivos, de no más de 1 Mb cada uno y que sean de los tipos admitido: <br><br>*.png, *.jpg, *.pdf, *.gif, *.xls, *.xlsx, *.doc, *.docx, *.txt');
                    }else{
                        var Form=new FormData($("#frm_subedoc")[0]);
                        //$("#mostrarmodalregistrandosolicitud").modal("show");
                        $.ajax({
                            type:'POST',
                            url:"{{ route('procesasolicitud.post') }}",
                            data:Form,
                            processData:false,
                            contentType:false,
                            dataType: "json",
                            success:function(respuesta1)
                            {
                                //alert(data.success);
                               // $("#mostrarmodalregistrandosolicitud").modal("hide");
                                alert(respuesta1)
                                console.log(respuesta1);
                                var idsolicitud= respuesta1.idsolicitud;
                                alert(idsolicitud);
                                $("#archivos").val('');
                                $("#mostrarmodalresumen").modal("show");
                                $("#cabeceramodalresumen").append('<h3>Resumen de la Solicitud De Compra Generada</h3>');
                                $("#cuerpomodalresumen").append('<p align="center"><b>NÚMERO DE SOLICITUD:</b> '+idsolicitud+'<br><hr>');
                                $("#cuerpomodalresumen").append('<b>UNIDAD EDUCATICA: </b>Unidad'+'<br>');
                                $("#cuerpomodalresumen").append('<b>DIRECTOR(A): </b>Director'+'<br>');
                                $("#cuerpomodalresumen").append('<b>USUARIO: </b>Nombre'+'<br><hr>');
                                /********************SOLICITUD DE FONDOS***********************************/
                                $("#cuerpomodalresumen").append('<p align="center"><b>SOLICITUD DE FONDOS<br><hr>');
                                var fec=fechasol();
                                $("#cuerpomodalresumen").append('<b>FECHA: </b>'+fec+'<br>');
                                var iddoc=$("#idoc").val();
                                $("#cuerpomodalresumen").append('<b>ID DOC: </b>'+iddoc+'<br>');
                                var ant=$("#antecedente").val();
                                $("#cuerpomodalresumen").append('<b>ANT.: </b>'+ant+'<br>');
                                var mat=$("#materia").val();
                                $("#cuerpomodalresumen").append('<b>MAT.: </b>'+mat+'<br>');
                                var sol=$("#solicitud").val();
                                $("#cuerpomodalresumen").append('<b>SOLICITUD: </b>'+sol+'<br>');
                                var tipcom=$("#tipocompra option:selected").text();
                                $("#cuerpomodalresumen").append('<b>TIPO DE COMPRA: </b>'+tipcom+'<br>');
                                var texto='';
                                $("#tipofondo option:selected").each(function() {
                                    texto += $(this).text() + " - ";
                                });
                                $("#cuerpomodalresumen").append('<b>TIPO DE FONDO: </b>'+texto+'<br>');

                                if(flagDescProyecto==1){
                                    texto=$("#descproyecto").val();
                                    //alert(texto);
                                    $("#cuerpomodalresumen").append('<b>Descripción Proyecto: </b>'+texto+'<br><hr>');                                    
                                };

                                /**************************SOLICITUD DE GASTOS**************************************/
                                if(flagFaep==0){
                                    $("#cuerpomodalresumen").append('<p align="center"><b>SOLICITUD DE GASTOS<br><hr>');
                                    var dadq=$("#descadquisicion").val();
                                    $("#cuerpomodalresumen").append('<b>DESCRIPCIÓN ADQUISICIÓN: </b>'+dadq+'<br>');
                                    var area=$("#area").val();
                                    $("#cuerpomodalresumen").append('<b>ÁREA: </b>'+area+'<br>');
                                    var dimens=$("#dimension").val();
                                    $("#cuerpomodalresumen").append('<b>DIMENSIÓN: </b>'+dimens+'<br>');                                    
                                    if($("#actividad").val()==2){
                                        var fecactividad=$("#calendarioActividad").data('datepicker').getFormattedDate('dd-mm-yyyy');
                                        $("#cuerpomodalresumen").append('<b>FECHA ACTIVIDAD: </b>'+fecactividad+'<br>');
                                    };
                                    var pract=$("#practicas").val();
                                    $("#cuerpomodalresumen").append('<b>PRÁCTICAS A MEJORAR: </b>'+pract+'<br>');
                                    var result=$("#resultados").val();
                                    $("#cuerpomodalresumen").append('<b>RESULTADOS ESPERADOS: </b>'+result+'<br><hr>');
                                }else{
                                    $("#cuerpomodalresumen").append('<p align="center"><b>SOLICITUD DE GASTOS FONDOS F.A.E.P.<br><hr>');
                                    var dcompon=$("#componente").val();
                                    $("#cuerpomodalresumen").append('<b>COMPONENTE: </b>'+dcompon+'<br>');
                                    var dinicia=$("#iniciativa").val();
                                    $("#cuerpomodalresumen").append('<b>INICIATIVA: </b>'+dinicia+'<br>');                                    
                                    if($("#actividadfaep").val()==2){
                                        var fecactividadfaep=$("#calendarioActividadfaep").data('datepicker').getFormattedDate('dd-mm-yyyy');
                                        $("#cuerpomodalresumen").append('<b>FECHA ACTIVIDAD: </b>'+fecactividadfaep+'<br>');
                                    };
                                };
                                /**************************************************************************/
                                $("#cuerpomodalresumen").append('<p align="center"><b>FORMULARIO DE ADQUISICIONES<br><hr>');
                                var grilla=generatablaadquisicion();
                                $("#cuerpomodalresumen").append(grilla+'<br>');
                                var total=$("#ttotal").val();
                                $("#cuerpomodalresumen").append('<p align="right">Total: '+total+'<br><hr>');
                                /**************************************************************************/
                                $("#cuerpomodalresumen").append('<p align="center"><b>DOCUMENTOS ADJUNTOS<br><hr>');
                                var texto1='';
                                $("#adjuntos option:selected").each(function() {
                                    texto1 += $(this).text() + "<br>";
                                });
                                $("#cuerpomodalresumen").append('<b>TIPO DE DOCUMENTOS ADJUNTOS</b><br>');
                                $("#cuerpomodalresumen").append(texto1+'<br>');
                                $("#cuerpomodalresumen").append('<b>LISTA DE ARCHIVOS ADJUNTOS</b><br>');
                                $("#cuerpomodalresumen").append(listaarchivos+'<br>');
                            }
                        });
                    }
                });

                $("#cerrarresumen").click(function()
                {                                       
                    alert($("#area").val());
                    $("#frm_subedoc")[0].reset();
                    $('#pills-tab a[href="#fondos"]').tab('show');
                    $('#fondos').tab('show');
                    $("#calendarioActividad").attr("disabled",true);
                    //Initialize Select2 Elements
                    $('#tipocompra').select2({
                        placeholder: 'Selecciona tipo de compra'
                    });
                    //Initialize Select2 Elements
                    $('#tipofondo').select2({
                    theme: 'bootstrap4'
                    });
                    //Initialize Select2 Elements
                    $('#adjuntos').select2({
                    theme: 'bootstrap4'
                    });

                    $("#descproyecto").val('');
                    $("#descproyecto").attr("disabled",true);
                    $("#idoc").focus();
                    
                    //console.log(nsol);
                    //var nsolicitud=$nsol;
                    $('#tipfondfaep').hide();
                    $('#tipfondotros').show();

                    //SE INVOCA LA GENERACIÓN DE LA GENERACIÓN DEL PDF DE LA SOLCIITUD
                    location.href="{{ route('descargarPDF') }}";
                    //window.open("tcpdf/examples/generadocspdf.php", "Generación de Documentos","location=no,menubar=no,titlebar=no,resizable=no,toolbar=no,scrollbars=yes,width=1400,height=700");

                    //SE RETORNA EL TAB GASTOS AL DESPLIEGUE CUALQUIER FONDO

                    

                });

                //ESTO ES UN BOTÓN EXPRESS PARA VER SI SE RESETEAN TODAS LAS COSAS
                //DESPUES DE GRABAR LA SOLICITUD
                
                /*
                $("#borrar").click(function()
                {
                    $("#frm_subedoc")[0].reset();
                    $('#pills-tab a[href="#fondos"]').tab('show');
                    $('#fondos').tab('show');
                    $("#calendarioActividad").attr("disabled",true);
                    //Initialize Select2 Elements
                    $('#tipocompra').select2({
                        placeholder: 'Selecciona tu ciudad'
                    });
                    //Initialize Select2 Elements
                    $('#tipofondo').select2({
                    theme: 'bootstrap4'
                    });
                    //Initialize Select2 Elements
                    $('#adjuntos').select2({
                    theme: 'bootstrap4'
                    });
                    $("#idoc").focus();
                    //var nsol=<?php// echo $_SESSION['nsolicitud']?>;
                    //console.log(nsol);
                    //var nsolicitud=$nsol;
                    //window.open("tcpdf/examples/generadocspdf.php", "Generación de Documentos","location=no,menubar=no,titlebar=no,resizable=no,toolbar=no,scrollbars=yes,width=1400,height=700");
                });
                */
                $("#idoc").blur(function()
                {
                    var valor0=this.value;
                    //console.log("Uno: "+valor0);
                    var valor=valor0.replace(/\./g, "");
                    //console.log("Dos: "+valor);
                    if(!validanumeros(valor))
                    {
                        this.value="";
                        alert("Debe contener sólo números");
                        this.value="";
                        this.focus();
                    };
                    //formatear el numero a miles
                    var valor1=Number(valor).toLocaleString("de-DE", {minimumFractionDigits: 0});
                    //console.log("Tres: "+valor1);
                    $("#idoc").val(valor1);
                });

                $(document).on('blur', '#txtidarticulo', function ()
                {
                    var $select = $(this);
                    var $row = $select.closest('tr'); //ubica la fila en la que está perdiendo el foco
                    var valor=$row.find("td:eq(0)").find("input").val();
                    //console.log(valor);
                    if(!validanumeros(valor))
                    {
                        alert("Debe contener sólo números");
                        this.value="";
                        this.focus();
                    } ;
                });

                $(document).on('blur', '#txtrecargo', function ()
                {
                    var $select = $(this);
                    var $row = $select.closest('tr'); //ubica la fila en la que está perdiendo el foco
                    var valor=$row.find("td:eq(5)").find("input").val();
                    //console.log(valor);
                    if(!validanumeros(valor))
                    {
                        alert("Debe contener sólo números");
                        this.value="";
                        this.focus();
                    } ;
                });
            });
        </script>




        <script>

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //FUNCION QUE ENTREGA EL RÓTULO FECHA EN EL TAB SOLICITUD DE FONDOS
            (function(){
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                var f=new Date();
                fecha=(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                //console.log(fecha);
                $("#fecha").append('Coronel, '+fecha);
                //$("#fecha").append('<p>Coronel, '+fecha+'</p>');
            }());    

            $(function () {
                //Initialize Select2 Elements
                $('#tipocompra').select2({
                    placeholder: 'Selecciona el tipo de compra'
                })

                //Initialize Select2 Elements
                $('#tipofondo').select2({
                theme: 'bootstrap4'
                })

                //Initialize Select2 Elements
                $('#adjuntos').select2({
                theme: 'bootstrap4'
                })

                $('#tipfondfaep').hide();

            }());

            (function(){
                $("#calendarioActividad").attr("disabled",true);
                $("#descproyecto").attr("disabled",true);
                $("#calendarioActividadfaep").attr("disabled",true);
                $("#descproyectofaep").attr("disabled",true);
            }());
            
            function validanumeros($valida)
            {
                var respuesta=true;
                var valor=$valida;
                var valor_sinpunto = valor.replace(/\./g, "");
                //console.log(valor_sinpunto);
                var code;
                for(i=0;i<valor_sinpunto.length;i++)
                {
                    code=valor_sinpunto.charCodeAt(i);
                    //console.log(code);
                        if(code<48 || code>57)
                        {
                            respuesta=false;
                        }
                };
                return respuesta;
            };

            function calculatotalsolicitud()
            {
                //determinamos la cantidad de filas visibles
                var n=0;
                var total=0;
                var t=0;
                $("#tabla tbody tr").each(function ()
                {
                    n++;
                });
                //console.log(n);
                for(i=1;i<n;i++)   //SUMAMOS DESDE i=1 (PRIMERA FILA VISIBLE) HASTA LA ULTIMA
                {
                    var t0=$("#tabla tbody tr:eq('"+i+"') td:eq(6) input").val();
                    var t1=t0.replace(/\./g, "");

                    t=parseInt(t1);
                    if(!isNaN(t)){
                        total+=t;
                    };
                    //console.log("Linea");
                    //console.log(total);
                };
                //console.log("Solicitud");
                //console.log(total);
                var total_formato=Number(total).toLocaleString("de-DE", {minimumFractionDigits: 0});
                $("#ttotal").val(total_formato);
            };

            function calculatotalcuenta()
            {
                //determinamos la cantidad de filas visibles
                var n=0;
                var total=0;
                var t=0;
                $("#tablaDispon tbody tr").each(function ()
                {
                    n++;
                });
                //console.log(n);
                for(i=1;i<n;i++)   //SUMAMOS DESDE i=1 (PRIMERA FILA VISIBLE) HASTA LA ULTIMA
                {
                    var t0=$("#tablaDispon tbody tr:eq('"+i+"') td:eq(2) input").val();
                    var t1=t0.replace(/\./g, "");

                    t=parseInt(t1);
                    if(!isNaN(t)){
                        total+=t;
                    };
                    //console.log("Linea");
                    //console.log(total);
                };
                //console.log("Solicitud");
                //console.log(total);
                var total_formato=Number(total).toLocaleString("de-DE", {minimumFractionDigits: 0});
                $("#tmonto").val(total_formato);
            };

            function validatabadquisicion()
            {
                //determinamos la cantidad de filas visibles
                var n=0;
                var total=0;
                var t=0;
                var vacio=0;
                var test;
                $("#tabla tbody tr").each(function ()
                {
                    n++;
                });
                //console.log(n);
                for(i=1;i<n;i++)   //VALIDAMOS DESDE i=1 (PRIMERA FILA VISIBLE) HASTA LA ULTIMA
                {                    //QUE LAS FILAS TENGAN DATOS
                    test=($("#tabla tbody tr:eq('"+i+"') td:eq(0) input").val().length>0) && ($("#tabla tbody tr:eq('"+i+"') td:eq(1) input").val().length>0) && ($("#tabla tbody tr:eq('"+i+"') td:eq(2) input").val().length>0) && ($("#tabla tbody tr:eq('"+i+"') td:eq(3) input").val().length>0) && ($("#tabla tbody tr:eq('"+i+"') td:eq(4) input").val().length>0) && ($("#tabla tbody tr:eq('"+i+"') td:eq(5) input").val().length>0) && ($("#tabla tbody tr:eq('"+i+"') td:eq(6) input").val().length>0)
                    /*
                    console.log("Linea");
                    console.log($("#tabla tbody tr:eq('"+i+"') td:eq(0) input").val());
                    console.log($("#tabla tbody tr:eq('"+i+"') td:eq(1) input").val());
                    console.log($("#tabla tbody tr:eq('"+i+"') td:eq(2) input").val());
                    console.log($("#tabla tbody tr:eq('"+i+"') td:eq(3) input").val());
                    console.log($("#tabla tbody tr:eq('"+i+"') td:eq(4) input").val());
                    console.log($("#tabla tbody tr:eq('"+i+"') td:eq(5) input").val());
                    console.log($("#tabla tbody tr:eq('"+i+"') td:eq(6) input").val());

                    console.log(test);
                    */
                };
                if(test){
                    return true;
                }else{
                    return false;
                };
            };

            function generatablaadquisicion()
            {
                //determinamos la cantidad de filas visibles
                var n=0;
                var total=0;
                var t=0;
                var vacio=0;
                var test;
                $("#tabla tbody tr").each(function ()
                {
                    n++;
                });
                //console.log(n);
                var tablita='';
                tablita=`
                <table class="table table-bordered" id="tablaresumen">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">id Artículo</th>
                            <th scope="col" style="text-align: center">Cantidad</th>
                            <th scope="col" style="text-align: center">Unid. Medida</th>
                            <th scope="col" style="text-align: center">Descripción</th>
                            <th scope="col" style="text-align: center">Val.Net.Unit.</th>
                            <th scope="col" style="text-align: center">% Rec. Desp.</th>
                            <th scope="col" style="text-align: center">Total</th>
                        </tr>
                    </thead>
                    <tbody>`
                        for(i=1;i<n;i++)   //VALIDAMOS DESDE i=1 (PRIMERA FILA VISIBLE) HASTA LA ULTIMA
                        {
                            tablita=tablita+`
                            <tr>
                                <td scope="row" style="text-align: center">`+$("#tabla tbody tr:eq('"+i+"') td:eq(0) input").val()+`</td>
                                <td scope="row" style="text-align: center">`+$("#tabla tbody tr:eq('"+i+"') td:eq(1) input").val()+`</td>
                                <td scope="row" style="text-align: center">`+$("#tabla tbody tr:eq('"+i+"') td:eq(2) input").val()+`</td>
                                <td scope="row" style="text-align: center">`+$("#tabla tbody tr:eq('"+i+"') td:eq(3) input").val()+`</td>
                                <td scope="row" style="text-align: center">`+$("#tabla tbody tr:eq('"+i+"') td:eq(4) input").val()+`</td>
                                <td scope="row" style="text-align: center">`+$("#tabla tbody tr:eq('"+i+"') td:eq(5) input").val()+`</td>
                                <td scope="row" style="text-align: center">`+$("#tabla tbody tr:eq('"+i+"') td:eq(6) input").val()+`</td>
                            </tr>`
                        };
                        tablita=tablita+`
                    </tbody>
                </table>`
                return tablita;
            };

            function calculatotalfila($fila)
            {
                //OBTIENE LOS VALORES de los input
                //PROCESA CANTIDAD
                var cant_original=$fila.find("td:eq(1)").find("input").val();
                //SE LES SACA LOS PUNTOS SEPARADOR DE MILES
                var cant_sinpunto = cant_original.replace(/\./g, "");
                //CONVIERTE A NUMERO ENTERO
                var cant=parseInt(cant_sinpunto);
                //console.log("cant: "+cant);
                //formatea con miles el input
                //var cant_formato=Number(cant).toLocaleString("de-DE", {minimumFractionDigits: 0});
                //$fila.find("td:eq(1)").find("input").val(cant_formato);
                //PROCESA VALOR UNITARIO
                var vunit_original=$fila.find("td:eq(4)").find("input").val();
                //SE LES SACA LOS PUNTOS SEPARADOR DE MILES
                var vunit_sinpunto = vunit_original.replace(/\./g, "");
                //CONVIERTE A NUMERO ENTERO
                var vunit=parseInt(vunit_sinpunto);
                //console.log("vunit: "+vunit);
                //formatea con miles el input
                //var vunit_formato=Number(vunit).toLocaleString("de-DE", {minimumFractionDigits: 0});
                //$fila.find("td:eq(1)").find("input").val(vunit_formato);
                var rec=parseInt($fila.find("td:eq(5)").find("input").val());
                //console.log("rec: "+rec);
                //(cant+"-"+vunit+"-"+rec);
                test=(isNaN(cant) || isNaN(vunit) || isNaN(rec));
                //console.log("test: "+test);
                if(!test){
                    var iva=(19/100);
                    total0=Math.round(((cant*vunit)*(1+rec/100))*(1+iva));
                    //console.log("test: "+test);
                    //console.log("total0: "+total0);
                    //formatea a miles
                    total=Number(total0).toLocaleString("de-DE", {minimumFractionDigits: 0});
                    //console.log("total: "+total);
                    $fila.find("td:eq(6)").find("input").val(total);
                }else{
                    $fila.find("td:eq(6)").find("input").val("");
                };
            };

            function validaNumericos(event)
            {
                if(event.charCode >= 48 && event.charCode <= 57)
                {
                    return true;
                }
                return false;
            };

            function fechasol(){
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                var f=new Date();
                fecha=(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                //console.log(fecha);
                var salida='Coronel, '+fecha;
                //console.log(salida);
                return salida;
            };

            // Convierte una cadena alfanumérica a numérica (incluyendo formulas aritméticas)
            //
            // s   = cadena a ser convertida a numérica
            // dec = numero de decimales a redondear
            //
            // La función devuelve el numero redondeado

            function NUM(s, dec) {
                for (var s = s+"", num = "", x = 0 ; x < s.length ; x++) {
                    c = s.charAt(x);
                    if (".-+/*".indexOf(c)+1 || c != " " && !isNaN(c)) { num+=c; }
                }
                if (isNaN(num)) { num = eval(num); }
                if (num == "")  { num=0; } else { num = parseFloat(num); }
                if (dec != undefined) {
                    r=.5; if (num<0) r=-r;
                    e=Math.pow(10, (dec>0) ? dec : 0 );
                    return parseInt(num*e+r) / e;
                } else {
                    return num;
                }
            };

        </script> 

    <script>

        /*
        Swal.fire(
            'Muy Bien!',
            'Haz Clic!',
            'success'
        )
        */
    </script>
@stop
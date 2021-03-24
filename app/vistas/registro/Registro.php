<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Registro</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL; ?>public/css/estilos.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/plugins/iCheck/all.css">
    <!-- DataTables -->
     <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/dist/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="chortcut icon" type="image/png" href="<?php echo RUTA_URL; ?>public/img/LogoLcpreescolar_icon.png" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php 
    include RUTA_APP . 'vistas/includes/header.php';

    include RUTA_APP . 'vistas/includes/left_sidebar_menu.php'; 
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Registro
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Modulo*</label>
                    <select id="cmbModuloAprendizaje" name="cmbModuloAprendizaje" onchange="cargarSubmodulo(0)" class="form-control ns_"></select>
                </div>
                <div class="form-group col-md-4">
                    <label>Submodulo*</label>
                    <select id="cmbSubmoduloAprendizaje" name="cmbSubmoduloAprendizaje" onchange="cargarAprendizaje(this.value)" class="form-control ns_">
                        <option value="-1">-- Selecciona --</option>
                    </select>
                </div> 
                <div class="form-group col-md-4">
                    <label>Apredizajes*</label>
                    <datalist id="cmbAprendizajesListMod">
                        <!--option value="0" selected="selected"> -- Seleccione -- </option-->
                    </datalist>
                    <input list="cmbAprendizajesListMod" id="cmbAprendizaje" name="cmbAprendizaje" type="text" class="form-control" placeholder=" -- Escriba -- " onkeyup="javascript:this.value=this.value.toUpperCase();" onchange="MostrarAprendizaje();">
                </div>                   
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Grado*</label>
                    <select id="cmbGrado" name="cmbGrado" onchange="cargarAlumno(0)" class="form-control ns_">
                        <option value="-1">-- Selecciona --</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Alumno*</label>
                    <select id="cmbAlumno" name="cmbAlumno" onchange="mostrarAlumno()" class="form-control ns_">
                        <option value="-1">-- Selecciona --</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Folio: &nbsp;</label><label id="txtFolioVenta"></label>
                    
                    <button type="button" class="btn btn-success" id="btnMostraModalTradicional">
                    
                                                        <span class="glyphicon glyphicon-folder-open"></span>
                                                    </button>
                                                    <br>
                    <label>Número registros: &nbsp;</label><label id="txtNumeroRegistros"></label>
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="GenerarFolio()" id="txtbtnNuevaVenta">Nuevo registro</button>
            <hr>
            <div id="msgAlert2"></div>
            <h4 id="textoAlumno"></h4>
            <h4 id="textoGrado"></h4>
            <h4 id="textoAprendizaje"></h4>
            <div id="cblist">
                
            </div>
            <div class="form-group col-md-8">
                <div class="row pull-right">
                    <button type="submit" class="btn btn-primary" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
                <!-- /.box-header -->
            <div class="box" style="overflow-x:auto;">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="gridComanda" class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Nombre alumno</th>
                                <th>Grado</th>
                                <th>Aprendizaje</th>
                                <th>Medida</th>
                                <th>Fecha alta</th>
                                <th>Detalle</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>

            
        
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php 
    //include RUTA_APP . 'vistas/includes/footer.php';
    include RUTA_APP . 'vistas/includes/control_sidebar_right.php';
    ?>
</div>
<!-- ./wrapper -->
<!-- modales -->
<div class="modal fade" id="modal_formTradicional" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Folios</h2>
            </div>
            <div class="modal-body" id="muestra_formTradicional">
                <input type="hidden" id="txtcveTradicional" name="txtcveTradicional">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlert2"></div>
                    </div>
                </div>
                <div class="row table-resposive">
                    <div class="form-group col-md-12">
                        <table width="100%" id="gridDetallePaquete" class="table table-bordered table-striped" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Número registros</th>
                                    <th>Fecha alta</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo RUTA_URL; ?>public/jquery/jquery-3.4.1.min.js"></script>
<!-- <script src="<?php echo RUTA_URL; ?>public/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo RUTA_URL; ?>public/plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo RUTA_URL; ?>public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo RUTA_URL; ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo RUTA_URL; ?>public/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo RUTA_URL; ?>public/dist/js/demo.js"></script>

<script src="<?php echo RUTA_URL; ?>public/librerias/bootbox/bootbox.min.js"></script>

<script src="<?php echo RUTA_URL; ?>public/js/main.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        tableDetallePaquete = $('#gridDetallePaquete').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "bLengthChange": false,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 3}
            ],

            "bJQueryUI":true,"oLanguage": {
                "sEmptyTable":     "No hay datos registrados en la Base de Datos.",
                "sInfo":           "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sLoadingRecords": "Cargando...",
                "sProcessing":     "Procesando...",
                "sSearch":         "Buscar:",
                "sZeroRecords":    "No se encontraron resultados",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": activar para Ordenar Ascendentemente",
                    "sSortDescending": ": activar para Ordendar Descendentemente"
                }
            }
        });

        tableComanda = $('#gridComanda').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "bLengthChange": true,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 6},
                {"width": "10%","className": "text-center","targets": 7},
            ],

            "bJQueryUI":true,"oLanguage": {
                "sEmptyTable":     "No hay datos registrados en la Base de Datos.",
                "sInfo":           "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sLoadingRecords": "Cargando...",
                "sProcessing":     "Procesando...",
                "sSearch":         "Buscar:",
                "sZeroRecords":    "No se encontraron resultados",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": activar para Ordenar Ascendentemente",
                    "sSortDescending": ": activar para Ordendar Descendentemente"
                }
            }
        });
        cargarModulo();
        cargaGrado();
        consultarFolio(0);
        consultarRegistros(0);
    });

    function consultarRegistros(cve_registro){
        $.ajax({
            url      : 'Registro/consultarRegistro',
            type     : "POST",
            data    : { 
                ban: 1,
                cve_registro: cve_registro
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableComanda.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                       
                            title = 'Producto activo';
                            icon = 'fa fa-minus-circle';
                            color_icon = "color: #d12929;"
                            accion = "eliminarFolioRegistro('" +val.cve_registro+"')";
                        

                        var btn_eliminar = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";
                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar usuario' onclick=\"mostrarRegistro('" + val.cve_modulo + "','"+val.cve_submodulo+ "','"+val.cveaprendizaje_registro+ "','"+val.cve_medida+ "','"+val.cve_grado+ "','"+val.cve_alumno+ "','"+val.folio_registro+ "')\"></i>";
                        
                        tableComanda.row.add([
                            val.folio_registro,
                            val.nombre_completo,
                            val.nombre_grado,
                            val.nombre_aprendizaje,
                            val.nombre_medida,
                            val.fechaalta_registro,
                            btn_editar,
                            btn_eliminar
                        ]).draw();
                    })

                }
                else
                {
                    tableComanda = $('#gridComanda').DataTable();
                    
                }

            }
        });
    }

    function mostrarRegistro(cve_modulo,cve_submodulo,cveaprendizaje_registro,cve_medida,cve_grado,cve_alumno ,folio_registro){
        $('#cmbModuloAprendizaje').val(cve_modulo);
        $.ajax({
            url      : 'Submodulo/consultar',
            type     : "POST",
            data    : { 
                ban: 4,
                cvemodulo: cve_modulo
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbSubmoduloAprendizaje");
                select.attr('disabled',false);
                select.find('option').remove();
                select.append('<option value="-1">-- Selecciona --</option>');

                if(myJson.arrayDatos.length > 0)
                {
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_submodulo + '">' + val.nombre_submodulo + '</option>');
                    });
                    
                    $('#cmbSubmoduloAprendizaje').val(cve_submodulo);
                    
                    $.ajax({
                        url      : 'Aprendizaje/consultar',
                        type     : "POST",
                        data    : { 
                            ban: 4,
                            cve_aprendizaje: cve_submodulo
                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {
                            var nombre = '';
                            var myJson = JSON.parse(datos);

                            select = $("#cmbAprendizajesListMod");
                            select.attr('disabled',false);
                            select.find('option').remove();

                            if(myJson.arrayDatos.length > 0)
                            {
                                
                                $(myJson.arrayDatos).each( function(key, val)
                                {
                                    if(val.cve_aprendizaje != null){

                                        if(cveaprendizaje_registro == val.cve_aprendizaje){
                                            nombre = val.nombre_aprendizaje;
                                        }
                                    
                                        value = '{"cve_aprendizaje":"'+val.cve_aprendizaje+'","nombre_aprendizaje":"'+val.nombre_aprendizaje.replace(/"/g, "\\&#x22;").replace(/'/g, "&#x27;")+'"}';
                                        select.append("<option data-value='"+value+"' value='"+val.nombre_aprendizaje.replace(/'/g, "&#x27;")+"'>");
                                    }
                                });
                                
                                $('#cmbAprendizaje').val(nombre);
                                var val = $('#cmbAprendizaje').val() ? $('#cmbAprendizaje').val() : '';
                                // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
                                if(val.indexOf("\"") !== -1){
                                    var valueCombo = $("#cmbAprendizajesListMod").find("option[value='"+val+"']").data("value") ? $("#cmbAprendizajesListMod").find("option[value='"+val+"']").data("value") : "";
                                }
                                else{
                                var valueCombo = $("#cmbAprendizajesListMod").find("option[value=\""+val+"\"]").data("value") ? $("#cmbAprendizajesListMod").find("option[value=\""+val+"\"]").data("value") : "";
                                }
                                if(valueCombo.cve_aprendizaje != null){
                                    $("#textoAprendizaje").text(valueCombo.nombre_aprendizaje);
                                    $( "#textoAprendizaje" ).addClass( "fa fa-star" );
                                    $('#cblist').empty();
                                    $.ajax({
                                        url      : 'Medida/consultar',
                                        type     : "POST",
                                        data    : { 
                                            ban: 1
                                        },
                                        success  : function(datos) {
                                            var myJson = JSON.parse(datos);
                                            if(myJson.arrayDatos.length > 0)
                                            {
                                                $(myJson.arrayDatos).each( function(key, val)
                                                {
                                                    var container = $('#cblist');
                                                    $('<input />', { type: 'checkbox', name: 'group1', id: val.cve_medida, value: val.nombre_medida, onclick: "onlyOne(this)" }).appendTo(container);
                                                    $('<label />', { 'for': 'cb'+val.cve_medida, text: val.nombre_medida }).appendTo(container);
                                                    $('<h3 />').appendTo(container);

                                                    if(cve_medida == val.cve_medida ){
                                                        $("#"+val.cve_medida).prop('checked', true);
                                                    }

                                                });
                                            }

                                        }
                                    });
                                    
                                }
                                

                            }

                        }
                    });

                    $('#cmbGrado').val(cve_grado);
                    $.ajax({
                        url      : 'Alumno/consultar',
                        type     : "POST",
                        data    : { 
                            ban: 4,
                            cve_alumno: $('#cmbGrado').val()
                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {

                            var myJson = JSON.parse(datos);

                            select = $("#cmbAlumno");
                            select.attr('disabled',false);
                            select.find('option').remove();
                            select.append('<option value="-1">-- Selecciona --</option>');

                            if(myJson.arrayDatos.length > 0)
                            {
                                $(myJson.arrayDatos).each( function(key, val)
                                {
                                    select.append('<option value="' + val.cve_alumno + '">' + val.nombre_alumno +" "+ val.apep_alumno+" "+ val.apem_alumno + '</option>');
                                });

                                $('#cmbAlumno').val(cve_alumno);
                                
                            }

                            $("#textoAlumno").text('Nombre alumno: '+$("#cmbAlumno option:selected").text());
                            $("#textoGrado").text('Grado: '+$("#cmbGrado option:selected").text());
                            consultarFolio(folio_registro);
                        }
                    });

                }

            }
        });
    }

    function consultarFolio(folio){
        $.ajax({
            url      : 'Registro/consultarFolio',
            type     : "POST",
            data    : { 
                ban: 1,
                folio_folio : folio
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                    
                $("#txtFolioVenta").text(myJson.arrayDatos[0].folio_folio);
                if(myJson.arrayDatos[0].estatus_folio == "0" ){
                            $("#txtNumeroRegistros").text('0');
                        }
                        else{
                $("#txtNumeroRegistros").text(myJson.arrayDatos[0].numero_registro);

                        }

            }
        });
    }

    function cargarTablaDetallePaquete(folio)
    {
        $.ajax({
            url      : 'Registro/consultarFolio',
            type     : "POST",
            data    : { 
                ban: 2,
                cve_folio : folio
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableDetallePaquete.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                       
                            title = 'Producto activo';
                            icon = 'fa fa-plus-circle';
                            color_icon = "color: #367fa9;"
                            accion = "agregarFolioRegistro('" + val.folio_folio + "')";
                        

                        var btn_eliminar = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";
                        tableDetallePaquete.row.add([
                            val.folio_folio,
                            val.numero_registro,
                            val.fechaalta_folio,
                            btn_eliminar,
                        ]).draw();
                    })

                }
                else
                {
                    tableDetallePaquete = $('#gridDetallePaquete').DataTable();
                    
                }

            }
        });
    }

    function agregarFolioRegistro(folio){

        consultarFolio(folio);
        $('#modal_formTradicional').modal('hide');

    }

    function GenerarFolio(){
        
        
            $.ajax({
                url      : 'Registro/generarFolio',
                type     : "POST",
                data    : { 
                    ban: 1,
                    folo_venta: ''
                },
                success  : function(datos) {

                    var myJson = JSON.parse(datos);

                    
                        $("#txtFolioVenta").text(myJson.arrayDatos[0].folio_folio);
                        if(myJson.arrayDatos[0].estatus_folio == "0" ){
                            $("#txtNumeroRegistros").text('0');
                        }
                        
                        
                  
                }
            });
    }

    $('#btnGuardar').click(function (e) {
        var favorite = [];
            $.each($("input[name='group1']:checked"), function(){
                favorite.push(this.id);
            });

            var val = $('#cmbAprendizaje').val() ? $('#cmbAprendizaje').val() : '';
            // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
            if(val.indexOf("\"") !== -1){
                var valueCombo = $("#cmbAprendizajesListMod").find("option[value='"+val+"']").data("value") ? $("#cmbAprendizajesListMod").find("option[value='"+val+"']").data("value") : "";
            }
            else{
            var valueCombo = $("#cmbAprendizajesListMod").find("option[value=\""+val+"\"]").data("value") ? $("#cmbAprendizajesListMod").find("option[value=\""+val+"\"]").data("value") : "";
            }
        $.ajax({
            url      : 'Registro/guardarRegistro',
            type     : "POST",
            data    : { 
                ban: 1,
                folio_folio: $("#txtFolioVenta").text(),
                cve_alumno: $('#cmbAlumno').val(),
                cve_aprendizaje: valueCombo.cve_aprendizaje,
                cve_medida: favorite.join(", ")
            },
            success  : function(datos) {
                var myJson = JSON.parse(datos);
                    
                if(myJson.status == "success")
                {

                    msgAlert2(myJson.msg ,"info");
                    setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
                    consultarFolio($("#txtFolioVenta").text());
                    $("#cmbAprendizaje").val('');
                    $("#textoAprendizaje").text('');
                    $( "#textoAprendizaje" ).removeClass( "fa fa-star" );
                    $('#cblist').empty();
                    consultarRegistros(0);

                }
                else {
                    msgAlert2(myJson.msg ,"warning");
                    setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
                }
            }
        });
        return false;
    });

    $('#btnMostraModalTradicional').click(function (e) {
        $('#modal_formTradicional').modal({
            keyboard: false
        });
        cargarTablaDetallePaquete(0);
        $("#btnGuardar").html('Guardar');
        return false;
    });
    
    function cargarModulo(){
        $.ajax({
            url      : 'Modulo/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbModuloAprendizaje");
                select.attr('disabled',false);
                select.find('option').remove();
                select.append('<option value="-1">-- Selecciona --</option>');

                if(myJson.arrayDatos.length > 0)
                {
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_modulo + '">' + val.nombre_modulo + '</option>');
                    })
                    $("#textoAprendizaje").text('');
                    $( "#textoAprendizaje" ).removeClass( "fa fa-star" );
                    $('#cblist').empty();
                    $("#cmbAprendizaje").val('');
                }

            }
        });
    }

    function cargarSubmodulo(valor){
        $.ajax({
            url      : 'Submodulo/consultar',
            type     : "POST",
            data    : { 
                ban: 4,
                cvemodulo: $('#cmbModuloAprendizaje').val()
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbSubmoduloAprendizaje");
                select.attr('disabled',false);
                select.find('option').remove();
                select.append('<option value="-1">-- Selecciona --</option>');

                if(myJson.arrayDatos.length > 0)
                {
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_submodulo + '">' + val.nombre_submodulo + '</option>');
                    });
                    if(valor == 0){
                        document.getElementById("cmbSubmoduloAprendizaje").selectedIndex = "0";
                    }
                    else{
                        $("#cmbSubmoduloAprendizaje").val(valor).change();
                    }
                    $("#textoAprendizaje").text('');
                    $( "#textoAprendizaje" ).removeClass( "fa fa-star" );
                    $('#cblist').empty();
                    $("#cmbAprendizaje").val('');

                }

            }
        });
    }

    function cargarAprendizaje(valor2){
        $.ajax({
            url      : 'Aprendizaje/consultar',
            type     : "POST",
            data    : { 
                ban: 4,
                cve_aprendizaje: valor2
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbAprendizajesListMod");
                select.attr('disabled',false);
                select.find('option').remove();

                if(myJson.arrayDatos.length > 0)
                {
                    
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        if(val.cve_aprendizaje != null){
                        
                            value = '{"cve_aprendizaje":"'+val.cve_aprendizaje+'","nombre_aprendizaje":"'+val.nombre_aprendizaje.replace(/"/g, "\\&#x22;").replace(/'/g, "&#x27;")+'"}';
							select.append("<option data-value='"+value+"' value='"+val.nombre_aprendizaje.replace(/'/g, "&#x27;")+"'>");
                        }
                    });
                    $("#textoAprendizaje").text('');
                    $( "#textoAprendizaje" ).removeClass( "fa fa-star" );
                    $('#cblist').empty();
                    $("#cmbAprendizaje").val('');
                    

                }

            }
        });
    }

    function MostrarAprendizaje(){
        var val = $('#cmbAprendizaje').val() ? $('#cmbAprendizaje').val() : '';
            // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
            if(val.indexOf("\"") !== -1){
                var valueCombo = $("#cmbAprendizajesListMod").find("option[value='"+val+"']").data("value") ? $("#cmbAprendizajesListMod").find("option[value='"+val+"']").data("value") : "";
            }
            else{
            var valueCombo = $("#cmbAprendizajesListMod").find("option[value=\""+val+"\"]").data("value") ? $("#cmbAprendizajesListMod").find("option[value=\""+val+"\"]").data("value") : "";
            }
            if(valueCombo.cve_aprendizaje != null){
                $("#textoAprendizaje").text(valueCombo.nombre_aprendizaje);
                $( "#textoAprendizaje" ).addClass( "fa fa-star" );
                $('#cblist').empty();
                cargarMedida();
                
            }
    }

    function cargarMedida(){
        $.ajax({
            url      : 'Medida/consultar',
            type     : "POST",
            data    : { 
                ban: 1
            },
            success  : function(datos) {
                var myJson = JSON.parse(datos);
                if(myJson.arrayDatos.length > 0)
                {
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        var container = $('#cblist');
                        $('<input />', { type: 'checkbox', name: 'group1', id: val.cve_medida, value: val.nombre_medida, onclick: "onlyOne(this)" }).appendTo(container);
                        $('<label />', { 'for': 'cb'+val.cve_medida, text: val.nombre_medida }).appendTo(container);
                        $('<h3 />').appendTo(container);

                    });
                }

            }
        });
    }
    
    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('group1')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    function cargaGrado(){
        $.ajax({
            url      : 'Grado/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbGrado");
                select.attr('disabled',false);
                select.find('option').remove();
                select.append('<option value="-1">-- Selecciona --</option>');

                if(myJson.arrayDatos.length > 0)
                {
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_grado + '">' + val.nombre_grado + '</option>');
                    })
                    
                }

            }
        });
    }

    function cargarAlumno(){
        $.ajax({
            url      : 'Alumno/consultar',
            type     : "POST",
            data    : { 
                ban: 4,
                cve_alumno: $('#cmbGrado').val()
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbAlumno");
                select.attr('disabled',false);
                select.find('option').remove();
                select.append('<option value="-1">-- Selecciona --</option>');

                if(myJson.arrayDatos.length > 0)
                {
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_alumno + '">' + val.nombre_alumno +" "+ val.apep_alumno+" "+ val.apem_alumno + '</option>');
                    });
                    
                }

                $("#textoAlumno").text('');
                $("#textoGrado").text('');
            }
        });
    }

    function mostrarAlumno(){
        $("#textoAlumno").text('Nombre alumno: '+$("#cmbAlumno option:selected").text());
        $("#textoGrado").text('Grado: '+$("#cmbGrado option:selected").text());
    }

    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert2").fadeOut(1500); },1500);
    }
    
</script>

</body>
</html>

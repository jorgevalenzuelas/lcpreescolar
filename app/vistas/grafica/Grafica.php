<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Grafica</title>
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
                Grafica
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">

        <div class="row">
            <div class="form-group col-md-6">
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
                                        <th>Grafica</th>
                                    </tr>
                                </thead>
                                
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div id="pieChartContent">
                </div>
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
<!-- modales --
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
                <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
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
<script src="<?php echo RUTA_URL; ?>public/librerias/Chart/Chart.js"></script>

<script src="<?php echo RUTA_URL; ?>public/js/main.js"></script>

<script type="text/javascript">

    $(document).ready(function () {

        tableComanda = $('#gridComanda').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "bLengthChange": true,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 6},
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
        consultarRegistros(0);

    });

    function consultarRegistros(cve_registro){
        $.ajax({
            url      : 'Registro/consultarRegistro',
            type     : "POST",
            data    : { 
                ban: 2,
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

                       
                            

                        var btn_editar = "<i class='fa fa-bar-chart' style='font-size:18px; cursor: pointer;' title='Grafica alumno' onclick=\"mostrarRegistroIndividual('" + val.folio_registro + "','"+val.cve_alumno+ "','"+val.cveaprendizaje_registro+ "','"+val.nombre_completo+ "','"+val.nombre_grado+ "','"+val.nombre_aprendizaje+ "')\"></i>";
                        
                        tableComanda.row.add([
                            val.folio_registro,
                            val.nombre_completo,
                            val.nombre_grado,
                            val.nombre_aprendizaje,
                            val.nombre_medida,
                            val.fechaalta_registro,
                            btn_editar
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

    function mostrarRegistroIndividual(folio_registro,cve_alumno,cveaprendizaje_registro,nombre_completo,nombre_grado,nombre_aprendizaje){
        
        $.ajax({
            url      : 'Grafica/consultarIndividual',
            type     : "POST",
            data    : { 
                ban: 1,
                folio_registro: folio_registro,
                cve_alumno: cve_alumno,
                cveaprendizaje_registro: cveaprendizaje_registro
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);
                var semanas = [];
                var semanasValores = [];
                var semanasColores = [];
                var colores = [
                        'rgba(246, 3, 3, 0.5)',
                        'rgba(246, 221, 3, 0.5)',
                        'rgba(3, 104, 246, 0.5)',
                        'rgba(3, 246, 60, 0.5)',
                        'rgba(3, 246, 60, 0)'
                        ];
                semanas.splice(0,semanas.length);
                semanasValores.splice(0,semanasValores.length);
                semanasColores.splice(0,semanasColores.length);
                
                semanas.push("");
                semanasValores.push("0");
                semanasColores.push(colores[4]);
                cvecomentario = '';
                comentario = '';
                $(myJson.arrayDatos).each( function(key, val)
                {
                    comentario = val.comentario_comentario;
                    cvecomentario = val.cve_comentario;
                    semanas.push(val.fechaalta_registro);
                    semanasValores.push(val.valor_medida);
                    if(val.valor_medida == 1){
                        semanasColores.push(colores[0]);
                    }
                    if(val.valor_medida == 2){
                        semanasColores.push(colores[1]);
                    }
                    if(val.valor_medida == 3){
                        semanasColores.push(colores[2]);
                    }
                    if(val.valor_medida == 4){
                        semanasColores.push(colores[3]);
                    }
                    

                });

                semanas.push("");
                semanasValores.push("4");
                semanasColores.push(colores[4]);
                var pieChartContent = document.getElementById('pieChartContent');
                pieChartContent.innerHTML = '&nbsp;';
                $('#pieChartContent').append('<canvas id="pieChart" style="max-width: 500px;"><canvas>');
                $('#pieChartContent').append('<h4 id="textoFolio">Folio: '+folio_registro+'</h4>');
                $('#pieChartContent').append('<h4 id="textoAlumno">Nombre: '+nombre_completo+'</h4>');
                $('#pieChartContent').append('<h4 id="textoGrado">Grado: '+nombre_grado+'</h4>');
                $('#pieChartContent').append('<h4 id="textoAprendizaje">Aprendizaje: '+nombre_aprendizaje+'</h4>');
                $('#pieChartContent').append('<h4 id="textoComentario"><b>Comentario:</b></h4>');
                if(comentario == null || comentario == ''){
                    comentario = '';
                }
                
                $('#pieChartContent').append('<div class="row">  <div class="form-group col-md-12"> <div id="msgAlert2"></div> </div> </div>');
                $('#pieChartContent').append('<textarea id="Comentario" style="overflow:auto;resize:none" rows="4" cols="70">'+comentario+'</textarea>');
                $('#pieChartContent').append('<div class="row ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" class="btn btn-primary" onclick="btnGuardarComentario('+cvecomentario+','+folio_registro+','+cve_alumno+','+cveaprendizaje_registro+')">Guardar</button></div>');

                ctx = $("#pieChart").get(0).getContext("2d"); 
                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: semanas,
                    datasets: [{
                        label: '# of Votes',
                        data: semanasValores,
                        backgroundColor: semanasColores,
                        borderColor: semanasColores,
                        borderWidth: 1
                    }]
                    },
                    options: {
                        tooltips: {
                            enabled: true,
                            mode: 'single',
                            callbacks: {
                                title: function (tooltipItem, data) { 
                                    return data.labels[tooltipItem[0].index]; 
                                },
                                label: function(tooltipItems, data) {
                                    if(tooltipItems.yLabel == 1){
                                        return "NI INSUFICIENTE";
                                    }
                                    if(tooltipItems.yLabel == 2){
                                        return "NII BÁSICO";
                                    }
                                    if(tooltipItems.yLabel == 3){
                                        return "NIII SATISFACTORIO";
                                    }
                                    if(tooltipItems.yLabel == 4){
                                        return "NIV SOBRESALIENTE";
                                    }
                                    
                                },
                                //footer: function (tooltipItem, data) { return "..."; }
                            }
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:false
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Medida'
                                },
                                afterTickToLabelConversion : function(q){
                                    for(var tick in q.ticks){
                                        
                                        if(q.ticks[tick] == 1){
                                            q.ticks[tick] =  "NI INSUFICIENTE";
                                        }
                                        if(q.ticks[tick] == 2){
                                            q.ticks[tick] =  "NII BÁSICO";
                                        }
                                        if(q.ticks[tick] == 3){
                                            q.ticks[tick] =  "NIII SATISFACTORIO";
                                        }
                                        if(q.ticks[tick] == 4){
                                            q.ticks[tick] =  "NIV SOBRESALIENTE";
                                        }

                                        if(q.ticks[tick] == '0.5' || q.ticks[tick] == '1.5' || q.ticks[tick] == '2.5' || q.ticks[tick] == '3.5'){
                                            q.ticks[tick] =  "";
                                        }
                                        
                                    }
                                }
                                }]
                        }
                    }
                });
            }
        });
    }

    function btnGuardarComentario(cvecomentario,folio_registro,cve_alumno,cveaprendizaje_registro){
        
        $.ajax({
                url      : 'Grafica/guardarComentario',
                data     : {
                    ban : 1,
                    folio_registro : folio_registro,
                    cve_alumno  :cve_alumno,
                    cveaprendizaje_registro  : cveaprendizaje_registro,
                    cvecomentario : cvecomentario != '' ? cvecomentario : '0',
                    comentario : $('#Comentario').val() != '' ? $('#Comentario').val() : ''
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        msgAlert2(myJson.msg ,"success");
                    }
                    else
                    {
                        
                        
                    }
                }
            });
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

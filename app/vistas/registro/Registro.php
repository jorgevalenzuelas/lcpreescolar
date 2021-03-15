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
                    <label>MODULO*</label>
                    <select id="cmbModuloAprendizaje" name="cmbModuloAprendizaje" onchange="cargarSubmodulo(0)" class="form-control ns_"></select>
                </div>
                <div class="form-group col-md-4">
                    <label>SUBMODULO*</label>
                    <select id="cmbSubmoduloAprendizaje" name="cmbSubmoduloAprendizaje" onchange="cargarAprendizaje(this.value)" class="form-control ns_">
                        <option value="-1">-- Selecciona --</option>
                    </select>
                </div> 
                <div class="form-group col-md-4">
                    <label>APRENDIZAJES*</label>
                    <datalist id="cmbAprendizajesListMod">
                        <!--option value="0" selected="selected"> -- Seleccione -- </option-->
                    </datalist>
                    <input list="cmbAprendizajesListMod" id="cmbAprendizaje" name="cmbAprendizaje" type="text" class="form-control" placeholder=" -- Escriba -- " onkeyup="javascript:this.value=this.value.toUpperCase();" onchange="MostrarAprendizaje();">
                </div>                   
            </div>
            <hr>

            <h4 id="textoAprendizaje"></h4>
        
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
        cargarModulo();
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
                    })

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
            }
    }

</script>

</body>
</html>

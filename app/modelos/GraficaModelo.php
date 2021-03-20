<?php
class GraficaModelo
{
	//creamos la variable donde se instanciará la clase "conectar"
    public $conexion;

    public function __construct() {
    	//inicializamos la clase para conectarnos a la bd
        $this->conexion = new ConexionBD(); //instanciamos la clase

    }

    public function consultar($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);
        $ban  = $datosFiltrados['ban'];
        $cve_grafica = (!empty($datosFiltrados['cve_grafica']) || $datosFiltrados['cve_grafica']!=null) ? $datosFiltrados['cve_grafica'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenGrafica('$ban','$cve_grafica','$cve_usuario')";

        $c_grafica = $this->conexion->query($query);
        $r_grafica = $this->conexion->consulta_array($c_grafica);

        return $r_grafica;
    }

    public function consultarFolio($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);
        $ban  = $datosFiltrados['ban'];
        $folio_folio = (!empty($datosFiltrados['folio_folio']) || $datosFiltrados['folio_folio']!=null) ? $datosFiltrados['folio_folio'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenFolio('$ban','$folio_folio','$cve_usuario')";

        $c_medida = $this->conexion->query($query);
        $r_medida = $this->conexion->consulta_array($c_medida);

        return $r_medida;
    }

    public function consultarGrafica($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);
        $ban  = $datosFiltrados['ban'];
        $cve_grafica = (!empty($datosFiltrados['cve_grafica']) || $datosFiltrados['cve_grafica']!=null) ? $datosFiltrados['cve_grafica'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenGrafica('$ban','$cve_grafica','$cve_usuario')";

        $c_medida = $this->conexion->query($query);
        $r_medida = $this->conexion->consulta_array($c_medida);

        return $r_medida;
    }

    public function guardarGrafica($datosGrafica)
    {
        $datosFiltrados = $this->filtrarDatos($datosGrafica);

        $ban                = $datosFiltrados['ban'];
        $cve_grafica = (!empty($datosFiltrados['cve_grafica']) || $datosFiltrados['cve_grafica']!=null) ? $datosFiltrados['cve_grafica'] : '0';
        $folio_folio    = $datosFiltrados['folio_folio'];
        $cve_alumno    = $datosFiltrados['cve_alumno'];
        $cve_aprendizaje = $datosFiltrados['cve_aprendizaje'];
        $cve_medida = $datosFiltrados['cve_medida'];
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL guardarGrafica(
                                            '$ban',
                                            '$cve_grafica',
                                            '$folio_folio',
                                            '$cve_alumno',
                                            '$cve_aprendizaje',
                                            '$cve_medida',
                                            '$cve_usuario'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function generarFolio($datosFolio)
    {

        $datosFiltrados = $this->filtrarDatos($datosFolio);

        $ban                = $datosFiltrados['ban'];
        $folo_venta    = $datosFiltrados['folo_venta'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL generarFolio(
                                            '$ban',
                                            '$folo_venta',
                                            '$cveusuario_accion'
                                        )";

        $c_folio = $this->conexion->query($query);
        $r_folio = $this->conexion->consulta_array($c_folio);

        return $r_folio;
    }

    public function bloquearGrafica($datosGrafica)
    {
        $datosFiltrados = $this->filtrarDatos($datosGrafica);

        $ban               = $datosFiltrados['ban'];
        $cve_grafica  = $datosFiltrados['cve_grafica'];

        $query = "CALL eliminarGrafica('$ban','$cve_grafica')";

        $respuesta = $this->conexion->query($query);

        return $respuesta;
    }

    public function filtrarDatos($datosFiltrar){
        foreach ($datosFiltrar as $indice => $valor) {
            $datosFiltrarr[$indice] = $this->conexion->real_escape_string($valor);
        }

        return $datosFiltrarr;
    }	
}
?>
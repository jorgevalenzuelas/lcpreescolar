<?php
class GraficaModelo
{
	//creamos la variable donde se instanciará la clase "conectar"
    public $conexion;

    public function __construct() {
    	//inicializamos la clase para conectarnos a la bd
        $this->conexion = new ConexionBD(); //instanciamos la clase

    }

    public function consultarIndividual($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);
        $ban  = $datosFiltrados['ban'];
        $folio_registro = (!empty($datosFiltrados['folio_registro']) || $datosFiltrados['folio_registro']!=null) ? $datosFiltrados['folio_registro'] : '0';
        $cve_alumno = (!empty($datosFiltrados['cve_alumno']) || $datosFiltrados['cve_alumno']!=null) ? $datosFiltrados['cve_alumno'] : '0';
        $cveaprendizaje_registro = (!empty($datosFiltrados['cveaprendizaje_registro']) || $datosFiltrados['cveaprendizaje_registro']!=null) ? $datosFiltrados['cveaprendizaje_registro'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenRegistroIndividual('$ban','$folio_registro','$cve_alumno','$cveaprendizaje_registro','$cve_usuario')";

        $c_grafica = $this->conexion->query($query);
        $r_grafica = $this->conexion->consulta_array($c_grafica);

        return $r_grafica;
    }

    public function filtrarDatos($datosFiltrar){
        foreach ($datosFiltrar as $indice => $valor) {
            $datosFiltrarr[$indice] = $this->conexion->real_escape_string($valor);
        }

        return $datosFiltrarr;
    }
}
?>
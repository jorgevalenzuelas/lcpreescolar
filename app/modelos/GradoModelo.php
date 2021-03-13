<?php
class GradoModelo
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
        $cve_grado = (!empty($datosFiltrados['cve_grado']) || $datosFiltrados['cve_grado']!=null) ? $datosFiltrados['cve_grado'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenGrado('$ban','$cve_grado','$cve_usuario')";

        $c_grado = $this->conexion->query($query);
        $r_grado = $this->conexion->consulta_array($c_grado);

        return $r_grado;
    }

    public function guardarGrado($datosGrado)
    {
        $datosFiltrados = $this->filtrarDatos($datosGrado);

        $ban                = $datosFiltrados['ban'];
        $cve_grado    = $datosFiltrados['cve_grado'];
        $nombre_grado = $datosFiltrados['nombre_grado'];
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL guardarGrado(
                                            '$ban',
                                            '$cve_grado',
                                            '$nombre_grado',
                                            '$cve_usuario'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function bloquearGrado($datosGrado)
    {
        $datosFiltrados = $this->filtrarDatos($datosGrado);

        $ban               = $datosFiltrados['ban'];
        $cve_grado  = $datosFiltrados['cve_grado'];

        $query = "CALL eliminarGrado('$ban','$cve_grado')";

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
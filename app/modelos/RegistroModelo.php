<?php
class RegistroModelo
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
        $cve_registro = (!empty($datosFiltrados['cve_registro']) || $datosFiltrados['cve_registro']!=null) ? $datosFiltrados['cve_registro'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenRegistro('$ban','$cve_registro','$cve_usuario')";

        $c_registro = $this->conexion->query($query);
        $r_registro = $this->conexion->consulta_array($c_registro);

        return $r_registro;
    }

    public function guardarRegistro($datosRegistro)
    {
        $datosFiltrados = $this->filtrarDatos($datosRegistro);

        $ban                = $datosFiltrados['ban'];
        $cve_registro    = $datosFiltrados['cve_registro'];
        $nombre_registro = $datosFiltrados['nombre_registro'];
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL guardarRegistro(
                                            '$ban',
                                            '$cve_registro',
                                            '$nombre_registro',
                                            '$cve_usuario'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function bloquearRegistro($datosRegistro)
    {
        $datosFiltrados = $this->filtrarDatos($datosRegistro);

        $ban               = $datosFiltrados['ban'];
        $cve_registro  = $datosFiltrados['cve_registro'];

        $query = "CALL eliminarRegistro('$ban','$cve_registro')";

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
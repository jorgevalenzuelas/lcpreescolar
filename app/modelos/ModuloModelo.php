<?php
class ModuloModelo
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
        $cve_modulo = (!empty($datosFiltrados['cve_modulo']) || $datosFiltrados['cve_modulo']!=null) ? $datosFiltrados['cve_modulo'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenModulo('$ban','$cve_modulo','$cve_usuario')";

        $c_modulo = $this->conexion->query($query);
        $r_modulo = $this->conexion->consulta_array($c_modulo);

        return $r_modulo;
    }

    public function guardarModulo($datosModulo)
    {
        $datosFiltrados = $this->filtrarDatos($datosModulo);

        $ban                = $datosFiltrados['ban'];
        $cve_modulo    = $datosFiltrados['cve_modulo'];
        $nombre_modulo = $datosFiltrados['nombre_modulo'];
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL guardarModulo(
                                            '$ban',
                                            '$cve_modulo',
                                            '$nombre_modulo',
                                            '$cve_usuario'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function bloquearModulo($datosModulo)
    {
        $datosFiltrados = $this->filtrarDatos($datosModulo);

        $ban               = $datosFiltrados['ban'];
        $cve_modulo  = $datosFiltrados['cve_modulo'];

        $query = "CALL eliminarModulo('$ban','$cve_modulo')";

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
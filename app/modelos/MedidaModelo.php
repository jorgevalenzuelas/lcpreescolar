<?php
class MedidaModelo
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
        $cve_medida = (!empty($datosFiltrados['cve_medida']) || $datosFiltrados['cve_medida']!=null) ? $datosFiltrados['cve_medida'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];

        $query = "CALL obtenMedida('$ban','$cve_medida','$cve_usuario')";

        $c_medida = $this->conexion->query($query);
        $r_medida = $this->conexion->consulta_array($c_medida);

        return $r_medida;
    }

    public function guardarMedida($datosMedida)
    {
        $datosFiltrados = $this->filtrarDatos($datosMedida);

        $ban                = $datosFiltrados['ban'];
        $cve_medida    = $datosFiltrados['cve_medida'];
        $nombre_medida = $datosFiltrados['nombre_medida'];
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL guardarMedida(
                                            '$ban',
                                            '$cve_medida',
                                            '$nombre_medida',
                                            '$cve_usuario'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function bloquearMedida($datosMedida)
    {
        $datosFiltrados = $this->filtrarDatos($datosMedida);

        $ban               = $datosFiltrados['ban'];
        $cve_medida  = $datosFiltrados['cve_medida'];

        $query = "CALL eliminarMedida('$ban','$cve_medida')";

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
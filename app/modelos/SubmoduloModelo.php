<?php

class SubmoduloModelo
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
        $cve_submodulo = (!empty($datosFiltrados['cve_submodulo']) || $datosFiltrados['cve_submodulo']!=null) ? $datosFiltrados['cve_submodulo'] : '0';
        $cvemodulo = (!empty($datosFiltrados['cvemodulo']) || $datosFiltrados['cvemodulo']!=null) ? $datosFiltrados['cvemodulo'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL obtenSubmodulo('$ban','$cve_submodulo','$cvemodulo','$cve_usuario')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarSubmodulo($datosSubmodulo)
    {

        $datosFiltrados = $this->filtrarDatos($datosSubmodulo);

        $ban                = $datosFiltrados['ban'];
        $cve_submodulo    = $datosFiltrados['cve_submodulo'];
        $nombre_submodulo = $datosFiltrados['nombre_submodulo'];
        $cvemodulo_submodulo = $datosFiltrados['cvemodulo_submodulo'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarSubmodulo(
                                            '$ban',
                                            '$cve_submodulo',
                                            '$nombre_submodulo',
                                            '$cvemodulo_submodulo',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearSubmodulo($datosSubmodulo)
    {
        $datosFiltrados = $this->filtrarDatos($datosSubmodulo);

        $ban               = $datosFiltrados['ban'];
        $cve_submodulo  = $datosFiltrados['cve_submodulo'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarSubmodulo('$ban','$cve_submodulo','$cveusuario_accion')";

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
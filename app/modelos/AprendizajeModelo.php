<?php

class AprendizajeModelo
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
        $cve_aprendizaje = (!empty($datosFiltrados['cve_aprendizaje']) || $datosFiltrados['cve_aprendizaje']!=null) ? $datosFiltrados['cve_aprendizaje'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL obtenAprendizaje('$ban','$cve_aprendizaje','$cve_usuario')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarAprendizaje($datosAprendizaje)
    {

        $datosFiltrados = $this->filtrarDatos($datosAprendizaje);

        $ban                = $datosFiltrados['ban'];
        $cve_aprendizaje    = $datosFiltrados['cve_aprendizaje'];
        $nombre_aprendizaje = $datosFiltrados['nombre_aprendizaje'];
        $cvesubmodulo_aprendizaje = $datosFiltrados['cvesubmodulo_aprendizaje'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarAprendizaje(
                                            '$ban',
                                            '$cve_aprendizaje',
                                            '$nombre_aprendizaje',
                                            '$cvesubmodulo_aprendizaje',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearAprendizaje($datosAprendizaje)
    {
        $datosFiltrados = $this->filtrarDatos($datosAprendizaje);

        $ban               = $datosFiltrados['ban'];
        $cve_aprendizaje  = $datosFiltrados['cve_aprendizaje'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarAprendizaje('$ban','$cve_aprendizaje','$cveusuario_accion')";

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
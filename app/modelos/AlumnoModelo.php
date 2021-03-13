<?php

class AlumnoModelo
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
        $cve_alumno = (!empty($datosFiltrados['cve_alumno']) || $datosFiltrados['cve_alumno']!=null) ? $datosFiltrados['cve_alumno'] : '0';
        $cve_usuario = $_SESSION["cve_usuario"];
        $query = "CALL obtenAlumno('$ban','$cve_alumno','$cve_usuario')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarAlumno($datosAlumno)
    {

        $datosFiltrados = $this->filtrarDatos($datosAlumno);

        $ban                = $datosFiltrados['ban'];
        $cve_alumno    = $datosFiltrados['cve_alumno'];
        $nombre_alumno = $datosFiltrados['nombre_alumno'];
        $apep_alumno = $datosFiltrados['apep_alumno'];
        $apem_alumno = $datosFiltrados['apem_alumno'];
        $edad_alumno = $datosFiltrados['edad_alumno'];
        $cvegrado_alumno = $datosFiltrados['cvegrado_alumno'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarAlumno(
                                            '$ban',
                                            '$cve_alumno',
                                            '$nombre_alumno',
                                            '$apep_alumno',
                                            '$apem_alumno',
                                            '$edad_alumno',
                                            '$cvegrado_alumno',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearAlumno($datosAlumno)
    {
        $datosFiltrados = $this->filtrarDatos($datosAlumno);

        $ban               = $datosFiltrados['ban'];
        $cve_alumno  = $datosFiltrados['cve_alumno'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarAlumno('$ban','$cve_alumno','$cveusuario_accion')";

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
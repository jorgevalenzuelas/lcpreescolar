<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Alumno extends Controlador
	{
		
		public function __construct()
		{

			$this->AlumnoModelo = $this->modelo('AlumnoModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('alumno/Alumno');
		}



		public function consultar()
		{
			$data = $this->AlumnoModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarAlumno()
		{
			$datosCompletos = $this->validarDatosVaciosAlumnoGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosAlumno =  array (
									ban                => 1,
									cve_alumno   => $_POST["cve_alumno"],
									nombre_alumno => $_POST["nombre_alumno"],
									apep_alumno => $_POST["apep_alumno"],
									apem_alumno => $_POST["apem_alumno"],
									edad_alumno => $_POST["edad_alumno"],
									cvegrado_alumno => $_POST["cvegrado_alumno"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->AlumnoModelo->guardarAlumno($datosAlumno);

				
				if ($respuesta == true)
				{
					$msg = "Alumno guardado con Éxito.";
					$status = "success";
				}
				else
				{
					$msg = "Hubo un error al guardar el registro.";
					$status = "error";
				}
				
			}

			
			$envioDatos["status"] = $status;
			$envioDatos["msg"] = $msg;
			echo json_encode($envioDatos);
			
		}



		public function validarDatosVaciosAlumnoGuardar($dataPost)
		{
			if(empty($dataPost["nombre_alumno"]) || !trim($dataPost["nombre_alumno"])){ $status = "vacio"; }
			else if(empty($dataPost["apep_alumno"]) || !trim($dataPost["apep_alumno"])){ $status = "vacio"; }
			else if(empty($dataPost["apem_alumno"]) || !trim($dataPost["apem_alumno"])){ $status = "vacio"; }
			else if(empty($dataPost["edad_alumno"]) || !trim($dataPost["edad_alumno"])){ $status = "vacio"; }
			else if(empty($dataPost["cvegrado_alumno"]) || !trim($dataPost["cvegrado_alumno"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearAlumno()
		{
			$datosAlumno =  array (
								ban                => $_POST["ban"],
								cve_alumno   => $_POST["cve_alumno"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->AlumnoModelo->bloquearAlumno($datosAlumno);

			if ($respuesta == true)
			{
				if ($datosAlumno['ban'] == 2)
				{
					$msg = "Alumno bloqueado.";
				}else{
					$msg = "Alumno desbloqueado.";
				}
				$status = "success";
			}
			else
			{
				//Este error se presenta por un error en el query
				$msg = "Hubo un error al bloquear el registro.";
				$status = "error";
			}

			$envioDatos["status"] = $status;
			$envioDatos["msg"] = $msg;
			echo json_encode($envioDatos);
		}
		
	}

}


?>
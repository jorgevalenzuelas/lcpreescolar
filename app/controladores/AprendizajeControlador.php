<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Aprendizaje extends Controlador
	{
		
		public function __construct()
		{

			$this->AprendizajeModelo = $this->modelo('AprendizajeModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('aprendizaje/Aprendizaje');
		}



		public function consultar()
		{
			$data = $this->AprendizajeModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarAprendizaje()
		{
			$datosCompletos = $this->validarDatosVaciosAprendizajeGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosAprendizaje =  array (
									ban                => 1,
									cve_aprendizaje   => $_POST["cve_aprendizaje"],
									nombre_aprendizaje => $_POST["nombre_aprendizaje"],
									cvesubmodulo_aprendizaje => $_POST["cvesubmodulo_aprendizaje"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->AprendizajeModelo->guardarAprendizaje($datosAprendizaje);

				
				if ($respuesta == true)
				{
					$msg = "Aprendizaje guardado con Éxito.";
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



		public function validarDatosVaciosAprendizajeGuardar($dataPost)
		{
			if(empty($dataPost["nombre_aprendizaje"]) || !trim($dataPost["nombre_aprendizaje"])){ $status = "vacio"; }
			else if(empty($dataPost["cvesubmodulo_aprendizaje"]) || !trim($dataPost["cvesubmodulo_aprendizaje"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearAprendizaje()
		{
			$datosAprendizaje =  array (
								ban                => $_POST["ban"],
								cve_aprendizaje   => $_POST["cve_aprendizaje"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->AprendizajeModelo->bloquearAprendizaje($datosAprendizaje);

			if ($respuesta == true)
			{
				if ($datosAprendizaje['ban'] == 2)
				{
					$msg = "Aprendizaje bloqueado.";
				}else{
					$msg = "Aprendizaje desbloqueado.";
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
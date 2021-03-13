<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Submodulo extends Controlador
	{
		
		public function __construct()
		{

			$this->SubmoduloModelo = $this->modelo('SubmoduloModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('submodulo/Submodulo');
		}



		public function consultar()
		{
			$data = $this->SubmoduloModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarSubmodulo()
		{
			$datosCompletos = $this->validarDatosVaciosSubmoduloGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosSubmodulo =  array (
									ban                => 1,
									cve_submodulo   => $_POST["cve_submodulo"],
									nombre_submodulo => $_POST["nombre_submodulo"],
									cvemodulo_submodulo => $_POST["cvemodulo_submodulo"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->SubmoduloModelo->guardarSubmodulo($datosSubmodulo);

				
				if ($respuesta == true)
				{
					$msg = "Submodulo guardado con Éxito.";
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



		public function validarDatosVaciosSubmoduloGuardar($dataPost)
		{
			if(empty($dataPost["nombre_submodulo"]) || !trim($dataPost["nombre_submodulo"])){ $status = "vacio"; }
			else if(empty($dataPost["cvemodulo_submodulo"]) || !trim($dataPost["cvemodulo_submodulo"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearSubmodulo()
		{
			$datosSubmodulo =  array (
								ban                => $_POST["ban"],
								cve_submodulo   => $_POST["cve_submodulo"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->SubmoduloModelo->bloquearSubmodulo($datosSubmodulo);

			if ($respuesta == true)
			{
				if ($datosSubmodulo['ban'] == 2)
				{
					$msg = "Submodulo bloqueado.";
				}else{
					$msg = "Submodulo desbloqueado.";
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
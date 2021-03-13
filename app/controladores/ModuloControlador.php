<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Modulo extends Controlador
	{
		
		public function __construct()
		{
			$this->ModuloModelo = $this->modelo('ModuloModelo');
		}

		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('modulo/Modulo');
		}

		public function consultar()
		{
			$data = $this->ModuloModelo->consultar($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function guardarModulo()
		{
			$datosCompletos = $this->validarDatosVaciosModuloGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosModulo =  array (
									ban                => 1,
									cve_modulo   => $_POST["cve_modulo"],
									nombre_modulo => $_POST["nombre_modulo"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->ModuloModelo->guardarModulo($datosModulo);

				if ($respuesta == true)
				{
					$msg = "Modulo guardado con Éxito.";
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

		public function validarDatosVaciosModuloGuardar($dataPost)
		{
			if(empty($dataPost["nombre_modulo"]) || !trim($dataPost["nombre_modulo"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}
			return $status;
		}

		public function bloquearModulo()
		{
			$datosModulo =  array (
								ban                => $_POST["ban"],
								cve_modulo   => $_POST["cve_modulo"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->ModuloModelo->bloquearModulo($datosModulo);

			if ($respuesta == true)
			{
				if ($datosModulo['ban'] == 2)
				{
					$msg = "Modulo bloqueado.";
				}else{
					$msg = "Modulo desbloqueado.";
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
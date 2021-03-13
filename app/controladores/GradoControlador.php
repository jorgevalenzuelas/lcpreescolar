<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Grado extends Controlador
	{
		
		public function __construct()
		{
			$this->GradoModelo = $this->modelo('GradoModelo');
		}

		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('grado/Grado');
		}

		public function consultar()
		{
			$data = $this->GradoModelo->consultar($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function guardarGrado()
		{
			$datosCompletos = $this->validarDatosVaciosGradoGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosGrado =  array (
									ban                => 1,
									cve_grado   => $_POST["cve_grado"],
									nombre_grado => $_POST["nombre_grado"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->GradoModelo->guardarGrado($datosGrado);

				if ($respuesta == true)
				{
					$msg = "Grado guardado con Éxito.";
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

		public function validarDatosVaciosGradoGuardar($dataPost)
		{
			if(empty($dataPost["nombre_grado"]) || !trim($dataPost["nombre_grado"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}
			return $status;
		}

		public function bloquearGrado()
		{
			$datosGrado =  array (
								ban                => $_POST["ban"],
								cve_grado   => $_POST["cve_grado"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->GradoModelo->bloquearGrado($datosGrado);

			if ($respuesta == true)
			{
				if ($datosGrado['ban'] == 2)
				{
					$msg = "Grado bloqueado.";
				}else{
					$msg = "Grado desbloqueado.";
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
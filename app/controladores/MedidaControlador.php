<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Medida extends Controlador
	{
		
		public function __construct()
		{
			$this->MedidaModelo = $this->modelo('MedidaModelo');
		}

		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('medida/Medida');
		}

		public function consultar()
		{
			$data = $this->MedidaModelo->consultar($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function guardarMedida()
		{
			$datosCompletos = $this->validarDatosVaciosMedidaGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosMedida =  array (
									ban                => 1,
									cve_medida   => $_POST["cve_medida"],
									nombre_medida => $_POST["nombre_medida"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->MedidaModelo->guardarMedida($datosMedida);

				if ($respuesta == true)
				{
					$msg = "Medida guardado con Éxito.";
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

		public function validarDatosVaciosMedidaGuardar($dataPost)
		{
			if(empty($dataPost["nombre_medida"]) || !trim($dataPost["nombre_medida"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}
			return $status;
		}

		public function bloquearMedida()
		{
			$datosMedida =  array (
								ban                => $_POST["ban"],
								cve_medida   => $_POST["cve_medida"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->MedidaModelo->bloquearMedida($datosMedida);

			if ($respuesta == true)
			{
				if ($datosMedida['ban'] == 2)
				{
					$msg = "Medida bloqueado.";
				}else{
					$msg = "Medida desbloqueado.";
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
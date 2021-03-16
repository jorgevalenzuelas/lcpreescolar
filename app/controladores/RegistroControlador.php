<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Registro extends Controlador
	{
		
		public function __construct()
		{

			$this->registroModelo = $this->modelo('RegistroModelo');

		}

		

		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('registro/Registro');
		}

		public function consultarFolio()
		{
			$data = $this->registroModelo->consultarFolio($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function consultarRegistro()
		{
			$data = $this->registroModelo->consultarRegistro($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function guardarRegistro()
		{
			$datosCompletos = $this->validarDatosVaciosRegistroGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_registro = (!empty($_POST["cve_registro"])) ? $_POST["cve_registro"] : 0 ;
				$datosRegistro =  array (
									ban                => $_POST["ban"],
									cve_registro   => $cve_registro,
									folio_folio                => $_POST["folio_folio"],
									cve_alumno   => $_POST["cve_alumno"],
									cve_aprendizaje => $_POST["cve_aprendizaje"],
									cve_medida => $_POST["cve_medida"]
							     );
				$respuesta = $this->registroModelo->guardarRegistro($datosRegistro);

				if ($respuesta == true)
				{
					$msg = "Registro guardado con Éxito.";
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

		public function generarFolio()
		{
			//Preparamos en un array los datos que enviaremos a la BD
			$datosFolio =  array (
								ban                => $_POST["ban"],
								folo_venta                => $_POST["folo_venta"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
								);
			
			$respuesta = $this->registroModelo->generarFolio($datosFolio);

			$envioDatos["arrayDatos"] = $respuesta;

			echo json_encode($envioDatos);
		}

		public function validarDatosVaciosRegistroGuardar($dataPost)
		{
			if(empty($dataPost["cve_alumno"]) || !trim($dataPost["cve_alumno"])){ $status = "vacio"; }
			else if(empty($dataPost["cve_aprendizaje"]) || !trim($dataPost["cve_aprendizaje"])){ $status = "vacio"; }
			else if(empty($dataPost["cve_medida"]) || !trim($dataPost["cve_medida"])){ $status = "vacio"; }
			else if(empty($dataPost["folio_folio"]) || !trim($dataPost["folio_folio"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}
			return $status;
		}

	}

}


?>
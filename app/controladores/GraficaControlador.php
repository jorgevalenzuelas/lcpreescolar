<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Grafica extends Controlador
	{
		
		public function __construct()
		{

			$this->graficaModelo = $this->modelo('GraficaModelo');

		}

		

		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('grafica/Grafica');
		}

		public function consultarFolio()
		{
			$data = $this->graficaModelo->consultarFolio($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function consultarGrafica()
		{
			$data = $this->graficaModelo->consultarGrafica($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function guardarGrafica()
		{
			$datosCompletos = $this->validarDatosVaciosGraficaGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_grafica = (!empty($_POST["cve_grafica"])) ? $_POST["cve_grafica"] : 0 ;
				$datosGrafica =  array (
									ban                => $_POST["ban"],
									cve_grafica   => $cve_grafica,
									folio_folio                => $_POST["folio_folio"],
									cve_alumno   => $_POST["cve_alumno"],
									cve_aprendizaje => $_POST["cve_aprendizaje"],
									cve_medida => $_POST["cve_medida"]
							     );
				$respuesta = $this->graficaModelo->guardarGrafica($datosGrafica);

				if ($respuesta == true)
				{
					$msg = "Grafica guardado con Éxito.";
					$status = "success";
				}
				else
				{
					$msg = "Hubo un error al guardar el grafica.";
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
			
			$respuesta = $this->graficaModelo->generarFolio($datosFolio);

			$envioDatos["arrayDatos"] = $respuesta;

			echo json_encode($envioDatos);
		}

		public function validarDatosVaciosGraficaGuardar($dataPost)
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
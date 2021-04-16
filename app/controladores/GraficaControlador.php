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

		public function consultarIndividual()
		{
			$data = $this->graficaModelo->consultarIndividual($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function guardarComentario()
		{
			$datosCompletos = $this->validarDatosVaciosguardarComentario($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosGrado =  array (
									ban	=>	$_POST["ban"],
									folio_registro	=> $_POST["folio_registro"],
									cve_alumno	=> $_POST["cve_alumno"],
									cveaprendizaje_registro => $_POST["cveaprendizaje_registro"],
									cvecomentario	=> $_POST["cvecomentario"],
							     	comentario  => $_POST["comentario"],
									cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->graficaModelo->guardarComentario($datosGrado);

				if ($respuesta == true)
				{
					$msg = "Comentatio guardado con Éxito.";
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

		public function validarDatosVaciosguardarComentario($dataPost)
		{
			if(empty($dataPost["comentario"]) || !trim($dataPost["comentario"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}
			return $status;
		}

	}

}


?>
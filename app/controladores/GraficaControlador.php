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

	}

}


?>
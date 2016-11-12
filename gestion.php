<?php 
session_start();

require_once "Clase/Vehiculo.php";
require_once "Clase/Estacionamiento.php";

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
$contrasenia = isset($_POST['contra']) ? $_POST['contra'] : NULL;
$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago)
{
	case 'mostrarLogin':

			//include("login.html");
			$retorno;

			if($usuario=="admin@admin.com" && $contra=="1234")
			{
				
				setcookie("registro",$usuario,  time()+36000 , '/');
				
				$_SESSION['registrado']="admin";
				$retorno="ingreso";
				include ("index.html");
				
			}else
			{
				$retorno= "NO-REGISTRADO";
			}

			echo $retorno;
			break;

		case 'Agregar':

		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$obj = isset($_POST['mascota']) ? json_decode(json_encode($_POST['mascota'])) : NULL;
		
		$m = new Mascota($obj->edad,$obj->nombre,$obj->fechaNac,$obj->tipo,isset($obj->sexo),$obj->archivo);
		
		if(!Mascota::Guardar($m)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			if(!Archivo::Mover("./tmp/".$obj->archivo, "./archivos/".$obj->archivo)){
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "Lamentablemente ocurrio un error al mover el archivo del repositorio temporal al repositorio final.";
			}
			else{
				$retorno["Mensaje"] = "El archivo fue escrito correctamente. Mascota agregada CORRECTAMENTE!!!";
			}
		}
	
		echo json_encode($retorno);
		
		break;


		case 'borrarVehiculo':

			$vehiculo = new vehiculo();
			$vehiculo->patente=$_POST['patente'];
			$cantidad=$vehiculo->BorrarCd();
			echo $cantidad;

		break;

		case 'mostrarGrilla':
		echo Estacionamiento::MostrarGrilla();

		break;

}






 ?>
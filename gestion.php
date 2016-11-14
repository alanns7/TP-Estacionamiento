<?php 
session_start();

require_once "Clase/Vehiculo.php";
require_once "Clase/Estacionamiento.php";

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
$contrasenia = isset($_POST['contra']) ? $_POST['contra'] : NULL;
$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;
date_default_timezone_set("America/Buenos_Aires");

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

		case 'guardarVehiculo':

			/*$patente = isset($_POST['patente']) ? json_decode(json_encode($_POST['patente'])) : NULL;
			$auto=new Vehiculo($patente,date(date_default_timezone_get()));

			if(Estacionamiento::ComprobarSiEstaLaPatente($patente)){
				$retorno["Mensaje"]="La patente ya se encuentra disponible";
				$retorno['Exito']=false;
			}
			else{

				if($auto->Guardar()){
					$retorno["Mensaje"]="Guardado existosamente";
					$retorno["Exito"]= true;
				}
				else{

					$retorno["Mensaje"]="No se guardo, lo siento";
					$retorno["Exito"]=!true;
				}
			}
			echo json_encode($retorno);
			# code...
			break;*/
			$auto = new Vehiculo();
			$auto->id=$_POST['id'];
			$auto->patente=$_POST['patente'];
			$auto->ingreso= date("H:i:s", time());
			
			if($auto->Guardar())
			{
			
			$retorno["Mensaje"]="Guardado existosamente";
					$retorno["Exito"]= true;

			}
			else{

					$retorno["Mensaje"]="No se guardo, lo siento";
					$retorno["Exito"]=!true;
				}
				echo json_encode($retorno);
				break;

		case 'borrarVehiculo':

			$vehiculo = new Vehiculo();
			$vehiculo->patente=$_POST['patente'];
			$cantidad=$vehiculo->BorrarVehiculo();
			echo $cantidad;

		break;

		case 'mostrarGrilla':
		echo Estacionamiento::MostrarGrilla();

		break;

}






 ?>
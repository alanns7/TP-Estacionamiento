<?php 
session_start();

require_once "Clase/Vehiculo.php";
require_once "Clase/Estacionamiento.php";

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
$contra = isset($_POST['contra']) ? $_POST['contra'] : NULL;
$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;
date_default_timezone_set("America/Buenos_Aires");
$tipoUsuario=0;
switch($queHago)
{
		case 'mostrarLogin':

			//include("login.html");
			$retorno="";

			if($usuario=="")
			{
				$retorno="NO-REGISTRADO";
			}

			if(($usuario=="admin@admin.com") || ($usuario=="octavio@octavio.com"))
			{
				
				setcookie("registro",$usuario,  time()+36000 , '/');
				
				$_SESSION['registrado']="admin";
				$retorno="admin";
				include ("index.html");
				
			}else
			{
				setcookie("registro",$usuario,  time()+36000 , '/');
				
				$_SESSION['registrado']="usuario";
				$retorno="user";
				include ("index.html");
			}

			echo $retorno;
			setcookie("mailUsrAux", $usuario , time() + (86400 * 30), "/");
			break;
				
				
		case 'guardarVehiculo':

			$auto = new Vehiculo();
			$auto->id=$_POST['id'];
			$auto->patente=$_POST['patente'];
			$auto->usuario=$_COOKIE["mailUsrAux"];
			$auto->ingreso= date("H:i:s", time());
			//$auto->usuario=$usuario;

			
		  	if(($auto->usuario == "admin@admin.com") || ($auto->usuario =="octavio@octavio.com"))
		  	{
		  		$auto->privilegio="Administrador";
		  	}
		  	else
		  	{
		  		$auto->privilegio="Usuario";
		  	}
		  
			if(($auto->patente != "") && ($auto->Guardar()))
			{
			
			$retorno["Mensaje"]="Guardado existosamente";
					$retorno["Exito"]= true;

			}
			else{

					$retorno["Mensaje"]="No se ha podido guardar. Verifique que el campo no este vacio";
					$retorno["Exito"]=false;
					
				}
				echo json_encode($contra);
			
				break;


		case 'borrarVehiculo':

			$retorno["Exito"] = TRUE;
			$retorno["Mensaje"] = "";

			$vehiculo = new Vehiculo();
			$vehiculo->patente=$_POST['patente'];
			$vehiculo->egreso=date("H:i:s", time());
			

			if($vehiculo->patente!="")
			{

				$retorno["Mensaje"]="El auto con patente ".$vehiculo->patente." fue retirado correctamente. Importe a cobrar: $".Estacionamiento::Importe($vehiculo->patente);
			
			}
			else
			{
				$retorno["Mensaje"]="Por favor rellene el cuadro de dialogo con una patente valida";
			}
			$cantidad=$vehiculo->BorrarVehiculo();
			echo json_encode($retorno);
			
			break;


		case 'mostrarGrilla':
			
			if(($usuario =="admin@admin.com") || ($usuario=="octavio@octavio.com"))
			{
				echo Estacionamiento::MostrarGrilla(0);
			}

			else
			{
				echo Estacionamiento::MostrarGrilla(1);
			}

			break;

}






 ?>
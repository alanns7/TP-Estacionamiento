<?php 

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
$contrasenia = isset($_POST['contra']) ? $_POST['contra'] : NULL;
$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago)
{
	case 'chequearUsu':
		{
		echo ("hola");
		break;
		}
		case 'login':
		{
			
			if (($usuario=="admin") && ($contrasena=="1234")){
			
			//se define una sesion y se guarda el dato session_start();
			$_SESSION["autenticado"]= "SI";
			header ("Location: index.php");
			}else {
			//si no existe se va a login.php
			echo("Usted no se ha registrado");
			header("Location: login.php?errorusuario=si");
			
			}
			
			
			break;

		}
}






 ?>
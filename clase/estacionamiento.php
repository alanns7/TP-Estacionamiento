<?php 

require_once("accesoDatos/AccesoDatos.php");
require_once("Clase/vehiculo.php");


class Estacionamiento{

		public static function dateDiff($start, $end) { 

				$start_ts = strtotime($start); 
				$end_ts = strtotime($end); 
				$diff =$end_ts-$start_ts; 

				return round($diff /60); 
		} 

		 static function DarFormato($fecha){
			$formato=explode("/",$fecha);
			return "$formato[0]";
			
			
		}
	   public static function MostrarGrilla(){
	   
	   		$hoy = getdate();
	   		echo "$hoy[hours]:$hoy[minutes]:$hoy[seconds]";

		    $grilla="<table class='table' border=1 style='background:rgb(14, 26, 112);color:#fff;>
		        <thead style='background:rgb(14, 26, 112);color:#fff;'>
		        <tr>
		        <th colspan='4'>Grilla Vehiculos</th>
		        </tr>

		        <tr>
		            <th>Patente</th>
		            <th>Hora Ingreso</th>
		            <th>Hora Egreso</th>
		            <th>Importe a Cobrar</th>
		        </tr>
		        </thead>";

			 $autos= Estacionamiento::TraerLosAutos();

		     if(count($autos)>0){
		     	
			        foreach ($autos as $auto) { 
			        $autoAux=array();

			       // $autoAux["nombrePropiedad"]=$auto->propiedad;
			       $autoAux["patente"]=$auto->patente;
			       $autoAux["ingreso"]=$auto->ingreso;
			       
			       $fechaFormateada=estacionamiento::DarFormato($autoAux["ingreso"]);
			       $diffFecha=estacionamiento::dateDiff($fechaFormateada
			     		,date("Y-m-d H:i:s"));
					$grilla .= "<tr>
								<td>".$auto->patente."</td>
								<td>".$fechaFormateada."</td>
								<td>"."      -        "."</td>
								<td>"."stringDiferencia"."</td>
								
								</tr>";
							}
				
					$grilla .= '</table>';		
					
			 }
			 return $grilla;
			}
			

		public static function TraerLosAutos(){
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		    $consulta =$objetoAccesoDato->RetornarConsulta("select patente, ingreso from vehiculos");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");
			}
		

	    public static function ComprobarSiEstaLaPatente($patente){

	    	$listaDeAutos[]=Estacionamiento::TraerLosAutos();

	    	if(count($listaDeAutos)==0){

	    		return false;
	    	}
	    	foreach ($listaDeAutos as $auto) {

	    		if($patente == $auto[0]){    			
	    			return true;
	    		}
	    		# code...
	    	}
	    	return false;
	    }
	    static function PrecioAbonar($fecha){
	    	$formato=Estacionamiento::DarFormato($fecha);
	    	$minutos=Estacionamiento::dateDiff($formato,date("Y-m-d H:i:s"));
	    	return ($minutos*0.85);
	    }


	    public function InsertarVehiculo()
	 	{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into vehiculos(patente,ingreso)values('$this->patente','$this->fecha')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 	}


}


 ?>
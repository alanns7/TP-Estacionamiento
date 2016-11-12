<?php 
class Vehiculo{
	public $patente;
    public $fecha;

    function GetPatente(){
    	return $this->patente;
    }

    function GetFecha(){
    	return $this->fecha;
    }
    function __construct($patente,$fecha){
    	
    	$this->patente=$patente;
    	$this->fecha=$fecha;
    }
    function ToString(){
    	return $this->patente."-".$this->fecha."-"."\n";
    }
    

public function ModificarCdParametros()
     {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update vehiculos 
                set patente=:patente,
                ingreso=:fecha,
                WHERE patente=:patente");
                $consulta->bindValue(':patente',$this->patente, PDO::PARAM_STR);
                $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
            return $consulta->execute();
     }

     public function InsertarElVehiculoParametros()
     {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into vehiculos (patente,ingreso)values(:patente,:fecha)");
                $consulta->bindValue(':patente',$this->patente, PDO::PARAM_STR);
                $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
                $consulta->execute();       
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
     }


    public function GuardarVehiculo()
     {

        if($this->id>0)
            {
                $this->ModificarCdParametros();
            }else {
                $this->InsertarElCdParametros();
            }

     }

}


?>
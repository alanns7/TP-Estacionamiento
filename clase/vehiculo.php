<?php 
class Vehiculo{
    public $id;
	public $patente;
    public $ingreso;

   /* function GetPatente(){
    	return $this->patente;
    }

    function GetIngreso(){
    	return $this->ingreso;
    }

    function __construct($patente,$ingreso){
    	
    	$this->patente=$patente;
    	$this->ingreso=$ingreso;
    }*/
    function ToString(){
    	return $this->patente."-".$this->ingreso."-"."\n";
    }
    

    public function BorrarVehiculo()
     {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                delete 
                from vehiculos                
                WHERE patente=:patente"); 
                $consulta->bindValue(':patente',$this->patente, PDO::PARAM_STR);      
                $consulta->execute();
                return $consulta->rowCount();
     }

public function ModificarVehiculoParametros()
     {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update vehiculos 
                set patente=:patente,
                ingreso=:ingreso,
                WHERE patente=:patente");
                $consulta->bindValue(':patente',$this->patente, PDO::PARAM_STR);
                $consulta->bindValue(':ingreso', $this->ingreso, PDO::PARAM_STR);
            return $consulta->execute();
     }

     public function InsertarVehiculoParametros()
     {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into vehiculos (patente,ingreso)values(:patente,:ingreso)");
                $consulta->bindValue(':patente',$this->patente, PDO::PARAM_STR);
                $consulta->bindValue(':ingreso', $this->ingreso, PDO::PARAM_STR);
                $consulta->execute();       
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
     }


    public function Guardar()
     { 
        if($this->id>0)
            { 
                $this->ModificarVehiculoParametros();
                return false;
            }else {

                $this->InsertarVehiculoParametros();
                return true;
            }

     }

}


?>
<?php

require_once("accesoDatos/AccesoDatos.php");
require_once("Clase/vehiculo.php");


class Estacionamiento
{
    
    public static function dateDiff($start, $end)
    {
        
        $start_ts = strtotime($start);
        $end_ts   = strtotime($end);
        $diff     = $end_ts - $start_ts;
        if ($diff < 0) {
            $diff = $diff * (-1);
        }
        return round($diff / 60);
    }
    
    
    public static function Importe($patente)
    {
        $autos = Estacionamiento::TraerLosAutos();
        
        if (count($autos) > 0) {
            
            foreach ($autos as $auto) {
                if ($patente == $auto->patente) {
                    $autoAux = array();
                    
                    // $autoAux["nombrePropiedad"]=$auto->propiedad;
                    $autoAux["patente"] = $auto->patente;
                    $autoAux["ingreso"] = $auto->ingreso;
                    
                    $fechaFormateada = Estacionamiento::DarFormato($autoAux["ingreso"]);
                    $tiempo          = Estacionamiento::dateDiff($fechaFormateada, date("Y-m-d H:i:s"));
                    return $tiempo * 1.50;
                }
                
            }
            
            
        }
        
    }
    
    
    
    static function DarFormato($fecha)
    {
        $formato = explode("/", $fecha);
        return "$formato[0]";
        
        
    }
    public static function MostrarGrilla($num)
    {
        
        $hoy = getdate();
        echo "$hoy[hours]:$hoy[minutes] Hs.";
        
        $grilla = "<table class='table' border=1 style='background:rgb(14, 26, 112);color:#fff;>
                <thead style='background:rgb(14, 26, 112);color:#fff;'>
                <tr>
                <th colspan='6'>Grilla Vehiculos</th>
                </tr>

                <tr>
                    <th>Patente</th>
                    <th>Hora Ingreso</th>
                    <th>Tiempo transcurrido (minutos)</th>
                    <th>Importe hasta el momento</th>
                    <th>Usuario</th>
                    <th>Privilegio</th>
                </tr>
                </thead>";
        
        $autos = Estacionamiento::TraerLosAutos();
        if (count($autos) > 0) {
            if ($num == 0) {
                    
                    foreach ($autos as $auto) {
                        $autoAux = array();
                        
                        // $autoAux["nombrePropiedad"]=$auto->propiedad;
                        $autoAux["patente"]    = $auto->patente;
                        $autoAux["ingreso"]    = $auto->ingreso;
                        $autoAux["usuario"]    = $auto->usuario;
                        $autoAux["privilegio"] = $auto->privilegio;
                        
                        $fechaFormateada = estacionamiento::DarFormato($autoAux["ingreso"]);
                        $tiempo          = estacionamiento::dateDiff($autoAux["ingreso"], date("Y-m-d H:i:s"));
                        $grilla .= "<tr>
                                    <td>" . $auto->patente . "</td>
                                    <td>" . $fechaFormateada . "</td>
                                    <td>" . $tiempo . "</td>
                                    <td>" . "$" . $tiempo * 1.50 . "</td>
                                    <td>" . $auto->usuario . "</td>
                                    <td>" . $auto->privilegio . "</td>
                                    
                                    </tr>";
                    }
                    
                    $grilla .= '</table>';         
                
            } else {
                
                              
                    foreach ($autos as $auto) {
                        $autoAux = array();
                        
                        // $autoAux["nombrePropiedad"]=$auto->propiedad;
                        $autoAux["patente"] = $auto->patente;
                        $autoAux["ingreso"] = $auto->ingreso;
                        $autoAux["usuario"] = $auto->usuario;
                        
                        $fechaFormateada = estacionamiento::DarFormato($autoAux["ingreso"]);
                        $tiempo          = estacionamiento::dateDiff($fechaFormateada, date("Y-m-d H:i:s"));
                        $grilla .= "<tr>
                                    <td>" . $auto->patente . "</td>
                                    <td>" . $fechaFormateada . "</td>
                                    <td>" . $tiempo . "</td>
                                    <td>" . "$" . $tiempo * 1.50 . "</td>
                                    </tr>";
                    }
                    
                    $grilla .= '</table>';      
                
               
            }
             return $grilla;
        }
    }
    public static function TraerLosAutos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta         = $objetoAccesoDato->RetornarConsulta("select patente, ingreso, usuario, privilegio from vehiculos");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");
    }
    
    
    public static function ComprobarSiEstaLaPatente($patente)
    {
        
        $listaDeAutos[] = Estacionamiento::TraerLosAutos();
        
        if (count($listaDeAutos) == 0) {
            
            return false;
        }
        foreach ($listaDeAutos as $auto) {
            
            if ($patente == $auto[0]) {
                return true;
            }
            # code...
        }
        return false;
    }
    static function PrecioAbonar($fecha)
    {
        $formato = Estacionamiento::DarFormato($fecha);
        $minutos = Estacionamiento::dateDiff($formato, date("Y-m-d H:i:s"));
        return ($minutos * 0.85);
    }
    
    
    public function InsertarVehiculo()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta         = $objetoAccesoDato->RetornarConsulta("INSERT into vehiculos(patente,ingreso,usuario, privilegio)values('$this->patente','$this->fecha','$this->usuario','$this->privilegio')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    
    
}


?>

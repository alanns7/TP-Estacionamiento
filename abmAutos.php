
<!doctype html>
<html lang="en-US">
<head>

  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title> Estacionamiento </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
 <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="./js/funciones.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <link rel="stylesheet" type="text/css" href="css/animacion.css">
   <link rel="stylesheet" type="text/css" href="css/propios.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/style2.css">

 

  <!--script type="text/javascript" src="js/currency-autocomplete.js"></script-->
<script type="text/javascript" >

$(document).ready(function(){
  mostrarGrilla();
});

</script>
</head>
	<body>
    <div class="CajaUno animated bounceInDown">

            <form id="FormIngreso">
            <input type="text" id="patente" name="patente" required/>
            <br>
            <input type="button" class="MiBotonUTN" value="ingreso" onclick="IngresoDeDatos(0)" name="estacionar" />
            <br/>
            <input type="button" class="MiBotonUTN" value="egreso" onclick="IngresoDeDatos(1)" name="estacionar" />
            <input readonly   type="hidden" id="idVehiculo" class="form-control" >
             <br/>

          </form>
          <div id="divImagen" style="height:350px;overflow:auto">
          </div>
    </div>
         <div id="divGrilla" class="BoxRight animated bounceInDown" style="width:421px;overflow:auto;border-style:solid;height:700px">
      </div>
      <div class="CajaEnunciado animated bounceInLeft">
      <h2>autos:</h2>
      <br>
      <h1>Precios</h1>
      <br>
      <h3 align="center">Hora:$51
        <br>
          Minuto:$0.85
      </h3>
    </div>	
	</body>
</html>
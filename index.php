<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Estacionamiento</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/funciones.js"></script>

  
</head>

<body background="./imagenes/estacionamiento.jpg">
  <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <h2><a id="loginform">Login</a></h2>
    <div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">
        <div class="randompad">
           <fieldset>
           <?php 
           setcookie("mailUsrAux", "NONE" , time() -8 , "/");
            ?>

           <form id="frmIngreso" action="abmAutos.php" method="POST">
             <label name="lblUsuario">Usuario</label><br>
             <input type="email" value="example@gmail.com" name="usuario" id="usuario" maxlen="20"/>
             <label name="password">Password</label>
             <input type="password" name="contra" id="contra"/>
             <input type="submit" value="Login" onclick="MostrarLogin();return false;"/><br><br>
             
             <input type="submit" value="Test Usuario" name="testUsu" onclick="testUsuario();return false"/>
             <input type="submit" value="Test Admin" name="testAdm" onclick="testAdmin();return false"/>
            </form>
           </fieldset>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
<div>
Admin: admin@admin.com - Contra: 1234<br>
Admin: octavio@octavio.com - Contra: 5678 

</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

      <script src="js/index.js"></script>

</body>
<img src="./imagenes/estacionamiento.jpg" height="100%" width="100%" />
</html>

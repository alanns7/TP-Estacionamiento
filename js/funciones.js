var pagina = "./gestion.php";                                                                                     
    var usuario=$('#usuario').val();
    var contrasenia=$('#contra').val();

function testAdmin(){

	$('#usuario').val("admin@admin.com");
	$('#contra').val("1234");
}

function testUsuario(){

    $('#usuario').val("user@user.com");
    $('#contra').val("5678");
}


function MostrarLogin()
{
    //confirm("MOSTRAR LOGIN");
    var pagina = "./gestion.php";                                                                                     
    var usuario=$('#usuario').val();
    var contrasenia=$('#contra').val();

    var funcionAjax=$.ajax({
        url:pagina,
        type:'POST',
        data:{
            usuario: usuario,
            contra: contrasenia,
            queHago:"mostrarLogin"}
    });
    funcionAjax.done(function(retorno){
        if(retorno == "NO-REGISTRADO") {
            alert(" usted no esta registrado");
            return false;
        }
        $('#frmIngreso').submit();
    });
    funcionAjax.fail(function(retorno){
        
        $("#informe").html(retorno.responseText);   
    });
    funcionAjax.always(function(retorno){
        //alert("siempre "+retorno.statusText);

    });
}


/*function validarLogin()
{
        var varUsuario=$("#usuario").val();
        var varClave=$("#clave").val();
        
$("#informe").html("<img src='imagenes/ajax-loader.gif' style='width: 30px;'/>");
    

    var funcionAjax=$.ajax({
        url:"php/gestion.php",
        type:"post",
        data:{
            recordarme:recordar,
            usuario:varUsuario,
            clave:varClave
        }
    });


    funcionAjax.done(function(retorno){
        //alert(retorno);
            if(retorno!="No-esta"){ 
                MostarBotones();
                MostarLogin();

                $("#BotonLogin").html("Ir a salir<br>-Sesión-");
                $("#BotonLogin").addClass("btn btn-danger");                
                $("#usuario").val("usuario: "+retorno);
            }else
            {
                $("#informe").html("usuario o clave incorrecta");   
                $("#formLogin").addClass("animated bounceInLeft");
            }
    });
    funcionAjax.fail(function(retorno){
        $("#botonesABM").html(":(");
        $("#informe").html(retorno.responseText);   
    });
    
}
function deslogear()
{   
    var funcionAjax=$.ajax({
        url:"php/deslogearUsuario.php",
        type:"post"     
    });
    funcionAjax.done(function(retorno){
            MostarBotones();
            MostarLogin();
            $("#usuario").val("Sin usuario.");
            $("#BotonLogin").html("Login<br>-Sesión-");
            $("#BotonLogin").removeClass("btn-danger");
            $("#BotonLogin").addClass("btn-primary");
            
    }); 
}*/

function mostrarGrilla(){
    
    $.ajax({
        type:'POST',
        url:pagina,
        dataType:'html',
        data:{queHago:"mostrarGrilla"},
        async: true 
    })
    .done(function (obj){
        alert("hola");
        $("#divGrilla").html(obj);
            
        
    }).fail(function (jqXHR, textStatus, errorThrown){
         console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
    
}


function BorrarVehiculo(idParametro)
{
    //alert(idParametro);
        var funcionAjax=$.ajax({
        url:"./gestion.php",
        type:"post",
        data:{
            queHago:"BorrarVehiculo",
            patente:idParametro  
        }
    });
    funcionAjax.done(function(retorno){
       // Mostrar("MostrarGrilla");
        $("#informe").html("cantidad de eliminados "+ retorno); 
        
    });
    funcionAjax.fail(function(retorno){ 
        $("#informe").html(retorno.responseText);   
    }); 
}

function EditarVehixulo(idParametro)
{
    var funcionAjax=$.ajax({
        url:"./gestion.php",
        type:"post",
        data:{
            queHago:"TraerVehiculo",
            patente:idParametro  
        }
    });
    funcionAjax.done(function(retorno){
        var cd =JSON.parse(retorno);    
        $("#idVehiculo").val(vehiculo.id);
        $("#patente").val(vehiculo.patente);
        $("#tiempo").val(cd.tiempo);
    });
    funcionAjax.fail(function(retorno){ 
        $("#informe").html(retorno.responseText);   
    }); 
    setTimeout(function() {"MostrarFormAlta"}, 5);
    Mostrar("MostrarFormAlta");

    
}

function GuardarVehiculo()
{
        var id=$("#idVehiculo").val();
        var patente=$("#patente").val();
        var tiempo=$("#tiempo").val();

        var funcionAjax=$.ajax({
        url:"nexo.php",
        type:"post",
        data:{ 
            queHago:"GuardarVehiculo", 
            titulo:titulo,                                                             
            anio:anio     
        }
    });
    funcionAjax.done(function(retorno){
            Mostrar("MostrarGrilla");
        $("#informe").html("cantidad de agregados "+ retorno);  
        
    });
    funcionAjax.fail(function(retorno){ 
        $("#informe").html(retorno.responseText);   
    }); 
}

function IngresoDeDatos(num){
    var patente=$("#txtPatente").val();
    var imagen=$("#hdnArchivoTemp").val();  
    if(patenteOk(patente)){
        alert("Patente nula");
        return;
    }
    if(num==0){
        AgregarAuto(patente);
    }
    else{
        SacarAuto();
    }

}

function patenteOk(patente){
    if(patente==""){
        return false;
    }
    return true;
}

function AgregarAuto(patente){
    pagina="./gestion.php";
    queHago="Agregar";
    var array={};
    array["patente"]=patente;
    

    $.ajax({
        type:'POST',
        url:pagina,
        dataType:'json',
        data:{queHago:queHago,
            array: array},
        async: true 
    })
    .done(function (obj){
        console.log(obj);
        if(obj == "OK")
        mostrarGrilla();
        $("#txtPatente").val("");
        $("#divImagen").html("");
        $("#hdnArchivoTemp").val("");
        $("#imagen").val("");
    }).fail(function (jqXHR, textStatus, errorThrown){
         console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}



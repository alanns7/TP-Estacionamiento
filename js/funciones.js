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
    var contra=$('#contra').val();

    var funcionAjax=$.ajax({
        url:pagina,
        type:'POST',
        data:{
            usuario: usuario,
            contra: contra,
            queHago:"mostrarLogin"}
    });
    funcionAjax.done(function(retorno){
       
        if(retorno == "NO-REGISTRADO") {
            alert("Aun quedan campos sin completar");
            return false;
        }else if(usuario == "admin@admin.com" ){
                alert("Usted se ha registrado como admin");

        }else {
            alert("Usted se ha registrado como usuario");

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
        data:{queHago:"mostrarGrilla",
        },
        async: true 
    })
    .done(function (obj){
        
        $("#divGrilla").html(obj);

    }).fail(function (jqXHR, textStatus, errorThrown){
         console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
    
}


function BorrarVehiculo(patente)
{
    //alert(idParametro);

        $.ajax({
        url:"./gestion.php",
        type:'POST',
        dataType:"json",
        data:{
            queHago:"borrarVehiculo",
            patente:patente
        },
        async: true

    }).done(function (objJson){
       
        alert(objJson.Mensaje);
        mostrarGrilla();
    }).fail(function (jqXHR, textStatus, errorThrown){ 
        console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown); 
    }); 
}




function IngresoDeDatos(num){
    var patente=$("#patente").val();
    
    /*if(patenteOk(patente)){

        alert("Patente nula");
        return;
    }*/
    if(num==0){

        AgregarAuto(patente);
    }
    else{
        BorrarVehiculo(patente);
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
    queHago="guardarVehiculo";
    var id=$('#idVehiculo').val();
    var patenteAux=$('#patente').val();
    var usuarioAux=$('#usuario').val();
    

    $.ajax({
        type:'POST',
        url:pagina,
        dataType:'json',
        data:{queHago:queHago,
            id: id,
            patente:patenteAux,
            usuario:usuarioAux
            },
        async: true 
    })
    .done(function (objJson){
       // alert(objJson.Mensaje);
        mostrarGrilla();
        $("#patente").val("");
       
        
    }).fail(function (jqXHR, textStatus, errorThrown){

         console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}



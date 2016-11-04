function testUsuario(){
	
    var pagina = "./gestion.php";
	var usr=$('#usuario').val();
	var contrasenia=$('#contra').val();

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: 'json',
        data: {
            usuario : usr,
            contra: contrasenia,
            queHago: "chequearUsu"
		},
        async: true
    })
.done(function (objJson) {

        alert(objJson);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });     
}

function login(){

var pagina = "./gestion.php";
    var usr=$('#usuario').val();
    var contrasenia=$('#contra').val();

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: 'json',
        data: {
            usuario : usr,
            contra: contrasenia,
            queHago: "login"
        },
        async: true
    })
.done(function (algo) {

        alert(algo + "Llego");
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   




}
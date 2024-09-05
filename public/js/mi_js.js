$(document).ready(function() {

  // Creamos el array con los perfiles que existe para trabajar con nosotros
	var Provincias = [
    {display: "ANDRES IBAÑEZ", value: "ANDRES IBAÑEZ" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "CHIQUITOS", value: "CHIQUITOS" },
    {display: "CORDILLERA", value: "CORDILLERA" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "ANGEL SALDOVAL", value: "ANGEL SANDOVAL" },
    {display: "WARNES", value: "WARNES" }];

	var asesor_de_felicidad = [
		{display: "Asesores de felicidad", value: "Asesores de felicidad" }];


	// Aqui creamos verificamos cual opciones apareceran dependiendo de la seleccion@superservicios

	$("#vacante").change(function() {
		    var parent = $(this).val();
		    switch(parent){
		        case 'Administrativas':
		             list(adminitrativos);
		            break;
		        case 'Asesores_de_felicidad':
		             list(asesor_de_felicidad);
		            break;
		        case 'estudiante_practica':
		        	campo();
		        	break;
		        default: //default child option is blank
		            $("#perfil").html('');
		            break;
		           }
		});
//function to populate child select box
function list(array_list)
{
    $("#perfil").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options
        $("#perfil").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
    });
  $("#aqui").addClass('hidden');
  $(".box--oculto").removeClass('hidden');
}


 function campo(){
   $("#aqui").removeClass('hidden');
   $(".box--oculto").addClass('hidden');
	var hola = '<div class="control_label"><label for="estudiante_de">Estudiante de</label></div><div class="control_input"><input type="text" name="estudiante_de" id="estudiante_de" placeholder="Ejemplo: Técnico en sistemas"></div>';
        $("#aqui").html(hola);

 }


});

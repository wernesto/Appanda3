var campos = 2;

function agregarCampo(){
	campos = campos + 1;
	var NvoCampo= document.createElement("div");
	NvoCampo.id= "divcampo_"+(campos);
	
	$('#tablaDatos tr:last-child').clone().appendTo('#tablaDatos');
	
  }

function quitarCampo()
{
	if($('#tablaDatos tr').length>2)
		$('#tablaDatos tr:last-child').remove();
}


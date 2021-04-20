$(document).ready(function(){




$("body").delegate(".ver","click",function(event){
		event.preventDefault();
		var tipoid = $(this).attr('verid');
		
		
		
						
	})

$("body").delegate(".eliminar","click", function(event){
		event.preventDefault();
		var pid = $(this).attr("eliminarid");
		if(confirm("¿Desea Eliminar el registro: " + pid + "?")){
			$.ajax({
			url : "Controlador/Accion.php",
			method : "POST",
			data : {Eliminar_Rango:1,removeID: pid},
			success : function(data){
							
			},
			complete: function(){
			location.reload();
			}
		})
				

			}
			else{	

			}

})




})
$(document).ready(function(){
	$(".eliminar").click(function(){
		var imagen=$(this).parent('td').parent('tr').find('.imagen').val();
		$(this).parent('td').parent('tr').remove();
		$.post('ejecuta.php',{
			Caso:'Eliminar',
			Id:$(this).attr('data-id'),
			Imagen:imagen
		},function(e){
			alert(e);
		});

	});
	$(".modificar").click(function(){
		var id_rango=$(this).parent('td').parent('tr').find('.id_rango').val();
		var rango_trabajador=$(this).parent('td').parent('tr').find('.rango_trabajador').val();
		var fijo_uf =$(this).parent('td').parent('tr').find('.fijo_uf').val();
		var variableuf_tra=$(this).parent('td').parent('tr').find('.variableuf_tra').val();
		var checklist=$(this).parent('td').parent('tr').find('.checklist').val();
		$.post('ejecuta.php',{
			Caso:'Modificar',
			Id:$(this).attr('data-id'),
		     id_rango:id_rango,
			rango_trabajador:rango_trabajador,
			fijo_uf:fijo_uf,
			variableuf_tra:variableuf_tra,
			checklist:checklist
		},function(e){
			alert(e);

		});

	});

});
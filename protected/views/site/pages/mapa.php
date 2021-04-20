
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuojqC59sKz9CrNOHGyyAXCzxwl_f1NVA"></script>
<link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.min.css">
<script src="js/bootstrap-select/bootstrap-select.min.js"></script> 
<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}

$where = "";	
$where2 = "";
$tipo = "evaluador";

// Lógica para tipos de usuario eess
if(Yii::app()->controller->usertype() == 1){
	$where.=" AND eess_rut = '".Yii::app()->user->id."' ";
}
			
// Lógica para tipos de usuario evaluador
if(Yii::app()->controller->usertype() == 3){
	$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
	$where.=" AND eess_rut = '".$eess."' ";
}

$evaluador = Yii::app()->db->createCommand("SELECT DISTINCT eva_evaluador FROM min_evaluacion WHERE 1 ".$where." AND TRIM(eva_evaluador) != '' AND TRIM(eva_evaluador) IS NOT NULL")->query()->readAll();
for($i=0;$i<count($evaluador);$i++){
	$evaluador[$i]['nombre_evaluador'] = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) as nombre_evaluador FROM min_trabajador WHERE tra_rut = '".$evaluador[$i]['eva_evaluador']."'")->queryScalar();
}
$ano = Yii::app()->db->createCommand("SELECT DISTINCT YEAR(eva_fecha_evaluacion) as ano FROM min_evaluacion WHERE 1 ".$where." ORDER BY YEAR(eva_fecha_evaluacion)")->query()->readAll();
$mes = Yii::app()->db->createCommand("SELECT DISTINCT MONTH(eva_fecha_evaluacion) as mes FROM min_evaluacion WHERE 1 ".$where." ORDER BY MONTH(eva_fecha_evaluacion)")->query()->readAll();

$o_evaluador='';
for($i=0;$i<count($evaluador);$i++){
	$selected = '';
	if(isset($_POST['evaluador'])) if($_POST['evaluador'] == $evaluador[$i]['eva_evaluador']) $selected = 'selected';
	$o_evaluador.= '<option '.$selected.' value="'.$evaluador[$i]['eva_evaluador'].'">'.$evaluador[$i]['nombre_evaluador'].'</option>'; 
}

$o_ano='';
for($i=0;$i<count($ano);$i++){
	$selected = '';
	if(isset($_POST['ano'])) if($_POST['ano'] == $ano[$i]['ano']) $selected = 'selected';
	$o_ano.= '<option '.$selected.' value="'.$ano[$i]['ano'].'">'.$ano[$i]['ano'].'</option>'; 
}
$o_mes='';
for($i=0;$i<count($mes);$i++){
	$selected = '';
	if(isset($_POST['mes'])) if($_POST['mes'] == $mes[$i]['mes']) $selected = 'selected';
	$o_mes.= '<option '.$selected.' value="'.$mes[$i]['mes'].'">'.$mes[$i]['mes'].'</option>'; 
}
?>



    <style>
      #map {
        height: 100%;
        margin-left:-20px;
        margin-right:-20px;
      }
      #mydiv {
    position: absolute;
    top:200px;
    z-index: 9998;
    background-color: #f1f1f1;
    border: 1px solid #d3d3d3;
    text-align: center;
}

#mydivheader {
    padding: 10px;
    cursor: move;
    z-index: 9999;
    background-color: #2196F3;
    color: #fff;
}
    </style>
    
    <div id="map"></div>
    <script>
    	<?php
    	$where_mapa = '';
			
		if(isset($_POST['evaluador'])) if($_POST['evaluador'] != '') $where_mapa.= " AND E.eva_evaluador = '".$_POST['evaluador']."'";
		if(isset($_POST['ano'])) if($_POST['ano'] != '') $where_mapa.= " AND YEAR(eva_fecha_evaluacion) = '".$_POST['ano']."'";
		if(isset($_POST['mes'])) if($_POST['mes'] != '') $where_mapa.= " AND MONTH(eva_fecha_evaluacion) = '".$_POST['mes']."'";
		
		// Lógica para tipos de usuario eess
		$eess;
		if(Yii::app()->controller->usertype() == 1){
			$eess=Yii::app()->user->id;
			$where2.=" AND E.eess_rut = '".Yii::app()->user->id."' ";
		}
		
		// Lógica para tipos de usuario evaluador
		if(Yii::app()->controller->usertype() == 3){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$where2.=" AND E.eess_rut = '".$eess."' ";
		}
		
		$sql = "
		SELECT E.eva_geo_x, E.eva_geo_y, E.eva_id, E.eva_nombres, E.eva_apellidos, E.eva_fecha_evaluacion, E.eess_rut, L.tra_rut, L.tra_color
		FROM min_evaluacion as E
		left join min_trabajador as L on(E.eva_evaluador = L.tra_rut)
		WHERE 1 ".$where_mapa." ".$where2."
		AND E.eva_geo_x != ''
		AND E.eva_geo_y != ''
		";
		$evaluaciones = Yii::app()->db->createCommand($sql)->query()->readAll();
		?>
		var eess=<?php echo $eess; ?>;
		var conteoEvaluaciones=0;
		$(document).ready(function(){
			function initMap(evaluaciones) {
				conteoEvaluaciones=0;
				var markers=[];
				var info=[];
		        var myLatLng = {lat: -37.600, lng: -73.044};
		
		        var map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 8,
		          center: myLatLng
		        });
		        
				var marker, i;
				for(i=0;i<evaluaciones.length;i++){
					var icon=evaluaciones[i]['tra_color'] == undefined ? evaluaciones[i]['tra_color'] : 'ff0000';
					
				  	var marker = new google.maps.Marker({
		              position: new google.maps.LatLng(evaluaciones[i]['eva_geo_x'], evaluaciones[i]['eva_geo_y']),
		              map: map,
		              icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|'+icon,
		              draggable: false
		            });
		            var content='';
		            switch($('#tipoEvaluacion').val()){
		            	case 'trabajador':
		            		content='<div class="map-popup"><h4>Evaluación '+evaluaciones[i]['eva_id']+'</h4><p>'+evaluaciones[i]['eva_nombres']+' '+evaluaciones[i]['eva_apellidos']+'</p><p><a href="index.php?r=evaluacion/view&id='+evaluaciones[i]['eva_id']+'" target="_blank">Ir a la evaluación</a></p></div>';
		            		break;
		            	case 'equipo':
		            		content='<div class="map-popup"><h4>Evaluación '+evaluaciones[i]['eva_id']+'</h4><p>'+evaluaciones[i]['eq_codigo']+' '+evaluaciones[i]['eq_maquina']+'</p><p><a href="index.php?r=evaEquipos/view&id='+evaluaciones[i]['eva_id']+'" target="_blank">Ir a la evaluación</a></p></div>';
		            		break;
		            	case 'instalacion':
		            		content='<div class="map-popup"><h4>Evaluación '+evaluaciones[i]['eva_id']+'</h4><p>'+evaluaciones[i]['eva_faena']+' </p><p><a href="index.php?r=evalInstalaciones/view&id='+evaluaciones[i]['eva_id']+'" target="_blank">Ir a la evaluación</a></p></div>';
		            		break;
		            	
		            }
			        var infowindow = new google.maps.InfoWindow({content: content,
                    });
		            google.maps.event.addListener(marker, 'click', (function(marker,infowindow){ 
				        return function() {
				           infowindow.open(map,marker);
				        };
				    })(marker,infowindow));
					conteoEvaluaciones++;
				}
				
		        // FIN DE MARCADORES
		      }
		      
			  var data=ajaxCall({'tipoEvaluacion':$('#tipoEvaluacion').val()
			  						,'eess':eess
			  						,'lista2Val':$('#lista2').val()
	            					,'lista3Val':$('#lista3').val()
	            					,'lista4Val':$('#lista4').val()}
			  					,"ajax/mapa.php");
		      /*initMap(data[0].lista1);
		      cargarSelect(data[0].lista2,$('#lista2'));
		      cargarSelect(data[0].lista3,$('#lista3'));
		      cargarSelect(data[0].lista4,$('#lista4'));*/
		      
		      
		      //función para cargar dinámicamente select
		      function cargarSelect(data, select) {

		        select.html("");
		        var optTodos = document.createElement("option");
		        optTodos.textContent = "[Todos]";
		        optTodos.value = 0;
		        select[0].appendChild(optTodos);
		
		        data.forEach(function (item, index) {
		            var element = document.createElement("option");
		            element.textContent = item.nombre;
		            element.value = item.valor;
		            select[0].appendChild(element);
		        });
		
		      }
		      
		      //función para cargar datos a div flotante
		      function cargarCajaFlotante(data){
		      	$( "#bodyFloat" ).html("");
		      	if(data.length==0){
		      		$( "#bodyFloat" ).append( '<p>No hay resultados</p>');
		      		conteoEvaluaciones=0;
		      		$( "#mydivheader" ).html("Número de evaluaciones: "+conteoEvaluaciones);
		      	}else{
		      		$( "#mydivheader" ).html("Número de evaluaciones: "+conteoEvaluaciones);
		      		var tabla='<table class="table table-hover">';
		      		tabla+='<thead>';
		      		tabla+='<tr>';
		      		tabla+='<th> '+($('#tipoEvaluacion').val()!== 'trabajador'?'Código ':'Nombre') +$('#tipoEvaluacion').val()+'</th>';
		      		tabla+='<th>Cantidad</th>';
		      		tabla+='</tr>';
		      		tabla+='</thead>';
		      		tabla+='<tbody>';
		      		for(i=0;i<data.length;i++){
		      			tabla+='<tr>';		
		      			tabla+='<td >'+data[i].nombre+'</td>';
		      			tabla+='<td>'+data[i].cantidad+'</td>';		      		
			      		tabla+='</tr>';
			      	}
			      	tabla+='</tbody>';
			      	tabla+='</table>';
			      	$( "#bodyFloat" ).append(tabla);
		      	}
		      	
		      }
		      
		      $(document).on('change', '.select', function () {
		      	
	            var id = $("option:selected", this).val();

	            var data=ajaxCall({'tipoEvaluacion':$('#tipoEvaluacion').val()
	            					,'eess':eess
	            					,'lista2Val':$('#lista2').val()
	            					,'lista3Val':$('#lista3').val()
	            					,'lista4Val':$('#lista4').val()}
	            				,"ajax/mapa.php");
				/*initMap(data[0].lista1);
				cargarSelect(data[0].lista2,$('#lista2'));
		      	cargarSelect(data[0].lista3,$('#lista3'));
		      	cargarSelect(data[0].lista4,$('#lista4'));*/
		            
		      });
		      
		      
		      
		      //AJAXCALL
			 function ajaxCall(data, url) {
		        //var returnData;
		        console.log(data);
		        $.ajax({
		            //beforeSend: function () { $('#loader').show(); },
		            //complete: function () { $('#loader').hide(); },
		            type: "POST",
		            url: url,
		            data: data,
		            async: true,
		            dataType: 'json',
		            success: function (res) {
		                //var data = JSON.parse(res.d);
		                //console.log(res);
		                initMap(res[0].lista1);
		                if($('#lista2').val()==0){
		                	cargarSelect(res[0].lista2,$('#lista2'));
		                }
	                 	if($('#lista3').val()==0){
		                	cargarSelect(res[0].lista3,$('#lista3'));
		                }
	                 	if($('#lista4').val()==0){
		                	cargarSelect(res[0].lista4,$('#lista4'));
		                }
						
				      	cargarCajaFlotante(res[0].lista5);
		                //returnData = res;
		                
		            },
		            error: function (jqXHR, textStatus, errorThrown) {
		                errorFunction(jqXHR, textStatus, errorThrown);
		
		            }
		
		        });
		        //return returnData;
		    }
		    
		    
			
			  function errorFunction(jqXHR, textStatus, errorThrown) {
			    if (jqXHR.status === 0) {
			
			        alert('Not connect: Verify Network.');
			
			    } else if (jqXHR.status == 404) {
			
			        alert('Requested page not found [404]');
			
			    } else if (jqXHR.status == 500) {
			        console.log(jqXHR);
			        console.log(textStatus);
			        console.log(errorThrown);
			
			        alert('Internal Server Error [500].');
			
			    } else if (textStatus === 'parsererror') {
			
			        alert('Requested JSON parse failed.');
			        console.log(errorThrown);
			        console.log(textStatus);
			        console.log(jqXHR);
			
			    } else if (textStatus === 'timeout') {
			
			        alert('Time out error.');
			
			    } else if (textStatus === 'abort') {
			
			        alert('Ajax request aborted.');
			
			    } else {
			
			        alert('Uncaught Error: ' + jqXHR.responseText);
			
			    }
			}
			
			//Make the DIV element draggagle:
			dragElement(document.getElementById(("mydiv")));
			
			function dragElement(elmnt) {
			  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
			  if (document.getElementById(elmnt.id + "header")) {
			    /* if present, the header is where you move the DIV from:*/
			    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
			  } else {
			    /* otherwise, move the DIV from anywhere inside the DIV:*/
			    elmnt.onmousedown = dragMouseDown;
			  }
			
			  function dragMouseDown(e) {
			    e = e || window.event;
			    // get the mouse cursor position at startup:
			    pos3 = e.clientX;
			    pos4 = e.clientY;
			    document.onmouseup = closeDragElement;
			    // call a function whenever the cursor moves:
			    document.onmousemove = elementDrag;
			  }
			
			  function elementDrag(e) {
			    e = e || window.event;
			    // calculate the new cursor position:
			    pos1 = pos3 - e.clientX;
			    pos2 = pos4 - e.clientY;
			    pos3 = e.clientX;
			    pos4 = e.clientY;
			    // set the element's new position:
			    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
			    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
			  }
			
			  function closeDragElement() {
			    /* stop moving when mouse button is released:*/
			    document.onmouseup = null;
			    document.onmousemove = null;
			  }
			}
		});
		
      
    </script>
    <form  method="post" style="position:absolute; z-index:1000; top:9px; left:130px;width: auto;">
    	<div class="row">
    		<div class="col-sm-3">
	    		<select  name="tipoEvaluacion" id="tipoEvaluacion"  class="form-control  input-sm select"  >
					<option value="trabajador" selected>Trabajadores</option>     
					<option value="equipo" >Equipos</option>  
					<option value="instalacion">Instalaciones</option>  		
				</select> 
			</div>
			<div class="col-sm-4">
	    		<select  name="lista2" id="lista2"  class="form-control  input-sm select"  >	
	    			<option value="0" selected>[Todos]</option>  	
				</select> 
			</div>
			<div class="col-sm-2">
	    		<select  name="lista3" id="lista3"  class="form-control  input-sm select"  > 
	    			<option value="0" selected>[Todos]</option> 		
				</select> 
			</div>
			<div class="col-sm-2">
	    		<select  name="lista4" id="lista4"  class="form-control  input-sm select"  >
	    			<option value="0" selected>[Todos]</option> 		
				</select> 
			</div>
		</div>
		<!--Draggable DIV:-->
		<div id="mydiv">
		  <!--Include a header DIV with the same name as the draggable DIV, followed by "header":-->
		  <div id="mydivheader">Número de evaluaciones</div>
		  <div id="bodyFloat"style="margin-top:20px;padding: 10px;height: 200px;overflow-y: auto;">
		  	<p>No hay resultados</p>
		  	
		  </div>

		</div>
    </form>
    
		
    		


	   
    
    


<?php

if ($tipo == "evaluador2"){
echo'<div class="col-sm-3">
		<select name="evaluador" onchange="this.parentNode.submit();" class="form-control input-sm " style="width:120px;">
			<option value="">[Evaluador]</option>
			'.$o_evaluador.'
		</select>	</div>
	';
	
echo'<div class="col-sm-3">
		<select name="ano" onchange="this.parentNode.submit();" class="form-control input-sm " style="width:70px;">
			<option value="">[Año]</option>
			'.$o_ano.'
		</select>	</div>
	<div class="col-sm-3">
		<select name="mes" onchange="this.parentNode.submit();" class="form-control input-sm " style="width:70px;">
			<option value="">[Mes]</option>
			'.$o_mes.'
		</select>	</div>
		</div>	';
}

?>
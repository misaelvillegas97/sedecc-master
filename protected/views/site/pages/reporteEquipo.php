<?php
header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<style type="text/css">
 li: a: span{
      color:red;
    }
      .exportRanking{
    	margin-right:30px;
    }
</style>
<?php
$where_evaluacion = "";
$where_evaluacion_2 = "";

if(isset($_POST['filtro_tipo']) && $_POST['filtro_tipo'] !== ''){
	$where_evaluacion.= " AND e.eva_tipo = '".$_POST['filtro_tipo']."' ";
}


// Cuando el tipo de usuario es empresa
if(Yii::app()->controller->usertype() == 1){
	
	if(!isset($_POST['filtro_eess'])){
		$_POST['filtro_eess'] = Yii::app()->user->id;
	}
	
	if(!isset($_POST['filtro_tipo'])){
		$_POST['filtro_tipo'] = '';
	}
	
	
	$where_evaluacion.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";
	$where_evaluacion_2.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";
	/*if($_POST['filtro_eess'] != ""){
		$where_evaluacion.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";		
	}*/

}
// Cuando el tipo de usuario es evaluador
if(Yii::app()->controller->usertype() == 3){
	$eess = Yii::app()->db->createCommand("SELECT DISTINCT(eess_rut) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
	//AGREGADO DISTINCT JORGE IRAIRA
	$_POST['filtro_eess'] = $eess;
	if($_POST['filtro_eess'] != "") $where_evaluacion.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";
}

$where_evaluacion.= "";
if(isset($_POST['filtro_codigo'])){
	
	//if($_POST['filtro_area'] != "") $where_evaluacion.= " AND UPPER(e.car_servicio) = UPPER('".$_POST['filtro_area']."') ";
	if($_POST['filtro_codigo'] != "") $where_evaluacion.= " AND (e.eq_codigo= '".$_POST['filtro_codigo']."' OR e.eva_patente= '".$_POST['filtro_codigo']."')";
	//if($_POST['filtro_nombre'] != "") $where_evaluacion.= " AND e.eq_maquina = '".$_POST['filtro_nombre']."' ";
	//if($_POST['filtro_fundo'] != "") $where_evaluacion.= " AND e.eva_fundo = '".$_POST['filtro_fundo']."' ";
	//if($_POST['filtro_faena'] != "") $where_evaluacion.= " AND e.eva_faena = '".$_POST['filtro_faena']."' ";
	//if($_POST['filtro_desde'] != "") $where_evaluacion.= " AND e.eva_fecha_evaluacion > '".$_POST['filtro_desde']." 00:00:00'";
	//if($_POST['filtro_hasta'] != "") $where_evaluacion.= " AND e.eva_fecha_evaluacion < '".$_POST['filtro_desde']." 23:59:59'";
}
//echo "SELECT * FROM min_equipos e WHERE 1 ".$where_evaluacion."  ORDER BY eq_maquina";
?>
<script type="text/javascript" src="js/amcharts/amcharts.js"></script>
  <script type="text/javascript" src="js/amcharts/dataloader.js"></script>
  <script type="text/javascript" src="js/amcharts/serial.js"></script>
  <script type="text/javascript" src="js/amcharts/gauge.js"></script>
  <script type="text/javascript" src="js/amcharts/pie.js"></script>
<!-- Chart code -->
<link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.min.css">
<script src="js/bootstrap-select/bootstrap-select.min.js"></script> 
<link href="https://www.amcharts.com/lib/3/plugins/export/export.css" media="all" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://www.amcharts.com/lib/3/plugins/export/export.js"></script>

<h2 class="page-header">Reporte de Equipos</h2>
<h3>Ranking por Máquina</h3>
<!--FILTROS-->
<form method="post">
<div class="row">

	<?php 
		if(Yii::app()->controller->usertype() == 2){			
	?>
	<div class="col-sm-3">
		<small>Empresa</small>
	<select  name="filtro_empresa" onchange="this.form.submit();" class="form-control selectpicker " data-live-search="true" >
	<option value="">Seleccione una Empresa</option>
	<?php  

	$rows = Yii::app()->db->createCommand("SELECT * FROM min_eess WHERE eess_estado = 1 ORDER BY eess_nombre_corto ASC")->query()->readAll();
	for($i=0;$i<count($rows);$i++){
		$selected = "";
		if(isset($_POST['filtro_eess']))
				if($_POST['filtro_eess'] == $rows[$i]['eess_rut']) 
					$selected = "selected";
		echo '<option '.$selected.' value="'.$rows[$i]['eess_rut'].'">'.$rows[$i]['eess_nombre_corto'].'</option>';
	}

    ?>
             
		
	</select>
	</div>
	<?php 
		}			
	?>
	<div class="col-sm-4">
		<small>Actividad</small>
		<select name="filtro_tipo" class="form-control selectpicker " data-live-search="true" onchange="this.form.submit();">
			<?php
			if(Yii::app()->controller->usertype() == 1){
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_tipo FROM min_evaluacion_equipos e WHERE eess_rut = '".Yii::app()->user->id."' ")->query()->readAll();
				$rut_eess = Yii::app()->user->id;
			}
			
			else if(Yii::app()->controller->usertype() == 3){
				$eess = Yii::app()->db->createCommand("SELECT DISTINCT(eess_rut) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
				$rows = Yii::app()->db->createCommand("SELECT DISTINCT(eva_tipo) FROM min_evaluacion_equipos e WHERE eess_rut = '".$eess."' ")->query()->readAll();
				$rut_eess = $eess;
			/**	comentado jorge iraira 06/12/2017
			AGREGADO DISTINCT

			**/
			}
			else{
				$rows = Yii::app()->db->createCommand("SELECT DISTINCT(eva_tipo) FROM min_evaluacion e WHERE 1 ")->query()->readAll();
			}
			echo '<option value="">[Todas]</option>';
			for($i=0;$i<count($rows);$i++){
				$selected = "";
				if(isset($_POST['filtro_tipo'])) if($_POST['filtro_tipo'] == $rows[$i]['eva_tipo']) $selected = "selected";
				echo '<option '.$selected.' value="'.$rows[$i]['eva_tipo'].'">'.$rows[$i]['eva_tipo'].'</option>';
			}
			?>
		</select>
	</div>
	
	<div class="col-sm-2">
		<small>Código de Máquina</small>
		<!--<input name="filtro_codigo" type="text" class="form-control input-sm" placeholder="Buscar por código" value="">-->
		<select  name="filtro_codigo" onchange="this.form.submit();" class="form-control selectpicker " data-live-search="true" >
			<option value="">[Todas]</option>
				<?php  
				
				$rows = Yii::app()->db->createCommand("SELECT eq_codigo as eq_codigo FROM min_equipos e WHERE 1 ".$where_evaluacion_2." 
														union
														SELECT eva_patente as eq_codigo FROM min_evaluacion_equipos e WHERE 1 ".$where_evaluacion_2."")->query()->readAll();
				for($i=0;$i<count($rows);$i++){
					if($rows[$i]['eq_codigo'] !==''){
						$selected = "";
						if(isset($_POST['filtro_codigo']))
								if($_POST['filtro_codigo'] == $rows[$i]['eq_codigo']) 
									$selected = "selected";
						echo '<option '.$selected.' value="'.$rows[$i]['eq_codigo'].'">'.$rows[$i]['eq_codigo'].'</option>';
						}
					
				}
			
			    ?>		             				
		</select>
	</div>
	<!--<div class="col-sm-2">
		<small>Nombre Máquina</small>
		<input name="filtro_nombre" type="text" class="form-control input-sm" placeholder="Buscar por nombre" value="">
	</div>-->
	<?php /*
	<!--div class="col-sm-2">
		<small>Fundo</small>
		<select name="filtro_fundo" class="form-control input-sm">
			<?php

			if(Yii::app()->controller->usertype() == 1){
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_fundo FROM min_evaluacion e WHERE eess_rut = '".Yii::app()->user->id."' ".$where_evaluacion."")->query()->readAll();
			}
			else if(Yii::app()->controller->usertype() == 3){
				$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_fundo FROM min_evaluacion e WHERE eess_rut = '".$eess."' ".$where_evaluacion."")->query()->readAll();
			}
			else{
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_fundo FROM min_evaluacion e WHERE 1 ".$where_evaluacion."")->query()->readAll();
				echo '<option value="">[Todos los fundos]</option>';
			}
			for($i=0;$i<count($rows);$i++){
				$selected = "";
				if(isset($_POST['filtro_fundo'])) if($_POST['filtro_fundo'] == $rows[$i]['eva_fundo']) $selected = "selected";
				echo '<option '.$selected.' value="'.$rows[$i]['eva_fundo'].'">'.$rows[$i]['eva_fundo'].'</option>';
			}
			?>
		</select>
	</div-->
	<!--div class="col-sm-2">
		<small>Faena</small>
		<select name="filtro_faena" class="form-control input-sm">
			<?php
			if(Yii::app()->controller->usertype() == 1){
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_faena FROM min_evaluacion e WHERE eess_rut = '".Yii::app()->user->id."' ".$where_evaluacion."")->query()->readAll();
			}
			else if(Yii::app()->controller->usertype() == 3){
				$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_faena FROM min_evaluacion e WHERE eess_rut = '".$eess."' ".$where_evaluacion."")->query()->readAll();
			}
			else{
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_faena FROM min_evaluacion e WHERE 1 ".$where_evaluacion."")->query()->readAll();
				echo '<option value="">[Todas las faenas]</option>';
			}
			for($i=0;$i<count($rows);$i++){
				$selected = "";
				if(isset($_POST['filtro_faena'])) if($_POST['filtro_faena'] == $rows[$i]['eva_faena']) $selected = "selected";
				echo '<option '.$selected.' value="'.$rows[$i]['eva_faena'].'">'.$rows[$i]['eva_faena'].'</option>';
			}
			?>
		</select>
	</div-->
	<!--div class="col-sm-2">
		<small>Desde</small>
		<input name="filtro_desde" type="date" class="form-control input-sm" value="<?php if(isset($_POST['filtro_desde'])) echo $_POST['filtro_desde'];?>">
	</div-->
	<!--div class="col-sm-2">
		<small>Hasta</small>
		<input name="filtro_hasta" type="date" class="form-control input-sm" value="<?php if(isset($_POST['filtro_hasta'])) echo $_POST['filtro_hasta'];?>">
	</div-->
	*/ ?>
	<div class="col-sm-2" id="contenedor_submit" style="display:none;">
		<input type="submit" class="btn btn-primary btn-block btn-sm" style="margin-top:20px;" value="Generar reporte">
	</div>

</div>

</form>
<script>
			$('#ulReporte').show();
$('.liReportes').addClass('active');
</script>

<?php 
	if(Yii::app()->controller->usertype() == 2){
		if(!isset($_POST['filtro_tipo'])) return; 
	}
?>

<hr>

<?php
$tematicas = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta_equipos as r JOIN min_evaluacion_equipos as e ON(r.eva_id = e.eva_id) WHERE e.eess_rut = '$rut_eess'")->query()->readAll();
?>

<!-- SEGUNDO REPORTE -->
<?php
//echo "SELECT *, UPPER(CONCAT(eq_codigo)) as completo, AVG(eva_cache_porcentaje) AS promedio, '#000000' as color,count(e.eva_id) as countEvaluaciones FROM min_evaluacion_equipos e WHERE 1 ".$where_evaluacion." GROUP BY eq_codigo ORDER BY AVG(eva_cache_porcentaje)";
$rows2 = Yii::app()->db->createCommand("SELECT *, UPPER(CONCAT(eq_codigo)) as completo, AVG(eva_cache_porcentaje) AS promedio, '#000000' as color,count(e.eva_id) as countEvaluaciones FROM min_evaluacion_equipos e WHERE 1 ".$where_evaluacion." GROUP BY eq_codigo, eva_patente ORDER BY AVG(eva_cache_porcentaje)")->queryAll();
if(count($rows2)==0){
	echo '<div class="alert alert-warning">Sin información</div>';
	return;
}
?>
<div class="row" style="margin-bottom:30px;">
	<div class="col-sm-9">
		<script >
			$(document).ready(function(){
				var chart1 = AmCharts.makeChart("chartdiv023", {
			    "type": "serial",
			    "precision":1,
			    "theme": "light",
			    "marginRight": 50,
			    "titles": [
					{
						"id": "Title-1",
						"size": 11,
						"text": "RANKING POR MÁQUINA"
					},
					/*
					{
						"id": "Title-2",
						"text": "COSECHA Y RALEO"
					}*/
					],
			  "dataProvider": <?php
			  $torta['#e14d57'] = 0; //rojo
			  $torta['#f7e523'] = 0; //amarillo
			  $torta['#4fbd5b'] = 0; //verde

			  $limit1 = Yii::app()->params['riesgoalto'];
	          $limit2 = Yii::app()->params['riesgomedio'];

			  for($i=0;$i<count($rows2);$i++){
			  	//$rows2[$i]['color'] = '#e14d57';
			  	$prom = floor($rows2[$i]['promedio']);
			  	if($prom>=0 && $prom<=$limit1) $rows2[$i]['color'] = '#e14d57';
	          if($prom>$limit1 && $prom<=$limit2) $rows2[$i]['color'] = '#f7e523';
	          if($prom>$limit2 && $prom<=100)  $rows2[$i]['color'] = '#4fbd5b';
			  	$torta[$rows2[$i]['color']]++;
			  
			  if($rows2[$i]['completo'] == ''){
			  	$rows2[$i]['completo']=$rows2[$i]['eva_patente'];
			  }
			  }


			  echo json_encode($rows2);
			  ?>,
			  "valueAxes": [{
			    "axisAlpha": 0,
			    "position": "left",
			    "title": "% Cumplimiento",
			    "minimum":0,
				"maximum":100,
				"strictMinMax": true,
				"autoGridCount": false,
			    "gridCount": 5,
			  },
			  ],
			  "startDuration": 1,
			  "graphs": [{
			    "balloonText": "<b>Nota Promedio: [[value]] <br> Cantidad Evaluaciones: [[countEvaluaciones]] ",
			    "fillColorsField": "color",
			    "fillAlphas": 0.9,
			    "lineAlpha": 0.2,
			    "type": "column",
			    "valueField": "promedio",
			    "colorField": "color",
			    "autoColor": true,
			    //"fixedColumnWidth": <?php if(count($rows2) > 30) echo '5'; else echo '20'; ?>,
			  },
			  ],
			  "chartCursor": {
			    "categoryBalloonEnabled": false,
			    "cursorAlpha": 0,
			    "zoomable": false
			  },
			  "categoryField": "completo",
			  "categoryAxis": {
			    "gridPosition": "start",
			    "labelRotation": 45,
			    "minHorizontalGap":1,
			    "fontSize": 8,
			  },
			  "export": {
						"enabled": true,
						"divId": "exportdiv2",
						"menu": [{
							"id": "export-main1",
							"class": "export-main exportRanking",
							"menu":[
								{
							        title: "Exportar imagen",
							        label: "Exportar imagen",
							        format: "png"
							    }, {
							        title: "Exportar datos",
							        label: "Exportar datos"
							    },
							]
						}]
					},
		   });
			});
			
		</script>
		<div id="exportdiv2"></div>
		<div id="chartdiv023" style="background:#ffffff; height:400px; border:1px solid #dddddd;"></div>

	</div>

	<div class="col-sm-3">
		<script>
		$(document).ready(function(){
			var chart2 = AmCharts.makeChart( "tortatrabajador", {
			  "type": "pie",
			  "theme": "none",
			  "labelsEnabled": true,
			  "labelRadius": -30,
			  "outlineAlpha": 0.4,
			  "startDuration": 0.5,
			  "startEffect": "easeOutSine",
	  		  //"labelText": "[[value]]<br>[[percents]] %",
			  "labelText": "[[value]]",
			  "balloonText": "[[title]]: [[value]]<br>([[percents]]%)",
	  		  "fontSize": 9,
			  "percentFormatter": { //Convertir a 1 decimal
	            "precision": 1,
	            "decimalSeparator": ",",
	            "thousandsSeparator": ""
	          },
			  "legend":{
			  	"enabled": true,
			   	"position":"bottom",
			    "fontSize": 8,
			    "align": "center",
				"autoMargins": false,
				"valueWidth": 4,
				"spacing": 2,
				"equalWidths": true,
				"marginBottom": 10,
				"valueText": "",
			  },
			  "dataProvider": [
			  {
			    "respuesta": "Bajo",
			    "cantidad": <?php echo $torta['#4fbd5b'];?>,
			    "color": "#4fbd5b",
			  },
			  {
			    "respuesta": "Alto",
			    "cantidad": <?php echo $torta['#e14d57'];?>,
			    "color": "#e14d57",
			  },
			  {
			    "respuesta": "Medio",
			    "cantidad": <?php echo $torta['#f7e523'];?>,
			    "color": "#f7e523",
			  },
	
			  ],
			  "titles": [
			  {
				"text": " MÁQUINAS EVALUADAS\nPOR NIVEL DE RIESGO\n"+<?php echo count($rows2)?>+"",
				"size": 11
			  },
			  ],
			  "valueField": "cantidad",
			  "colorField": "color",
			  "titleField": "respuesta",
			  "balloon":{
			    "fixedPosition":true
			  },
			  "export": {
					"enabled": true,
					"menu": [{
						"class": "export-main",
						"menu":[
							{
						        title: "Exportar imagen",
						        label: "Exportar imagen",
						        format: "png"
						    }, {
						        title: "Exportar datos",
						        label: "Exportar datos",
						        format: "xlsx"
						    },
						]
					}]
			  },
			});
		});
		
		</script>
		<div id="tortatrabajador" style="height:400px; background:#ffffff; padding:10px; border: 1px solid #DDDDDD;"></div>
	</div>
</div>

<?php 

   extract($_GET);
    include("conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');

    $k = 0;
  	$sql1 = "SELECT DISTINCT tem_id FROM min_respuesta_equipos as r JOIN min_evaluacion_equipos as e ON(r.eva_id = e.eva_id) WHERE 1 $where_evaluacion";
    $result1 = mysqli_query($mysqli, $sql1)or die (mysqli_error());  
    while($fila1 = $result1 ->fetch_assoc()){

 ?>

<div class="row" style="margin-bottom:30px;">
	<div class="col-sm-9">
		<script >
			$(document).ready(function(){
				var chart3<?php echo $k;?> = AmCharts.makeChart("item<?php echo $k;?>", {
					"type": "serial",
					"theme": "light",
					"categoryField": "pregunta",
					"rotate": true,
					"percentPrecision": 0,
					"marginRight": 50,
					"categoryAxis": {
						"gridPosition": "start",
						"position": "left",
						"ignoreAxisWidth": true,
						"autoWrap": true,
						"fontSize": 8,
					},
					"marginLeft": 200,
					"trendLines": [],
					"graphs": [
					{
						"balloonText": "Cumple: [[percents]]%",
						"fillAlphas": 1,
						"fillColors": "#4fbd5b",
						"id": "AmGraph-1",
						"lineAlpha": 0,
						"title": "Cumple",
						"type": "column",
						"valueField": "si",
						//"fixedColumnWidth": 20,
						"color": "#000000",
						"labelText": "[[percents]] %",
					},
					{
						"balloonText": "No Cumple: [[percents]]% ",
						"fillAlphas": 1,
						"fillColors": "#e14d57",
						"id": "AmGraph-2",
						"lineAlpha": 0,
						"title": "No Cumple",
						"type": "column",
						"valueField": "no",
						//"fixedColumnWidth": 20,
						"color": "#000000",
						"labelText": "[[percents]] %",
					},
					{
						"balloonText": "No Aplica: [[percents]]%",
						"fillAlphas": 1,
						"fillColors": "#eeecee",
						"id": "AmGraph-3",
						"lineAlpha": 0,
						"title": "No Aplica",
						"type": "column",
						"valueField": "na",
						//"fixedColumnWidth": 20,
						"color": "#000000",
						"labelText": "[[percents]] %",
					},
					],
					"guides": [],
					"valueAxes": [
					{
						"id": "ValueAxis-1",
						"stackType": "100%",
						"position": "top",
						"align": "center",
						"axisAlpha": 0,
	
					}
					],
					/*
					"balloon": {
						"enabled":true,
						"fixedPosition": true,
					},
					"chartCursor": {
						"cursorAlpha": 0,
						"oneBalloonOnly": true,
						"categoryBalloonEnabled": true,
					},*/
					"titles": [
					{
						"text": "Item: <?php echo str_replace("<br>", " ", $fila1['tem_id']);?>",
						"size": 11
					},],
			  		"legend":{
					  	"enabled": true,
					   	"position":"bottom",
					    "fontSize": 8,
					    "align": "center",
						"autoMargins": false,
						"valueWidth": 15,
						"spacing": 10,
						"equalWidths": true,
						"marginBottom": 10,
					},
					"dataProvider": [
					<?php
						$sql2 = "SELECT r.res_enunciado, SUM(IF(r.res_respuesta = 'si',1,0)) AS S, SUM(IF(r.res_respuesta = 'no',1,0)) AS N, SUM(IF(r.res_respuesta = 'n/a',1,0)) AS NA
								FROM min_evaluacion_equipos as e 
								JOIN min_respuesta_equipos as r ON(e.eva_id = r.eva_id)
								WHERE 1 $where_evaluacion AND tem_id = '".$fila1['tem_id']."'
								GROUP BY res_enunciado";
					    $result2 = mysqli_query($mysqli, $sql2)or die (mysqli_error());  
					    while($fila2 = $result2 ->fetch_assoc()){
						echo '
						{
							"pregunta": "'.str_replace('"', '', $fila2['res_enunciado']).'",
							"item": "'.str_replace('"', '', $fila1['tem_id']).'",
							"si": '.$fila2['S'].',
							"no": '.$fila2['N'].',
							"na": '.$fila2['NA'].',
	
						},';
						}
					?>
					],
					"export": {
						"enabled": true,
						"menu": [{
							"class": "export-main",
							"menu":[
								{
							        title: "Exportar imagen",
							        label: "Exportar imagen",
							        format: "png"
							    }, {
							        title: "Exportar datos",
							        label: "Exportar datos",
							        format: "xlsx"
							    },
							]
						}]
					},
				});
			});
			
		</script>
		<?php
		if($fila1['tem_id'] == '') $alto = 700; else $alto = 100+($fila2['res_enunciado']*50);
		//if($tematicas[$k]['tem_id'] == '') $alto = 700; else $alto = 100+($rowss[0]['ss']*50);
		//echo $rowss[0]['ss']*100;
		?>
		<div id="item<?php echo $k;?>"  style="min-height: 377px; height:<?php echo $alto;?>px; background:#ffffff; padding:10px; border: 1px solid #DDDDDD;"></div>
	</div>

	<!-- segundo grafico -->
	<div class="col-sm-3">
		<script>
		$(document).ready(function(){
			var chart4 = AmCharts.makeChart( "torta<?php echo $k;?>", {
			  "type": "pie",
			  "theme": "none",
			  "labelsEnabled": true,
			  "labelRadius": -30,
			  "outlineAlpha": 0.4,
			  "startDuration": 0.5,
			  "startEffect": "easeOutSine",
	  		  //"labelText": "[[value]]<br>[[percents]] %",
			  "labelText": "[[percents]] %",
			  "balloonText": "[[title]]: ([[percents]]%)",
	  		  "fontSize": 9,
			  "percentFormatter": { //Convertir a 1 decimal
	            "precision": 1,
	            "decimalSeparator": ",",
	            "thousandsSeparator": ""
	          },
	          "legend":{
				"enabled": true,
				"position":"bottom",
				"fontSize": 8,
				"align": "center",
				"autoMargins": false,
				"valueWidth": 7,
				"spacing": 2,
				"equalWidths": true,
				"marginBottom": 10,
				"valueText": ""
			  },
			  
			  "dataProvider": [
			  <?php 
			  	$sql3 = "SELECT SUM(IF(r.res_respuesta = 'si',1,0)) AS S, SUM(IF(r.res_respuesta = 'no',1,0)) AS N, SUM(IF(r.res_respuesta = 'n/a',1,0)) AS NA
								FROM min_evaluacion_equipos as e 
								JOIN min_respuesta_equipos as r ON(e.eva_id = r.eva_id)
								WHERE 1 $where_evaluacion AND tem_id = '".$fila1['tem_id']."'";
				$result3 = mysqli_query($mysqli, $sql3)or die (mysqli_error());  
				$fila3 = $result3 ->fetch_assoc();
			   ?>
				  {
				    "respuesta": "Cumple",
				    "cantidad": <?php echo $fila3['S'];?>,
				    "color": "#4fbd5b",
				  },
				  {
				    "respuesta": "No Cumple",
				    "cantidad": <?php echo $fila3['N'];?>,
				    "color": "#e14d57",
				  },
				  {
				    "respuesta": "No Aplica",
				    "cantidad": <?php echo $fila3['NA'];?>,
				    "color": "#eeecee",
				  }
	
			  ],
			  "titles": [
			  {
				"text": "PORCENTAJE CUMPLIMIENTO",
				"size": 9,
			  },
			  {
				"text": "ITEM: <?php echo str_replace("<br>", " ", $fila1['tem_id']);?>",
				"size": 9,
				"bold": true
			  },
			  {
				"text": "<?php if ($fila3['N'] == 0 and $fila3['S'] == 0) { echo 0; }else{ echo (100-round(100*($fila3['N']/$fila3['S'])));}?> %",
				"size": 14,
			  },
			  ],
			  "valueField": "cantidad",
			  "colorField": "color",
			  "titleField": "respuesta",
			  "balloon":{
			    "fixedPosition":true
			  },
			  "export": {
					"enabled": true,
					"menu": [{
						"class": "export-main",
						"menu":[
							{
						        title: "Exportar imagen",
						        label: "Exportar imagen",
						        format: "png"
						    }, {
						        title: "Exportar datos",
						        label: "Exportar datos",
						        format: "xlsx"
						    },
						]
					}]
			  },
			});
		});
		
		</script>
		<div id="torta<?php echo $k;?>" style="min-height: 377px; height:<?php echo $alto; ?>px; background:#ffffff; padding:10px; border: 1px solid #DDDDDD;"></div>
	</div>
</div>
<?php
$k++;
}
?>

<!--
<form method="post" action="index.php?r=site/page&view=reporte2">
	<input name="filtro_eess" type="hidden" value="<?php //echo $_POST['filtro_eess'];?>">
	<input name="filtro_tipo" type="hidden" value="<?php //echo $_POST['filtro_tipo']; ?>">
	<input name="filtro_trabajador" type="hidden" value="">
	<input class="btn btn-danger btn-block" type="submit" value="Ver detalle de evaluaciones">
</form>
-->
<hr>


<script type="text/javascript">

function modificarexportar(){
	var x = document.getElementsByClassName("export-main");
	var c = x.length;
	var it = chart317.dataProvider[0].item;
for(i=0;i<c;i++){

	x[i].getElementsByTagName('ul')[0].getElementsByTagName('li')[1].innerHTML = "<li><?php echo "<a href='excel/exportarExcel.php?EESS=".$_POST['filtro_eess']."&tipo=".$_POST['filtro_tipo']."&item=\"+it+\"'>Exportar Excel</a>";  ?></li>"

	}
}
//setTimeout(modificarexportar,3000);
</script>

<?php
  $where = "";
  if(Yii::app()->controller->usertype() == 1){
    //echo 'Empresa';
    $u = Yii::app()->user->id;
    $tipo=1;
  }
  if(Yii::app()->controller->usertype() == 2){
   $u = $_POST['filtro_eess'];
   $tipo=2;
  }
  if(Yii::app()->controller->usertype() == 3){
    //echo 'Evaluador';
    $u = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
    $tipo=3;
  }
?>

<script type="text/javascript">

function modificarexportar(){
	var x = document.getElementsByClassName("export-main");
	var c = x.length;

	for(i=0;i<c;i++){
		x[i].getElementsByTagName('ul')[0].getElementsByTagName('li')[1].innerHTML = "<li><?php echo "<a href='Informes/exportarExcel.php?rut=".$u."&tipo=".$_POST['filtro_tipo']."'>Exportar datos 2</a>";  ?></li>"
	}
}
	setTimeout(modificarexportar,3000);
</script>
<?php 

	$rows = Yii::app()->db->createCommand("SELECT * FROM min_evaluacion_equipos e WHERE 1 ".$where_evaluacion."")->queryAll();
	//ACTUALIZAR PORCENTAJE EVALUACIONES 
	//USAR SÓLO PARA EVALUACIONES QUE NO GRABEN SU PORCENTAJE
	/*$rows = Yii::app()->db->createCommand("SELECT 
							e.eva_id , 
							SUM(IF(r.res_respuesta = 'si',1,0)) AS S, 
							SUM(IF(r.res_respuesta = 'no',1,0)) AS N, 
							SUM(IF(r.res_respuesta = 'n/a',1,0)) AS NA 
							FROM min_evaluacion_equipos as e 
							JOIN min_respuesta_equipos as r ON(e.eva_id = r.eva_id) 
							WHERE e.eess_rut='96960670' and r.tem_id='Seguridad' group by e.eva_id")->queryAll();
	for($j=0;$j<count($rows);$j++){
		$prcnt=floor($rows[$j]['S']*100/($rows[$j]['S']+$rows[$j]['N']));
		$guardarMedidaControl= "UPDATE min_evaluacion_equipos set
								eva_item_nota_1=".$prcnt."
								where eva_id=".$rows[$j]['eva_id']." ";
									//return;
		Yii::app()->db->createCommand($guardarMedidaControl)->execute();
	}*/
	if(count($rows)==0){
		echo '<div class="alert alert-warning">Sin resultados</div>';
		return;
	}
	
	// Parche categorías
	if($_POST['filtro_tipo'] == 'Motosierristas Cosecha y Raleo'){
		$rows[0]['eva_item_nombre_0'] = 'TOCONES';
	
		$rows[0]['eva_item_nombre_2'] = 'PLANIFICACIÓN';
		$rows[0]['eva_item_nombre_3'] = 'TRANSVERSAL';
		//$rows[0]['eva_fecha_evaluacion'] = 'FECHA EVALUACION';
	}
	
	$hdrs = "";
	$encabezados=array();
	for($h=0;$h<count($rows);$h++){
		for($j=0;$j<20;$j++){
			if(isset($rows[$h]['eva_item_nombre_'.$j])){
				if($rows[$h]['eva_item_nombre_'.$j] != ''){
					if (in_array($rows[$h]['eva_item_nombre_'.$j], $encabezados) || $rows[$h]['eva_item_nombre_'.$j] == 'ANTECEDENTES GENERALES'){
						
					}else{
						array_push($encabezados,$rows[$h]['eva_item_nombre_'.$j]);
						$hdrs.= '<th>'.$rows[$h]['eva_item_nombre_'.$j].'</th>';
					}
					
				}
				 
			}
			 
		}
	}
	
	echo '<table class="table" style="background:#ffffff; font-size:8pt;">
	<thead>
		<tr>
		<th>Código máquina</th>
		<th>Nombre máquina</th>
		<th>Patente</th>
		<th>Fecha Evaluacion</th>
		'.$hdrs.'
		<th>Porcentaje de Cumplimiento</th>
		</tr>
	</thead>
	';
	// Actualizar porcentaje cache
					$limit1 = Yii::app()->params['riesgoalto'];
					$limit2 = Yii::app()->params['riesgomedio'];
	
					$MalNotaBaja = Yii::app()->params['MalNotaBaja'];
	          		$RalLimBajo = Yii::app()->params['RalLimBajo'];
	
	          		$MalNotaMedia = Yii::app()->params['MalNotaMedia'];
	          		$RalLimMedio = Yii::app()->params['RalLimMedio'];
	
	          		$MalNotaAlta = Yii::app()->params['MalNotaAlta'];
					$RalLimAlto = Yii::app()->params['RalLimAlto'];
                    for($i=0;$i<count($rows);$i++){
                        $hdrs = "";
                        $countEncabezado=0;
                        for($j=0;$j<count($encabezados);$j++){
                            $flag = false;
                            for ($k=0; $k < 11; $k++) { 
                                if ($rows[$i]['eva_item_nombre_'.$k] == $encabezados[$j]) {
                                    $flag = true;
                                    echo '<script>console.log("'.$rows[$i]['eva_item_nombre_'.$k].' - '.$encabezados[$j].'");</script>';
                                    if($rows[$i]['eva_item_nota_'.$k]>=0 &&  $rows[$i]['eva_item_nota_'.$k]<=$limit1) $style = 'danger';
                                        if($rows[$i]['eva_item_nota_'.$k]>$limit1 &&  $rows[$i]['eva_item_nota_'.$k]<=$limit2) $style = 'warning';
                                        if($rows[$i]['eva_item_nota_'.$k]>$limit2 &&  $rows[$i]['eva_item_nota_'.$k]<=100) $style = 'success';
                                
                                        $hdrs.= '<td><div class="parcial btn btn-'.$style.' btn-xs">'.$rows[$i]['eva_item_nota_'.$k].' %</div></td>';
                                }
                            }
                            if ( !$flag ) {
                                $hdrs.= '<td>N/A</td>';
                            }
                    
                            // metodo antiguo con mal orden
                            /*
                            if(isset($rows[$i]['eva_item_nombre_'.$j])){
                                if($rows[$i]['eva_item_nombre_'.$j] != ''){
                    
                                    if($rows[$i]['eva_item_nota_'.$j]!=''){
                                        
                                        //$style = 'success';
                                        //if($rows[$i]['eva_item_nota_'.$j]<Yii::app()->params['riesgomedio'])$style = 'warning';
                                        //if($rows[$i]['eva_item_nota_'.$j]<Yii::app()->params['riesgoalto'])$style = 'danger';
                                        if($rows[$i]['eva_item_nota_'.$j]>=0 &&  $rows[$i]['eva_item_nota_'.$j]<=$limit1) $style = 'danger';
                                        if($rows[$i]['eva_item_nota_'.$j]>$limit1 &&  $rows[$i]['eva_item_nota_'.$j]<=$limit2) $style = 'warning';
                                        if($rows[$i]['eva_item_nota_'.$j]>$limit2 &&  $rows[$i]['eva_item_nota_'.$j]<=100) $style = 'success';
                                
                                        $hdrs.= '<td><div class="parcial btn btn-'.$style.' btn-xs">'.$rows[$i]['eva_item_nota_'.$j].' %</div></td>';
                                        $countEncabezado++;
                                    }
                                    else{
                                        $countEncabezado++;
                                        $hdrs.= '<td>N/A</td>';
                                    }
                                }else{
                                        $hdrs.= '<td>N/A</td>';
                                    }
                            }else{
                                        //$countEncabezado++;
                                        $hdrs.= '<td>N/A</td>';
                            }	*/
                        }
	
	//$style = 'success';
	//if($rows[$i]['eva_cache_porcentaje']<Yii::app()->params['riesgomedio'])$style = 'warning';
	//if($rows[$i]['eva_cache_porcentaje']<Yii::app()->params['riesgoalto'])$style = 'danger';
	$cache_porcentaje=floor($rows[$i]['eva_cache_porcentaje']);
	if($cache_porcentaje>=0 &&  $cache_porcentaje<=$limit1) $style = 'danger';
				if($cache_porcentaje>$limit1 &&  $cache_porcentaje<=$limit2) $style = 'warning';
				if($cache_porcentaje>$limit2 &&  $cache_porcentaje<=100) $style = 'success';

	echo '
	<tr>
		<td><a href="index.php?r=evaluacion/view&id='.$rows[$i]['eva_id'].'" target="_blank">'.$rows[$i]['eq_codigo'].'</a></td>
		<td><a href="index.php?r=evaluacion/view&id='.$rows[$i]['eva_id'].'" target="_blank">'.$rows[$i]['eq_maquina'].'</a></td>
		<td><a href="index.php?r=evaluacion/view&id='.$rows[$i]['eva_id'].'" target="_blank">'.$rows[$i]['eva_patente'].'</a></td>
		<td><a href="index.php?r=evaluacion/view&id='.$rows[$i]['eva_id'].'" target="_blank">'.$rows[$i]['eva_fecha_evaluacion'].'</a></td>
		'.$hdrs.'
		<td><div class="btn btn-'.$style.' btn-block btn-xs">'.floor($rows[$i]['eva_cache_porcentaje']).' %</div></td>
	</tr>
	';
}
	echo '</table>';  
?>

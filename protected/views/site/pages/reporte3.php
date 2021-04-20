<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<style type="text/css">
 li: a: span{
      color:red;
    }
    .parcial{
    	width:50px;
    	text-align:right;
    	opacity:0.8;
    }
    .rounded{
    	border-radius: 200px 200px 200px 200px;
-moz-border-radius: 200px 200px 200px 200px;
-webkit-border-radius: 200px 200px 200px 200px;
border: 0px solid #000000;
    }

     .exportTrabajador{
    	margin-right:20px;
    }




</style>
<?php
$where_evaluacion = "";
$where_evaluacion_2 = "";
$whereVariablesEvaluacion="";
$whereVariable="";
$whereVariableGrupal="";
$whereVariableGrupalExcesos="";
$eess = '';

// Cuando el tipo de usuario es empresa
if(Yii::app()->controller->usertype() == 1){
	
	if(!isset($_POST['filtro_eess'])){
		$_POST['filtro_eess'] = Yii::app()->user->id;
		$eess =  Yii::app()->user->id;
	}
	
	if(!isset($_POST['filtro_tipo'])){
		$_POST['filtro_tipo'] = '';
	}
	
	if(!isset($_POST['filtro_trabajador'])){
		$_POST['filtro_trabajador'] = '';
	}
	
	$where_evaluacion.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";
	$whereVariablesEvaluacion.="AND e.eess_rut = '".$_POST['filtro_eess']."' ";
	$whereVariable=" AND e.eess_rut = '".$_POST['filtro_eess']."'";
	$whereVariableGrupal=" AND e.eess_rut = '".$_POST['filtro_eess']."'";
	$whereVariableGrupalExcesos=" AND e.eess_rut = '".$_POST['filtro_eess']."'";

	
	/*if($_POST['filtro_eess'] != ""){
		$where_evaluacion.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";		
	}*/

}
// Cuando el tipo de usuario es evaluador
if(Yii::app()->controller->usertype() == 3){
	$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
	$_POST['filtro_eess'] = $eess;
	$whereVariable=" AND e.eess_rut = '".$_POST['filtro_eess']."'";
	if($_POST['filtro_eess'] != ""){
		$whereVariablesEvaluacion.="AND e.eess_rut = '".$_POST['filtro_eess']."' ";
		$where_evaluacion.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";
	} 
}
if(isset($_POST['filtro_cargo']) && $_POST['filtro_cargo'] !==''){
	//$where_evaluacion.= " AND e.eva_cargo = '".$_POST['filtro_cargo']."' ";
}
if(isset($_POST['filtro_tipo'])){
	$where_evaluacion.= " ";
	//if($_POST['filtro_area'] != "") $where_evaluacion.= " AND UPPER(e.car_servicio) = UPPER('".$_POST['filtro_area']."') ";
	/*if(isset($_POST['filtro_eess']) && $_POST['filtro_eess'] != ""){
		$where_evaluacion.= " AND e.eess_rut = '".$_POST['filtro_eess']."' ";
	} */
	if($_POST['filtro_tipo'] != "") $where_evaluacion.= " AND e.eva_tipo = '".$_POST['filtro_tipo']."' ";
	if($_POST['filtro_trabajador'] != ""){
		$where_evaluacion.= " AND (CONCAT(e.eva_nombres,e.eva_apellidos,e.tra_rut) LIKE '%".$_POST['filtro_trabajador']."%') ";
		$whereVariableGrupal.="AND e.rut_trabajador='".$_POST['filtro_trabajador']."' ";
		$whereVariableGrupalExcesos.="AND e.tra_rut='".$_POST['filtro_trabajador']."' ";
		
	} 
	//if($_POST['filtro_trabajador_nombre'] != "") $where_evaluacion.= " AND (CONCAT(e.eva_nombres,e.eva_apellidos,e.tra_rut) LIKE '%".$_POST['filtro_trabajador_nombre']."%') ";
	//if($_POST['filtro_fundo'] != "") $where_evaluacion.= " AND e.eva_fundo = '".$_POST['filtro_fundo']."' ";
	//if($_POST['filtro_faena'] != "") $where_evaluacion.= " AND e.eva_faena = '".$_POST['filtro_faena']."' ";
	//if($_POST['filtro_desde'] != "") $where_evaluacion.= " AND e.eva_fecha_evaluacion > '".$_POST['filtro_desde']." 00:00:00'";
	//if($_POST['filtro_hasta'] != "") $where_evaluacion.= " AND e.eva_fecha_evaluacion < '".$_POST['filtro_desde']." 23:59:59'";
}
else{
	$where_evaluacion.= " ";
	
}

	$cargosEess = "";
	$cargosEess = Yii::app()->db->createCommand("SELECT DISTINCT(tra.car_id), car_descripcion FROM min_trabajador as tra INNER JOIN min_cargo as car ON tra.car_id = car.car_id WHERE tra.eess_rut = ".$eess." ORDER BY car_descripcion ASC ")->query()->readAll();

?>

 <!-- Ignite UI Required Combined CSS Files -->
    <link href="https://cdn-na.infragistics.com/igniteui/2018.1/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
    <!-- <link href="css/igniteui-infragistics.css" rel="stylesheet" /> -->
    <link href="https://cdn-na.infragistics.com/igniteui/2018.1/latest/css/structure/infragistics.css" rel="stylesheet" />
<script src="js/jquery.min.js"></script> 
    <!--<script src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.8.3.js"></script>-->
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

    <!-- Ignite UI Required Combined JavaScript Files -->
    <script src="https://cdn-na.infragistics.com/igniteui/2018.1/latest/js/infragistics.core.js"></script>
    <script src="js/ignite.js"></script>

<script type="text/javascript" src="js/amcharts/amcharts.js"></script>
  <script type="text/javascript" src="js/amcharts/dataloader.js"></script>
  <script type="text/javascript" src="js/amcharts/serial.js"></script>
  <script type="text/javascript" src="js/amcharts/gauge.js"></script>
  <script type="text/javascript" src="js/amcharts/pie.js"></script>
<!-- Chart code -->

<script src="https://d3js.org/d3.v4.js"></script>
<script src="http://dimplejs.org/dist/dimple.v2.3.0.min.js"></script>
<link href="https://www.amcharts.com/lib/3/plugins/export/export.css" media="all" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://www.amcharts.com/lib/3/plugins/export/export.js"></script>

<link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.min.css">
<script src="js/bootstrap-select/bootstrap-select.min.js"></script> 


<br>
<h2 class="page-header">Reporte de Información</h2>
<h3>Ranking por Trabajador</h3>
<!--FILTROS-->
<form method="post">
<div class="row">
	
    <!-- 1 empresa - 2 administrador - 3 evaluador -->
	<div class="col-sm-2" <?php if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) echo 'style="display:none;"';?>>
		<small>Empresa</small>
		<select name="filtro_eess" class="form-control selectpicker " data-live-search="true" <?php if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) echo 'disabled';?> onchange="this.form.submit();">
			<?php
			if(Yii::app()->controller->usertype() == 1){
				$rows = Yii::app()->db->createCommand("SELECT * FROM min_eess WHERE eess_rut = '".Yii::app()->user->id."'")->query()->readAll();
			}
			else if(Yii::app()->controller->usertype() == 3){
				$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
				$rows = Yii::app()->db->createCommand("SELECT * FROM min_eess WHERE eess_rut = '".$eess."'")->query()->readAll();
			}
			else{
				$rows = Yii::app()->db->createCommand("SELECT * FROM min_eess")->query()->readAll();
				echo '<option value="">[Todas las empresas]</option>';
			}
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
	<div class="col-sm-3">
		<small>Cargo</small>
		<select name="filtro_cargo" class="form-control selectpicker " data-live-search="true" onchange="this.form.submit();" >
			<?php
				if(Yii::app()->controller->usertype() == 1){
					$rows = Yii::app()->db->createCommand("SELECT c.car_id,c.car_descripcion FROM min_cargo c
						JOIN min_trabajador t 
                            ON t.car_id=c.car_id
						WHERE t.eess_rut='".Yii::app()->user->id."'
                        GROUP BY c.car_id"
                    )->query()->readAll();
				}
				else if(Yii::app()->controller->usertype() == 3){
					$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
					
					$rows = Yii::app()->db->createCommand("SELECT c.car_id,c.car_descripcion FROM min_cargo c
															JOIN min_trabajador t on t.car_id=c.car_id
															where t.eess_rut='".$eess."'
															GROUP BY c.car_id  ")->query()->readAll();
				}
				else{
					$rows = Yii::app()->db->createCommand("SELECT c.car_id,c.car_descripcion FROM min_cargo c
															JOIN min_trabajador t on t.car_id=c.car_id
															GROUP BY c.car_id  ")->query()->readAll();
				}
			$selected = "";
			if(!isset($_POST['filtro_cargo']) || $_POST['filtro_cargo'] == ''){
				$selected = "selected";
			}			
			echo '<option '.$selected.' value="" >[Todos los cargos]</option>';
			for($i=0;$i<count($rows);$i++){
				$selected = "";
				if(isset($_POST['filtro_cargo'])) 
					if(rtrim($_POST['filtro_cargo']) == rtrim($rows[$i]['car_descripcion'])){
						$selected = "selected";	
					}
					 

				echo '<option '.$selected.' value="'.$rows[$i]['car_descripcion'].'">'.$rows[$i]['car_descripcion'].'</option>';
				
			}
			$value = '';
			?>
		</select>
	</div>
	<div class="col-sm-3">
		<small>Actividad</small>
		<select name="filtro_tipo" class="form-control selectpicker " data-live-search="true" onchange="this.form.submit();" title="Actividad">
			<?php
			if(Yii::app()->controller->usertype() == 1){
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_tipo FROM min_evaluacion e WHERE eess_rut = '".Yii::app()->user->id."' ")->query()->readAll();
			}
			else if(Yii::app()->controller->usertype() == 3){
				$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_tipo FROM min_evaluacion e WHERE eess_rut = '".$eess."' ")->query()->readAll();
			}
			else{
				$rows = Yii::app()->db->createCommand("SELECT distinct eva_tipo FROM min_evaluacion e WHERE 1 ")->query()->readAll();
			}
			$selected = "";
			if(!isset($_POST['filtro_tipo']) || $_POST['filtro_tipo'] == ''){
				$selected = "selected";
			}		
			echo '<option '.$selected.' value="">[Todas las Actividades]</option>';
			for($i=0;$i<count($rows);$i++){
				$selected = "";
				if(isset($_POST['filtro_tipo'])) 
					if($_POST['filtro_tipo'] == $rows[$i]['eva_tipo'])
					 $selected = "selected";

				echo '<option '.$selected.' value="'.$rows[$i]['eva_tipo'].'">'.$rows[$i]['eva_tipo'].'</option>';
				
			}
			$value = '';
			?>
		</select>
	</div>
	<!-- <div class="col-sm-3">
		<small>Trabajador</small>
		<select name="filtro_trabajador" class="form-control selectpicker " data-live-search="true" onchange="this.form.submit();" title="Trabajador">
			<?php
			if(Yii::app()->controller->usertype() == 1){
				$rows = Yii::app()->db->createCommand("SELECT * FROM min_trabajador t WHERE eess_rut = '".Yii::app()->user->id."' ")->query()->readAll();
			}
			else if(Yii::app()->controller->usertype() == 3){
				$rows = Yii::app()->db->createCommand("SELECT * FROM min_trabajador t WHERE eess_rut = '".Yii::app()->user->id."' ")->query()->readAll();
			}
			else{
				$rows = Yii::app()->db->createCommand("SELECT * FROM min_trabajador t WHERE 1 ")->query()->readAll();
			}
			$selected = "";
			if(!isset($_POST['filtro_trabajador']) || $_POST['filtro_trabajador'] == ''){
				$selected = "selected";
			}
			echo '<option '.$selected.' value="">[Todos los trabajadores]</option>';
			for($i=0;$i<count($rows);$i++){
				$selected = "";
				if(isset($_POST['filtro_trabajador'])) 
					if($_POST['filtro_trabajador'] == $rows[$i]['tra_rut'])
					 $selected = "selected";

				echo '<option '.$selected.' value="'.$rows[$i]['tra_rut'].'">'.$rows[$i]['tra_nombres'].' '.$rows[$i]['tra_apellidos'].'</option>';
				
			}
			$value = '';
			
			?>
		</select>
	</div> -->
	
	<!--<div class="col-sm-2">
		<small>Rut Trabajador</small>
		<input name="filtro_trabajador" type="text" class="form-control input-sm" placeholder="Buscar por rut" value="<?php if(isset($_POST['filtro_trabajador'])) echo $_POST['filtro_trabajador'];?>">
	</div>
	<div class="col-sm-2">
		<small>Nombre Trabajador</small>
		<input name="filtro_trabajador_nombre" type="text" class="form-control input-sm" placeholder="Buscar por nombre" value="<?php if(isset($_POST['filtro_trabajador_nombre'])) echo $_POST['filtro_trabajador_nombre'];?>">
	</div>-->
	<div class="col-sm-2" id="contenedor_submit" style="display:none;">
		<input type="submit" class="btn btn-primary btn-block btn-sm" style="margin-top:20px;" value="Generar reporte">
	</div>
	
	<span style='float:right;'>

	<?php
	if(isset($_POST['filtro_tipo'])){
		$value2 = $_POST['filtro_tipo'];
		if(isset($_POST['filtro_eess']))
		{
			$value1 = $_POST['filtro_eess'];
		}else{$value1 = '';}
		
	}else{
		$value1 = '';
		$value2 = '';
	}


	
	

	 echo CHtml::link('<img src="img/descarga.png" width="40px;">',array('Reporte2','param1'=>$selected,
                                         'param2'=>$value1,
                                         'param3'=>$value2,
                                         'param4'=>''),array('title'=>'Exportar XLS'));
                                         ?>
     <!--<a id="exportar_xls" href="exportarReporte2.php" alt="Exportar a Excel" class="btn btn-sm btn-success" onclick="updateurl();"><i class="i i-file-excel"></i></a>
-->


	</span> 

</div>

</form>

<script>
function updateurl(){
a = document.getElementByTagName('filtro_tipo').value;
e = document.getElementByTagName('filtro_eess').value;
document.getElementById('exportar_xls').href = 'exportarReporte2.php?a='+a+'&e='+e;
}
$('#ulReporte').show();
$('.liReportes').addClass('active');
</script>
<style>
	.btn-success{
		background:#119A0E;
	}
</style>

<?php 

	//empresa
	if(Yii::app()->controller->usertype() == 2){
		
		if(!isset($_POST['filtro_tipo'])) return; 
	}
	
?>


<!-- <h4>Evaluaciones con Riesgo Alto</h4> sin titulo-->
<?php
$filtroCargo='';
if(isset($_POST['filtro_cargo'])){
	$filtroCargo= $_POST['filtro_cargo'] !== '' ? "AND C.car_descripcion like '%".rtrim($_POST['filtro_cargo'])."%' " : "";
	//echo $filtroCargo;
}

function calculoNotaEmpresa($nota,$cumplimiento){
						
	$notaFinal=0;
	
	
	if( count($nota) == 0 ){
		$notaFinal = 5;
	}else{
		for($n=0;$n<count($nota);$n++){
		
			$pendiente = ($nota[$n]['var_not_nota_superior'] - $nota[$n]['var_not_nota_inferior']) / ($nota[$n]['var_not_rango_superior'] - $nota[$n]['var_not_rango_inferior']);
			$intercepto = $nota[$n]['var_not_nota_superior'] - ( $pendiente * $nota[$n]['var_not_rango_superior'] ) ;
			$calculoNota = bcdiv( ( $pendiente * $cumplimiento + $intercepto ), 1, 1);
			
			
			if( $cumplimiento > $nota[$n]['var_not_rango_inferior'] && $cumplimiento <= $nota[$n]['var_not_rango_superior']){
				//$cumplimientoGrupal[$m]['nota']=$nota[$n]['var_not_nota'];
				$notaFinal=$calculoNota;
				//echo 'entro rango';
				
			}else{
				if( !isset($nota[$n+1] ) && (!isset( $notaFinal ) || $notaFinal == 0 ) ){
					//$notaFinal=5;
					//var_dump($nota[$n]);
					if($cumplimiento == 0){
						$notaFinal=5;
						//echo 'entro igual a 5';
					}else{
						$notaFinal=$nota[$n]['var_not_nota_superior'];
						//echo 'entro ultimo else';
					}
	
					//$cumplimientoGrupal[$m]['nota']=$nota[$n]['var_not_nota'];
				}
			}
				
		}
	}
	
	
	
	return $notaFinal;
	
}

function calculoNotaIndividual($cGrupal,$nota){
						
	for($m=0;$m<count($cGrupal);$m++){
		
		if( count($nota) == 0 ){
			$cGrupal[$m]['nota']=5;
		}else{
			for($n=0;$n<count($nota);$n++){
			
				$pendiente = ($nota[$n]['var_not_nota_superior'] - $nota[$n]['var_not_nota_inferior']) / ($nota[$n]['var_not_rango_superior'] - $nota[$n]['var_not_rango_inferior']);
				$intercepto = $nota[$n]['var_not_nota_superior'] - ( $pendiente * $nota[$n]['var_not_rango_superior'] ) ;
				$calculoNota = bcdiv( ( $pendiente * $cGrupal[$m]['sum'] + $intercepto ), 1, 1);
				
				if( $cGrupal[$m]['sum'] > $nota[$n]['var_not_rango_inferior'] && $cGrupal[$m]['sum'] <= $nota[$n]['var_not_rango_superior']){
					//$cumplimientoGrupal[$m]['nota']=$nota[$n]['var_not_nota'];
					$cGrupal[$m]['nota']=$calculoNota;
				}else{
					if( !isset($nota[$n+1]) && !isset( $cGrupal[$m]['nota'] ) ) {
						$cGrupal[$m]['nota']=$calculoNota;
					}
				}
				
			}
		}
	
		
	}																					
	
	return $cGrupal;
}

function asociarNotaTrabajador( $trabajadores,$cumplimientoGrupal,$ponderacionVariable,$flagEvaluacion = false ){
						
	foreach ($trabajadores as $key => $val) {

		$resultSearch=array_search($val['rut'], array_column($cumplimientoGrupal, 'rut'));

		if ( $resultSearch === false ) {
			$trabajadores[$key]['aplica'] = true;
			
			if( $flagEvaluacion == false ){
				
				$trabajadores[$key]['nota']+=5*($ponderacionVariable/100);
	            //$trabajadores[$key]['nota']=0;

				
				/*echo 'no encontro coincidencias <br/>';
				echo $val['rut'].'---';
				echo $ponderacionVariable.'---';
				echo $trabajadores[$key]['nota'].'<br/>';*/
			}
            
			
		}else{
			
			$test = $cumplimientoGrupal[$resultSearch]['nota'];
            $trabajadores[$key]['nota']+=$cumplimientoGrupal[$resultSearch]['nota']*($ponderacionVariable/100);
            $trabajadores[$key]['aplica'] = true;
			/*echo 'encontro coincidencias <br/>';
			echo $val['rut'].'---';
			echo $ponderacionVariable.'---';
			echo $cumplimientoGrupal[$resultSearch]['nota'].'---';
			echo $trabajadores[$key]['nota'].'<br/>';*/
			
		}
	}
	
	return $trabajadores;
	
}

function filtroPeriodo($periodo,$cantidad,$campoFecha){

	if( $periodo == 'semanal' ){
		$periodoCalculado = $cantidad * 7;
		$wherePeriodo = ' and '.$campoFecha.' >= NOW() - INTERVAL '.$periodoCalculado.' DAY AND '.$campoFecha.'  < NOW() ';
	}else{
		
		$wherePeriodo = 'and '.$campoFecha.' >= NOW() - INTERVAL '.$cantidad.' MONTH';
	}
	
	return $wherePeriodo;
	
}

function showVar($nombreVar,$var){
	echo '<pre>'.$nombreVar.'<br/>';
	print_r($var);
	echo '</pre>';
}




$rows = Yii::app()->db->createCommand("SELECT 
							eva_id
							,eva_creado
							,eva_tipo
							,e.eess_rut
							,e.tra_rut
							,eva_apellidos
							,eva_nombres
							,eva_fecha_evaluacion
							,eva_general_fecha
							,eva_evaluador
							,eva_cache_porcentaje
							,eva_cargo
							,eva_fecha
							,eva_item_nombre_0
							,eva_item_nota_0
							,eva_item_nombre_1
							,eva_item_nota_1
							,eva_item_nombre_2
							,eva_item_nota_2
							,eva_item_nombre_3
							,eva_item_nota_3
							,eva_item_nombre_4
							,eva_item_nota_4
							,eva_item_nombre_5
							,eva_item_nota_5
							,eva_item_nombre_6
							,eva_item_nota_6
							,eva_item_nombre_7
							,eva_item_nota_7
							,eva_item_nombre_8
							,eva_item_nota_8
							,eva_item_nombre_9
							,eva_item_nota_9
							,eva_item_nombre_10
							,eva_item_nota_10 
							FROM min_evaluacion e JOIN min_trabajador as T
                           ON(e.tra_rut = T.tra_rut)
                           JOIN min_cargo as C
                           ON(T.car_id = C.car_id)
                           JOIN min_eess as EE
                           ON(T.eess_rut = EE.eess_rut) WHERE 1 ".$filtroCargo."  ".$where_evaluacion." ORDER BY eva_nombres ASC")->queryAll();
if(count($rows)==0){
	echo '<div class="alert alert-warning">Sin resultados</div>';
	return;
}

		/*$rows2 = Yii::app()->db->createCommand("SELECT 
										eva_id
										, UPPER(CONCAT(substring_index(eva_nombres,' ',1),' ',substring_index(eva_apellidos,' ',1))) as completo
										, AVG(eva_cache_porcentaje) AS promedio
										, '#000000' as color
										,count(e.eva_id) as countEvaluaciones 
										FROM min_evaluacion e 
										JOIN min_trabajador as T ON(e.tra_rut = T.tra_rut)
			                           JOIN min_cargo as C ON(T.car_id = C.car_id)
			                           JOIN min_eess as EE ON(T.eess_rut = EE.eess_rut) 
										WHERE 1 
										".$where_evaluacion." 
										".$filtroCargo."
										GROUP BY e.tra_rut 
										ORDER BY AVG(eva_cache_porcentaje)")->queryAll();*/
		
		$variablesEvaluacion = Yii::app()->db->createCommand(
																"SELECT 
																	e.var_id,
																	var_nombre,
																	var_descripcion,
																	e.eess_rut,
																	var_ponderacion,
																	var_meta,
																	var_tipo,
																	var_tolerancia,
																	var_periodo,
																	var_periodo_cantidad,
																	e.tmv_id,
																	tmv.tmv_descripcion
																	
																	
																 from min_variable_evaluacion e
																LEFT JOIN min_tipo_medicion_variable tmv on tmv.tmv_id =  e.tmv_id
																where e.var_activa=1 ".$whereVariablesEvaluacion." "
															)->query()->readAll();
											
		$trabajadoresSQL = Yii::app()->db->createCommand("SELECT DISTINCT(tra_rut) as rut,CONCAT(e.tra_nombres,' ',e.tra_apellidos)as completo,0 as nota, e.tra_nombres as nombres, e.tra_apellidos as apellidos FROM min_trabajador e WHERE 1 ".$whereVariable." ")->query()->readAll();
        $trabajadores;
        foreach ($trabajadoresSQL as $key => $value) {
            $contador_eval = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion WHERE tra_rut = ".$trabajadoresSQL[$key]['rut'])->queryScalar();
            $nombre_desglosado = explode(" ",$value['nombres']);
            $apellido_desglosado = explode(" ",$value['apellidos']);
            $short_name = $nombre_desglosado[0]." ".$apellido_desglosado[0];
            $trabajadoresSQL[$key]['short_name'] = $short_name;
            $trabajadoresSQL[$key]['contador'] = $contador_eval;
            $trabajadores[$key] = $trabajadoresSQL[$key];
        }
        //echo "SELECT DISTINCT(tra_rut) as rut,5 as nota FROM min_trabajador e WHERE 1 ".$whereVariable." ";
		//var_dump($trabajadores);							
		
					
		$denominadorCalculado=0;
		$cumplimientoAcumulado=array();
		for($i=0;$i<count($variablesEvaluacion);$i++){
			
			$cumplimiento=0;
			$cumplimientoGrupal=array();
			//ASD
			
			$nota=0;
			$notaFinal=0;
			$nota = Yii::app()->db->createCommand("SELECT * from min_variable_notas
												where var_id=".$variablesEvaluacion[$i]['var_id']." order by var_not_rango_superior asc ")->query()->readAll();
			$rangos = Yii::app()->db->createCommand("SELECT * from min_nivel_riesgo
												where var_id=".$variablesEvaluacion[$i]['var_id']." 
												order by nr_hasta desc")->query()->readAll();
			$variablesEvaluacion[$i]['notas']=$nota;
			$variablesEvaluacion[$i]['nivelRiesgo']=$rangos;
			
			switch(strtolower($variablesEvaluacion[$i]['var_nombre'])){
				
                case 'evaluaciones':
                    $eessActual;
                    if(Yii::app()->controller->usertype() == 1){
                        $eessActual = Yii::app()->user->id."";
                    }
                    else if(Yii::app()->controller->usertype() == 3){
                        $eessActual = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
                        
                    }
                    
                    //en caso de estar definido el periodo de evaluación de la variable, procedo a llamar a la función
                    // que hace el trabajo de crear el filtro para la query
                    if( isset( $variablesEvaluacion[$i]['var_periodo'] ) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'e.eva_creado');

					}else{
						$wherePeriodo = '';
					}

                    $cumplimientoGrupal = Yii::app()->db->createCommand("SELECT 
	                    										rut,
	                    										completo, 
	                    										TRUNCATE(porc,0) as sum 
                    										FROM
                    											(SELECT 
                    												AVG(eva_cache_porcentaje) as porc, 
                    												e.tra_rut as rut, 
                    												UPPER(CONCAT(substring_index(e.eva_nombres,' ',1),' ',substring_index(e.eva_apellidos,' ',1))) as completo 
                    											FROM min_evaluacion as e 
                    												JOIN min_eess as EE ON(e.eess_rut = EE.eess_rut) 
                    												JOIN min_trabajador as T ON(e.tra_rut = T.tra_rut) 
                    												JOIN min_cargo as C ON(T.car_id = C.car_id) 
                    											WHERE 
                    												EE.eess_estado = 1 AND 
                    												e.eess_rut = ".$eessActual." 
                    												".$wherePeriodo."
                    											GROUP BY 
                    												e.tra_rut 
                    											ORDER BY 
                    												AVG(eva_cache_porcentaje) 
																) as czx")->queryAll();
                                                                  

					$cumplimiento = Yii::app()->db->createCommand("SELECT 
										FLOOR(AVG(eva_cache_porcentaje)) AS promedio									
										FROM min_evaluacion e 
										JOIN min_trabajador as T
			                           ON(e.tra_rut = T.tra_rut)
			                           JOIN min_cargo as C
			                           ON(T.car_id = C.car_id)
			                           JOIN min_eess as EE
			                           ON(T.eess_rut = EE.eess_rut) 
										WHERE 
										1 ".$where_evaluacion." ".$wherePeriodo." ")->queryScalar();
										//echo $cumplimiento;
									
					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);		
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					
					//evaluaciones
					$trabajadores = asociarNotaTrabajador( $trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion'],true );

					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					break;
				case 'accidentes ctp':
				
					
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) ){
						
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'fecha_accidente');

					}else{
						$wherePeriodo = '';
					}

					
					$cumplimiento = Yii::app()->db->createCommand("select ifnull(sum(DATEDIFF( IFNULL(e.fecha_alta,CURDATE()),e.fecha_accidente))+1,0) from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariable.$wherePeriodo." ")->queryScalar();
					
					$cumplimientoGrupal = Yii::app()->db->createCommand("select e.rut_trabajador as rut,sum(DATEDIFF( IFNULL(e.fecha_alta,CURDATE()),e.fecha_accidente))+1 as sum from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariableGrupal.$wherePeriodo."
																	GROUP by 
																			e.rut_trabajador")->query()->readAll();
				
										
					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);		
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					//accidentes ctp
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					
					break;

				case 'accidentes daño material':
					
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'fecha_accidente');

					}else{
						$wherePeriodo = '';
					}
					
					$cumplimiento = Yii::app()->db->createCommand("select ifnull(sum(e.acc_costo_perdida),0) as cumplimiento from min_accidente e where e.acc_tipo_accidnte='accidentes daño material' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
					// echo "select sum(e.acc_costo_perdida) from min_accidente e where e.acc_tipo_accidnte='Daño Material' ".$whereVariable."";
					$cumplimientoGrupal = Yii::app()->db->createCommand("select e.rut_trabajador as rut
																				,sum(acc_costo_perdida) as sum from min_accidente e
																		join min_trabajador trab on trab.tra_rut=e.rut_trabajador
																		where 
																				acc_tipo_accidnte='accidentes daño material' ".$whereVariableGrupal."
																				".$wherePeriodo."
																		GROUP by 
																				e.rut_trabajador")->query()->readAll();


					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);		
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					//accidentes daño material
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
				
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					break;
					
				case 'plan buen conductor':
				
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'exc_fecha');

					}else{
						$wherePeriodo = '';
					}
					
					$cumplimiento = Yii::app()->db->createCommand("select ifnull(count(e.exc_id),0) as cumplimiento from min_excesos_velocidad e where e.var_nombre='Plan buen conductor' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
					$cumplimientoGrupal = Yii::app()->db->createCommand("select e.tra_rut as rut
																				,ifnull(count(e.exc_id),0) as sum from min_excesos_velocidad e
																		join min_trabajador trab on trab.tra_rut=e.tra_rut
																		where 
																				e.var_nombre='Plan buen conductor' ".$whereVariableGrupalExcesos."
																				".$wherePeriodo."
																		GROUP by 
																				e.tra_rut")->query()->readAll();




					//var_dump($nota);
					//echo '<br>inicio plan buen<br>';
					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);		
					//echo '<br>fin plan buen<br>';
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					
					//var_dump($cumplimientoGrupal);
					//plan buen conductor
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
				
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					break;
					
				case 'accidentes stp':
					
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'fecha_accidente');

					}else{
						$wherePeriodo = '';
					}
					
					$cumplimiento = Yii::app()->db->createCommand("select ifnull(COUNT(e.id_accidente),0) from min_accidente e where e.acc_tipo_accidnte='Accidentes stp' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
					// echo "select sum(e.acc_costo_perdida) from min_accidente e where e.acc_tipo_accidnte='Daño Material' ".$whereVariable."";
					$cumplimientoGrupal = Yii::app()->db->createCommand("select e.rut_trabajador as rut
																				,ifnull(COUNT(e.id_accidente),0) as sum from min_accidente e
																		join min_trabajador trab on trab.tra_rut=e.rut_trabajador
																		where 
																				e.acc_tipo_accidnte='Accidentes stp' ".$whereVariableGrupal."
																				".$wherePeriodo."
																		GROUP by 
																				e.rut_trabajador")->query()->readAll();


					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);		
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					
					//accidentes stp
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
				
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					break;
					
				case 'matriz de impacto':
				
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'exc_fecha');

					}else{
						$wherePeriodo = '';
					}
					
					$cumplimiento = Yii::app()->db->createCommand("select ifnull(count(e.exc_id),0) as cumplimiento from min_excesos_velocidad e where e.var_nombre='MATRIZ DE IMPACTO' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
					 //	echo "select ifnull(count(e.exc_id),0) as cumplimiento from min_excesos_velocidad e where e.var_nombre='MATRIZ DE IMPACTO' ".$whereVariable."";
					$cumplimientoGrupal = Yii::app()->db->createCommand("select e.tra_rut as rut
																				,ifnull(count(e.exc_id),0) as sum from min_excesos_velocidad e
																		join min_trabajador trab on trab.tra_rut=e.tra_rut
																		where 
																				e.var_nombre='MATRIZ DE IMPACTO' ".$whereVariableGrupalExcesos."
																				".$wherePeriodo."
																		GROUP by 
																				e.tra_rut")->query()->readAll();


					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);		
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					
					//matriz de impacto
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
				
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					break;
					
				case 'accidentes ctp (n° accidentes)':
					
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'fecha_accidente');

					}else{
						$wherePeriodo = '';
					}
					
					$cumplimiento = Yii::app()->db->createCommand("select ifnull(count(id_accidente),0) from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
					
					$cumplimientoGrupal = Yii::app()->db->createCommand("select e.rut_trabajador as rut,ifnull(count(id_accidente),0) as sum from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariableGrupal."
																		".$wherePeriodo."
																		GROUP by 
																				e.rut_trabajador")->query()->readAll();
					
					
				
					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);		
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					
					//accidentes ctp n° accidentes
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					
					break;
					
				case 'accidentabilidad':
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) &&  !empty($variablesEvaluacion[$i]['var_periodo']) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'fecha_accidente');

					}else{
						$wherePeriodo = '';
					}
					
					switch( $variablesEvaluacion[$i]['tmv_descripcion'] ){
						case 'N° de Accidentes CTP' :
							$cumplimiento = Yii::app()->db->createCommand("select ifnull(count(id_accidente),0) from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
							$cumplimientoGrupal = Yii::app()->db->createCommand("select e.rut_trabajador as rut,ifnull(count(id_accidente),0) as sum from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariableGrupal."
																		".$wherePeriodo."
																		GROUP by 
																				e.rut_trabajador")->query()->readAll();
							break;
						case 'Tasa de Accidentabilidad' :
							$cumplimiento = Yii::app()->db->createCommand("select 
																			( ifnull(count(id_accidente),0) / (
																												select count( tra_id )
																												from min_trabajador
																												where eess_rut = '".$eess."'
																											  ) 
																			) * 100
													 
																		from min_accidente e 
																		where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
	
							$cumplimientoGrupal = Yii::app()->db->createCommand("select 
																					e.rut_trabajador as rut,
																					( ifnull(count(id_accidente),0) / (
																												select count( tra_id )
																												from min_trabajador
																												where eess_rut = '".$eess."'
																											  ) 
																					) * 100 as sum 
																				from min_accidente e 
																				where 
																					e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariableGrupal."
																		".$wherePeriodo."
																		GROUP by 
																				e.rut_trabajador")->query()->readAll();
							break;
					}
					
					
					
					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);	
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
					
					//accidentabilidad
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					
					break;
					
				case 'siniestralidad':
					if( isset( $variablesEvaluacion[$i]['var_periodo'] ) &&  !empty($variablesEvaluacion[$i]['var_periodo']) ){				
						
						$wherePeriodo = filtroPeriodo($variablesEvaluacion[$i]['var_periodo'], $variablesEvaluacion[$i]['var_periodo_cantidad'], 'fecha_accidente');

					}else{
						$wherePeriodo = '';
					}
					
					switch( $variablesEvaluacion[$i]['tmv_descripcion'] ){
						case 'N° de Días Perdidos' :
							$cumplimiento = Yii::app()->db->createCommand("select ifnull(sum(DATEDIFF( IFNULL(e.fecha_alta,CURDATE()),e.fecha_accidente))+1,0) from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariable.$wherePeriodo." ")->queryScalar();
					
							
							$cumplimientoGrupal = Yii::app()->db->createCommand("select e.rut_trabajador as rut,ifnull(sum(DATEDIFF( IFNULL(e.fecha_alta,CURDATE()),e.fecha_accidente))+1,0) as sum from min_accidente e where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariableGrupal.$wherePeriodo."
																	GROUP by 
																			e.rut_trabajador")->query()->readAll();
						
							break;
						case 'Tasa de Siniestralidad' :
							$cumplimiento = Yii::app()->db->createCommand("select 
																			( ifnull(sum(DATEDIFF( IFNULL(e.fecha_alta,CURDATE()),e.fecha_accidente))+1,0) / (
																												select count( tra_id )
																												from min_trabajador
																												where eess_rut = '".$eess."'
																											  ) 
																			) * 100
													 
																		from min_accidente e 
																		where e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariable." ".$wherePeriodo."")->queryScalar();
	
							$cumplimientoGrupal = Yii::app()->db->createCommand("select 
																					e.rut_trabajador as rut,
																					( ifnull(sum(DATEDIFF( IFNULL(e.fecha_alta,CURDATE()),e.fecha_accidente))+1,0) / (
																												select count( tra_id )
																												from min_trabajador
																												where eess_rut = '".$eess."'
																											  ) 
																					) * 100 as sum 
																				from min_accidente e 
																				where 
																					e.acc_tipo_accidnte='Accidentes CTP' ".$whereVariableGrupal."
																		".$wherePeriodo."
																		GROUP by 
																				e.rut_trabajador")->query()->readAll();
																	
							break;
					}
					
					
					
					$notaFinal = calculoNotaEmpresa($nota, $cumplimiento);	
					
					$cumplimientoGrupal = calculoNotaIndividual($cumplimientoGrupal, $nota);
			
					
					//siniestralidad
					$trabajadores = asociarNotaTrabajador($trabajadores, $cumplimientoGrupal, $variablesEvaluacion[$i]['var_ponderacion']);
					
					$variablesEvaluacion[$i]['cumplimiento']=$cumplimiento;
					$variablesEvaluacion[$i]['cumplimientoGrupal']=$cumplimientoGrupal;
					$denominadorCalculado+=$variablesEvaluacion[$i]['var_ponderacion']/100;
					$variablesEvaluacion[$i]['denominadorCalculado']=$denominadorCalculado;
					
					
					break;
					
				
					
			}
			
			$variablesEvaluacion[$i]['cumplimientoAcumulado']=$trabajadores;
			$variablesEvaluacion[$i]['notaFinal']=$notaFinal;
		}

		for($q=0;$q<count($trabajadores);$q++){
			$trabajadores[$q]['nota']=$trabajadores[$q]['nota']/$denominadorCalculado;
			//echo $cumplimientoAcumulado[$q]['nota'].'<br>';
		}
		$rows2=$trabajadores;
		
		usort($rows2, 'ordenar_por_nota');
		
		function ordenar_por_nota($a, $b) {
		    return $a['nota'] > $b['nota'] ? 1 : -1;
		}
		
		//var_dump($arr);
		
		
		
		

if(count($rows2)==0){
	echo '<div class="alert alert-warning">Sin información</div>';
	return;
}
?>

	

	<div class="row" style="margin-bottom: 1em;">
		<div class="col-sm-9" style="float: left;">
	        <section class="panel" style="border-width:0px; margin: 0px; padding: 10px">
	            <div class="panel-heading fond-colortit" style="height:30px; color: black; text-align: center;">
	                <small class="font-bold">Ranking por Trabajador</small>
	            </div>
	            
	            	<div class="panel-body fond-color" style="color: black; overflow-x: scroll; padding-bottom: 0px;">
		                <div class="col-xs-12 col-md-12 no-padder">
		                	<?php
		                	$sql1 = Yii::app()->db->createCommand("SELECT 
		                												COUNT(DISTINCT t.tra_rut) as conteo 
		                											FROM min_trabajador t 
		                											JOIN min_evaluacion e on e.tra_rut=t.tra_rut
		                											WHERE 1 ".$where_evaluacion." ")->queryScalar();

	
		                	$width = 370+($sql1*100);
		                	?>
		                	<script>
								$(document).ready(function(){
									var test='Cantidad Evaluaciones: 1';
									var chart1 = AmCharts.makeChart("chartdiv023", {
									    "type": "serial",
									    "precision":1,
									    "theme": "light",
									    "marginRight": 50,
									    "titles": [
											
											/*
											{
												"id": "Title-2",
												"text": "COSECHA Y RALEO"
											}*/
											],
									  	"dataProvider": <?php
											$torta['#6e6d6d'] = 0; //gris
											$torta['#e14d57'] = 0; //rojo
											$torta['#f7e523'] = 0; //amarillo
											$torta['#4fbd5b'] = 0; //verde
								
											$limit1 = Yii::app()->params['LimiteNotaBaja'];
											$limit2 = Yii::app()->params['LimiteNotaMedia'];
											for($i=0;$i<count($rows2);$i++){
												$rows2[$i]['color'] = '#e14d57';
												$nota = floor($rows2[$i]['nota']);
												if($rows2[$i]['aplica']){
													if($nota>0 && $nota<=$limit1) $rows2[$i]['color'] = '#e14d57';
													if($nota>$limit1 && $nota<=$limit2) $rows2[$i]['color'] = '#f7e523';
													if($nota>$limit2 && $nota<=100)  $rows2[$i]['color'] = '#4fbd5b';
												} else {
													$rows2[$i]['color'] = "#6e6d6d";
												}
													$torta[$rows2[$i]['color']]++;
											}
								
											echo json_encode($rows2);
									  ?>,
									  "valueAxes": [{
									    "axisAlpha": 0,
									    "position": "left",
									    "title": "% Cumplimiento",
									    "minimum":0,
										"maximum":5,
										"strictMinMax": true,
										"autoGridCount": false,
									    "gridCount": 5,
									  },
									  ],
									  "startDuration": 1,
									  "listeners": [
										{
											"event": "clickGraphItem",
											"method": function(e) {
												alert(e.item.dataContext.rut);
											}
										}
									  ],
									  "graphs": [{
									    "balloonText": 
									    	"<b>Nota Promedio: [[value]] <br>  ",
									    "fillColorsField": "color",
                                        "balloonFunction": function(item, graph) {
                                            // console.log(item.dataContext);
                                            var result = graph.balloonText;
                                            var worker = item.dataContext;
                                            if (worker['aplica']){
                                                result = `  <b>Nota Promedio: ${worker['nota']}</b> <br>
                                                            <b>N° Evaluaciones: ${worker['contador']}</b>
                                                
                                                `;
                                                return result;
                                            }
                                            result = "Este trabajador no posee evaluaciones, se recomienda evaluar."
                                            return result;
                                        },
									    "fillAlphas": 0.9,
									    "lineAlpha": 0.2,
									    "type": "column",
									    "valueField": "nota",
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
									  "categoryField": "short_name",
									  "categoryAxis": {
									    "gridPosition": "start",
									    "labelRotation": 45,
									    "minHorizontalGap":1,
									    "fontSize": 8,
										"listeners":[
											{
												"event": "clickItem",
												"method": function(e) {
													alert("holi");
												}
											}
										],
									  },
									  "export": {
												"enabled": true,
												"divId": "exportdiv2",
												"menu": [{
													"id": "export-main1",
													"class": "export-main exportTrabajador",
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
							<div id="chartdiv023" style="background:#ffffff; width:<?php echo $width;?>px; height:400px; border:1px solid #dddddd;"></div>
							<!--<div id="seguimiento9" style="width:<?php echo $width;?>px; height: 185px;" ></div>-->
						</div>
					</div>
	            
	            
			</section>
		</div>


	<div class="col-sm-3" ;>
		<!--<div style="text-align: center;">
			<h5><strong>TRABAJADORES EVALUADOS <br /> POR NIVEL DE RIESGO <br /> </strong></h5>
			<span class="rounded" style="background-color: #EAEAEA;padding: 10px; margin-top: 20px;"><?php echo count($rows2)?></span>
		</div>-->
		<script>
		$(document).ready(function(){
			var chart2 = AmCharts.makeChart( "tortatrabajador", {
			  "type": "pie",
			  "theme": "none",
			  "labelsEnabled": true,
			  "labelRadius": -30,
			  "outlineAlpha": 0,
			  "startDuration": 0.5,
			  "startEffect": "easeOutSine",
	  		  //"labelText": "[[value]]<br>[[percents]] %",
			  "labelText": "[[value]] ",
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
				"valueText": "",
				"marginBottom": 10,
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
				"text": " TRABAJADORES EVALUADOS\nPOR NIVEL DE RIESGO\n"+<?php echo count($rows2)?>+"",
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
						"class": "export-main ",
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
		<div id="tortatrabajador" style="height:400px; background:#ffffff; padding:10px;  margin-top: 5px;">
			
		</div>
	</div>
		
</div>



<div class="col-sm-9" style="background:#ffffff;  border:1px solid #dddddd; padding: 20px;">
	<div class="text-center"> <strong>Cumplimiento por Variable</strong> </div>
	
	
	 <div id="graficoContainer">

    </div>
</div>

<?php

	 extract($_GET);
    include("conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');

    $k = 0;
	
	if(isset($_POST['filtro_tipo']) && $_POST['filtro_tipo'] !== ''){
  	$sql1 = "SELECT DISTINCT tem_id FROM min_respuesta as r JOIN min_evaluacion as e ON(r.eva_id = e.eva_id) WHERE 1 $where_evaluacion";
    $result1 = mysqli_query($mysqli, $sql1)or die (mysqli_error());  
    while($fila1 = $result1 ->fetch_assoc()){

 ?>

<div class="row" style="margin-bottom:30px;">
	<div class="col-sm-9">
		<script>
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
					"marginLeft": 250,
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
						"valueField": "Cumple",
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
								FROM min_evaluacion as e 
								JOIN min_respuesta as r ON(e.eva_id = r.eva_id)
								WHERE 1 ".$where_evaluacion." AND tem_id = '".$fila1['tem_id']."'
								GROUP BY res_enunciado";
					    $result2 = mysqli_query($mysqli, $sql2)or die (mysqli_error());  
					    while($fila2 = $result2 ->fetch_assoc()){
						echo '
						{
							"pregunta": "'.str_replace('"', '', $fila2['res_enunciado']).'",
							"item": "'.str_replace('"', '', $fila1['tem_id']).'",
							"Cumple": '.$fila2['S'].',
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
								FROM min_evaluacion as e 
								JOIN min_respuesta as r ON(e.eva_id = r.eva_id)
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
				"text": "<?php if ($fila3['N'] == 0 || $fila3['S'] == 0) { echo 0; }else{ echo (100-round(100*($fila3['N']/$fila3['S'])));}?> %",
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

// Parche categorías
if(isset($_POST['filtro_tipo'])){
	if($_POST['filtro_tipo'] == 'Motosierristas Cosecha y Raleo'){
		$rows[0]['eva_item_nombre_0'] = 'TOCONES';
	
		$rows[0]['eva_item_nombre_2'] = 'PLANIFICACIÓN';
		$rows[0]['eva_item_nombre_3'] = 'TRANSVERSAL';
		//$rows[0]['eva_fecha_evaluacion'] = 'FECHA EVALUACION';
	}
}


$hdrs = "";
/*for($j=0;$j<20;$j++){
	if(isset($rows[0]['eva_item_nombre_'.$j])) if($rows[0]['eva_item_nombre_'.$j] != '') $hdrs.= '<th>'.$rows[0]['eva_item_nombre_'.$j].'</th>';
}*/

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
	<th>RUT Trabajador</th>
	<th>Nombre completo</th>
	<th>Fecha Evaluacion</th>
	'.$hdrs.'
	<th>Porcentaje de Cumplimiento</th>
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
		<td><a href="index.php?r=evaluacion/view&id='.$rows[$i]['eva_id'].'" target="_blank">'.$rows[$i]['tra_rut'].'</a></td>
		<td><a href="index.php?r=evaluacion/view&id='.$rows[$i]['eva_id'].'" target="_blank">'.$rows[$i]['eva_nombres'].' '.$rows[$i]['eva_apellidos'].'</a></td>
		<td><a href="index.php?r=evaluacion/view&id='.$rows[$i]['eva_id'].'" target="_blank">'.$rows[$i]['eva_fecha_evaluacion'].'</a></td>
		'.$hdrs.'
		<td><div class="btn btn-'.$style.' btn-block btn-xs">'.floor($rows[$i]['eva_cache_porcentaje']).' %</div></td>
	</tr>
	';
}
echo '</table>'; 
} 
?>
<script id="valueToolTipTemplate" type="text/x-jquery-tmpl">
    <span class="tooltipSpan" style="background: rgb(230,230,230,0.74);color:#000000; padding:5px;font-weight: 700;">Nota: ${item.value}</span>
	<script type="text/javascript">
		 if (${item.value} < 3.5) {
		 	$(".tooltipSpan").css("border", "#E14D57 2px solid");
		  }else if(${item.value} >= 3.5 && ${item.value} <= 4.2){
		  	$(".tooltipSpan").css("border", "#F7E523 2px solid");
		  }else if(${item.value} > 4.2 && ${item.value} <= 5.0){
		  	$(".tooltipSpan").css("border", "#4FBD5B 2px solid");
		  }
		
	</script>
</script>
<script type="text/javascript">

	<?php 
		
	?>
	$(document).ready(function(){
		llenarGraficos();

		function llenarGraficos() {
			var variablesEvaluacion = <?php echo json_encode($variablesEvaluacion);?>;
			var cumplimiento = <?php echo json_encode($cumplimiento);?>;
			var cumplimientoAcumulado = <?php echo json_encode($trabajadores);?>;
			console.log(variablesEvaluacion);
			console.log('acumulado');
			console.log(cumplimientoAcumulado);
			var data=[];
			for(h=0;h<variablesEvaluacion.length;h++){

				variablesEvaluacion[h]["cumplimientoAcumulado"].forEach( trabajador => {
					console.log(trabajador);
				});

				var divTitle='<div><strong>'+variablesEvaluacion[h].var_nombre+'</strong></div>';
				var grafico='<div id="grafico'+h+'"></div>';
				$('#graficoContainer').append(divTitle);
				$('#graficoContainer').append(grafico);
				
				//guardo en un array los niveles de riesgo correspondientes a cada variable de evaluación
				var rangos=[];
				var valorMaximo=0;
				for(j=0;j<variablesEvaluacion[h].nivelRiesgo.length;j++){
					var rango={
							name: variablesEvaluacion[h].nivelRiesgo[j].nr_descripcion,
							startValue: variablesEvaluacion[h].nivelRiesgo[j].nr_desde,
							endValue: variablesEvaluacion[h].nivelRiesgo[j].nr_hasta,
							brush: variablesEvaluacion[h].nivelRiesgo[j].nr_color
					};
					rangos.push(rango);
					
				}
				if(variablesEvaluacion[h].var_tipo === 'definida'){
					valorMaximo=(Math.max.apply(Math, variablesEvaluacion[h].notas.map(function(o) { return o.var_not_cantidad; })))+1 ;
					console.log('valorMaximo');
					console.log(valorMaximo);
					console.log(variablesEvaluacion[h].var_meta);
					console.log(rangos);
					crearGrafico('#grafico'+h,variablesEvaluacion[h].var_meta,rangos,valorMaximo,variablesEvaluacion[h].notaFinal);
				}else{
					valorMaximo=Math.max.apply(Math, variablesEvaluacion[h].notas.map(function(o) { return o.var_not_rango_superior; }));
					crearGrafico('#grafico'+h,variablesEvaluacion[h].var_meta,rangos,valorMaximo,variablesEvaluacion[h].notaFinal);			
				}
				
				
				
				
			}
		}
		
		function crearGrafico(divId,targetValue,rangos,valorMaximo,notaEvaluacion2){

			$(divId).igBulletGraph({
	            height: "80px",
	            width: "100%",
	            interval:1,
	            //// Gets or sets the interval to use for rendering labels. This defaults to be the same interval as the tickmarks on the scale.
	            //labelInterval: 25000,
	            //// A value to start adding labels, added to the scale's MinimumValue.
	            //labelsPostInitial: 5000,
	            //// A value to stop adding labels, subtracted from the scale's MaximumValue.
	            //labelsPreTerminal: 4000,
	            //// Gets or sets the brush to use for the label font.
	            fontBrush: "#164F6D",
	            formatLabel: function (evt, ui) {
	                ui.label = ui.label;
	                if (ui.value != 90000000) {
	                    var re = /000$/;
	                    ui.label = ui.label.replace(re, " K");
	                }
	            },
	            alignLabel: function (evt, ui) {
	                // center the just the number part according to its tick, instead of centering the whole label
	                if (ui.value == 90000000) {
	                    ui.offsetX += 20;
	                }
	            },
	            ranges: [
	            	{
	                    name: "Riesgo Alto",
	                    startValue: 0,
	                    endValue: 3.5,
	                    brush: '#E05B64'
	               	},
	               	{
	                    name: "Riesgo Medio",
	                    startValue: 3.5,
	                    endValue: 4.2,
	                    brush: '#F8E839'
	               	},
	               	{
	                    name: "Riesgo Bajo",
	                    startValue: 4.2,
	                    endValue: 5,
	                    brush: '#61C46C'
	               	}
	            ],
	            maximumValue: 5,
	            targetValue: targetValue,
	            showToolTip: true,
	            valueToolTipTemplate: "valueToolTipTemplate",
	            value: notaEvaluacion2,
	            valueBrush: "white",
	            valueOutline: "white",
	            targetValueBrush: "white",
	            targetValueOutline: "white"
	        });  

		}
		
		
		
	});
	function cambioTrabajadores(id_cargo) {
			
			AmCharts.loadFile('graphsC/calibrador/calibrador/controlCalibracion.php?eess='+eess+'&calibrador='+calibrador, {}, function(data) {
			controlCalibracion.dataProvider = AmCharts.parseJSON(data);
			controlCalibracion.validateData();
			});
	}
</script>









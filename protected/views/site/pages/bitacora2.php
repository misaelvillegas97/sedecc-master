<?php
extract($_GET);
include("conexion.php");
mysqli_set_charset( $mysqli, 'utf8');
?>
<?php 
if (!isset($tipo)) {
	$style = 'display:none;';
	$tipo='';
}else{
	$style='';
}
 ?>
<p style="text-align: center; font-size: 40px;">Bitácora</p>

<!--COMENTADO BOTÓN CREAR A PETICIÓN DE DON EDUARDO(REGLAS DE NEGOCIO)
	<span style="float:right; margin-bottom: 10px; <?php echo $style;?>" id="spanOptions">
	<a title="Nuevo" href="index.php?r=site/page&view=bitacora2D&id=0&tipo=<?php echo $tipo;?>" id="aAdd"><img src="img/agregar.png" width="40px;"></a>
</span>-->
<style type="text/css">
	.swal2-popup {
  font-size: 1.6rem !important;
}
</style>
<script type="text/javascript"> 
function refrescar(opc) 
{ 
var x=document.getElementById("time"); 
t=x.options[x.selectedIndex].text; 
setTimeout("window.location='index.php?r=site/page&view=bitacora2&tipo="+opc+"'",t*1000); 
} 
</script> 

<?php 
if (isset($_POST['filtroTipo'])) {
	$tipo = $_POST['filtroTipo'];
}else{
	$tipo = '';
}
$where="";
$rut_eess='';
if(isset($_POST['filtro_empresa']) && $_POST['filtro_empresa'] !== '' ){
	$rut_eess=$_POST['filtro_empresa'];
	$_POST['filtro_eess']=$rut_eess;
	$where.= " AND eess_rut LIKE '%".$_POST['filtro_eess']."%' ";
}


//TO DO THIS

// Cuando el tipo de usuario es empresa
if(Yii::app()->controller->usertype() == 1){
	$_POST['filtro_eess'] = Yii::app()->user->id;
	if($_POST['filtro_eess'] != "") $where.= " AND e.eess_rut LIKE '%".$_POST['filtro_eess']."%' ";
}

// Cuando el tipo de usuario es evaluador
if(Yii::app()->controller->usertype() == 3){
	$eess = Yii::app()->db->createCommand("SELECT DISTINCT(eess_rut) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
	//AGREGADO DISTINCT JORGE IRAIRA
	$_POST['filtro_eess'] = $eess;
	if($_POST['filtro_eess'] != "") $where.= " AND e.eess_rut LIKE '%".$_POST['filtro_eess']."%' ";
}
//TO DO THIS
 ?>
 <div class="span-19">
 	<div id="content">
 		<span style="float:right;">
			<a class="btn btn-rounded btn-sm btn-icon btn-default" href="index.php?r=site/page&view=bitacora2"><i class="i i-list2"></i></a>
		</span>
 		<form method="post" style=" padding-bottom:20px; ">
		 <?php 
				if(Yii::app()->controller->usertype() == 2){	
			?>
			
			<div class="col-sm-3">
				<small>Empresa</small>
			<select  name="filtro_empresa" onchange="this.form.submit();" class="form-control input-sm" >
			<option value="">Seleccione una Empresa</option>
			<?php  
		
			$rows = Yii::app()->db->createCommand("SELECT * FROM min_eess WHERE eess_estado = 1 ORDER BY eess_nombre_corto ASC")->query()->readAll();
			for($i=0;$i<count($rows);$i++){
				if($rows[$i]['eess_rut'] == $rut_eess){
					$selected = "selected";
				}else{
					$selected = "";
				}
				
				echo '<option '.$selected.' value="'.$rows[$i]['eess_rut'].'">'.$rows[$i]['eess_nombre_corto'].'</option>';
			}
		
		    ?>
		             
				
			</select>
			</div>
			<?php 
				}			
			?>
			<div class="col-sm-3">
				Tipo
		<select  id="time" onchange="this.form.submit();"  class="form-control input-sm" name="filtroTipo"> 
			<option value="">Seleccione una Opcion</option>
			<?php 
			$myquery4 = "SELECT id, bit_nombre FROM min_formulario_bitacora e WHERE 1 ".$where." ";
			$resultado4 = $mysqli->query($myquery4);
			while($row4 = $resultado4 ->fetch_assoc()){
			?>
			<option value="<?php echo $row4['id']; ?>" <?php if ($row4['id'] == $tipo): ?> selected <?php endif ?>><?php echo $row4['bit_nombre']; ?></option>
			<?php 
			}
			?>
		</select>
		</div>
		</form>
        <div style="width: 20px;"></div>
		<?php if (isset($tipo)): ?>
			<div class="grid-view">
			  
			
			<table class="items table table-striped table-bordered table-hover" style="margin-top: 10px;background-color: white;">
				<thead style="background-color: #365fa0;color: white;">
				
					<?php 
					$contadorResultados=0;
					for ($i=1; $i <= 20; $i++) { 
		
						if ($i == 1) {
							$fecha_titulo = ', bd.bit_tiempo';
						}else{
							$fecha_titulo = '';
						}
		
						$myquery1 = "SELECT campo_".$i."_nombre as nombre ".$fecha_titulo."
									FROM min_bitacora_dinamica as bd
									JOIN min_formulario_bitacora as fb
									ON(bd.bit_formulario = fb.bit_nombre)
									WHERE bd.eess_rut LIKE '%".$rut_eess."%' AND fb.id = '$tipo' ";
						$resultado1 = $mysqli->query($myquery1);
						$row1 = $resultado1 ->fetch_assoc();
						if ($row1['nombre'] != NULL) {
							if ($i == 1) {
								echo '<tr>';
								echo '<th  width="400">Fecha</th>';
							}						
							echo '<th  width="400">'.$row1['nombre'].'</th>';
							$contadorResultados++;
						}
					}
					if($contadorResultados>0){
						echo '<th  style="width:118px!important;">&nbsp; </th>';
						echo '</tr>';
					}
					
					
					?>
				</tr>
				</thead>
				<tbody>
				<?php 
				$myquery2 = "SELECT bit_id
									FROM min_bitacora_dinamica as bd
									JOIN min_formulario_bitacora as fb
									ON(bd.bit_formulario = fb.bit_nombre)
									WHERE bd.eess_rut LIKE '%".$rut_eess."%' AND fb.id = '$tipo'";
				$resultado2 = $mysqli->query($myquery2);
				while($row2 = $resultado2 ->fetch_assoc()){
					echo '<tr>';
					for ($i=1; $i <= 20; $i++) {
		
						if ($i == 1) {
							$fecha_valor = ', bit_tiempo';
						}else{
							$fecha_valor = '';
						}
		
						$myquery3 = "SELECT campo_".$i."_valor as valor,bit_id,bit_formulario".$fecha_valor." FROM min_bitacora_dinamica WHERE bit_id = '".$row2['bit_id']."'";
						$resultado3 = $mysqli->query($myquery3);
						$row3 = $resultado3 ->fetch_assoc();
						if ($row3['valor'] != NULL) {
							if ($i == 1) {
								echo '<td width="400">'.$row3['bit_tiempo'].'</td>';
							}		
						echo '<td>'.$row3['valor'].'</td>';
						}
					}
					echo '<td class="button-column" style="60px !important;">';
					echo '<a title="Modificar" href="index.php?r=site/page&view=bitacora2D&id='.$row3['bit_id'].'&tipo='.$row3['bit_formulario'].' "><img src="/sedecc/assets/94f94605/gridview/update.png" alt="Update"></a>';
					echo '<a class="trash btnEliminar" title="Eliminar" href="#" id="'.$row3['bit_id'].'"><img src="/sedecc/assets/94f94605/gridview/delete.png" alt="trash"></a>';
					echo '</td> ';
					echo '</tr>';
				}
					?>
				</tbody>
			</table>
			</div>
 		
 	</div>
 </div>
 
	  <script src="js/jquery.min.js"></script> 
	  <script src="js/bootstrap.js"></script>
<script src="js/bitacoraDinamica.js"></script>
<script type="text/javascript" src="/sedecc/assets/94f94605/gridview/jquery.yiigridview.js"></script>
<script src="js/sweetalert2.all.js"></script>
<?php endif ?>
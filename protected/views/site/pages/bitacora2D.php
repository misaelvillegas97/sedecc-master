
<?php 

extract($_GET);
if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}

include("conexion.php");
mysqli_set_charset( $mysqli, 'utf8');

if ($id != 0) {
	$myquery = "SELECT *, date_format(reu_tiempo, '%d-%m-%Y') as fechaE 
			FROM min_reunion as r
			JOIN min_eess as es ON(r.eess_rut = es.eess_rut)
			JOIN min_trabajador as t ON(r.reu_evaluador = t.tra_rut)
			WHERE reu_id = $id";

	$resultado = $mysqli->query($myquery);
	$row = $resultado ->fetch_assoc();
	$action='bitacoraDinamicaGrabar.php';

}else{
	$action='bitacoraDinamicaCrear.php';
}


?>

	<link rel="shortcut icon" type="image/x-icon" href="http://innoapsion.cl/terreno/favicon.ico"/>
	<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/mio.css" type="text/css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="css/icon.css" type="text/css" />
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link rel="stylesheet" href="css/app.css" type="text/css" />  

<style type="text/css">
	body {
		font: small "Trebuchet MS";
	}

	#disclaimer {
		background-color: #fafafa;
		padding: 1em;
		border: 3px double #ccc;
	}

	/*************************/
	/* Necesario para que se muestre bien los nuevos elementos agregados */

	.file {
		display: block;
	}

	span a {
		margin-left: 1em;
	}

	/*************************/
	.borInp2{
	padding: 8px;
	background-color:#12131a;
	color: #edf4f7;
	text-align: center;
	width: 100%;
	height: 30px auto;
	}

	.tittlecolor{
		color: #84898f;
	}

	.mrgn{
		margin-top: 5px !important;
	}

	.mrgnrow{
		margin-top: 5px;
	}
</style>
          
 <div class="span-19">
 	<div id="content">
 		<span style="float:right;">
			<a class="btn btn-rounded btn-sm btn-icon btn-default" href="index.php?r=site/page&view=bitacora2"><i class="i i-list2"></i></a>
		</span>
		<h1>Editar Bitácora</h1>
		<section class="panel panel-default">
			<div class="panel-body">
				<div class="bs-example form-horizontal">
					<div class="row container-fluid" >
						<form name="formulario" id="formulario" action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
						<div class="col-md-12 " style="margin-top: 20px;">
		
							<?php 
								if ($id==0) {
									$myquery1 = "SELECT bit_n_campos,bit_nombre_campos
													FROM min_formulario_bitacora mfb
													WHERE mfb.id =".$tipo." ";
									$resultado1 = $mysqli->query($myquery1);
									$row1 = $resultado1 ->fetch_assoc();
									$nCampos=$row1['bit_n_campos'];
									$campos=$row1['bit_nombre_campos'];
									$campo=explode(",", $campos);
									$fecha= date('Y-m-d\TH:i:s');
									echo '<div class="row"><div class="col-md-5 form-group" style="margin-left:10px;"> Fecha:</div><div class="col-md-6 form-group" > 
									<input type="datetime-local" class="form-control inputs" id="txtFecha" name="input[]"  placeholder="Fecha" value="'.$fecha.'">
									<input type="hidden" class="form-control inputs" id="txtIdBitacora" name="idBitacora" value="0">
									<input type="hidden" class="form-control inputs" id="txtTipoFormulario" name="tipo" value="'.$tipo.'"></div></div>';
									for($i=1; $i <= $nCampos; $i++) {
										echo '<div class="row" ><div class="col-md-5 form-group" style="margin-left:10px;">'.$campo[$i-1].':</div><div class="col-md-6 form-group" ><input type="text" class="form-control inputs"  name="input[]"  placeholder="'.$campo[$i-1].'" "></div></div>';
									}
								}else{
									for ($i=1; $i <= 20; $i++) { 
		
										if ($i == 1) {
											$fecha_titulo = ', bd.bit_tiempo';
										}else{
											$fecha_titulo = '';
										}
			
										$myquery1 = "SELECT campo_".$i."_valor as valor,campo_".$i."_nombre as nombre ".$fecha_titulo."
													FROM min_bitacora_dinamica as bd
													JOIN min_formulario_bitacora as fb
													ON(bd.bit_formulario = fb.bit_nombre)
													WHERE bd.bit_id = '$id'";
										$resultado1 = $mysqli->query($myquery1);
										$row1 = $resultado1 ->fetch_assoc();
										if ($row1['nombre'] != NULL) {
											if ($i == 1) {
												//$fecha= date('Y-m-d\TH:i:s', strtotime($row['bit_tiempo']));
												$fecha= date('Y-m-d\TH:i:s', strtotime($row1['bit_tiempo']));
												echo '<div class="row"><div class="col-md-5 form-group" style="margin-left:10px;"> Fecha:</div><div class="col-md-6 form-group" > 
												<input type="datetime-local" class="form-control inputs" id="txtFecha" name="input[]"  placeholder="Fecha" value="'.$fecha.'">
												<input type="hidden" class="form-control inputs" id="txtIdBitacora" name="idBitacora" value="'.$id.'"> 
												<input type="hidden" class="form-control inputs" id="txtTipoFormulario" name="tipo" value="'.$tipo.'">
												</div></div>';
												//echo '<div class="row"><div class="col-md-5 form-group" style="margin-left:10px;"> Fecha:</div><div class="col-md-6 form-group" > <input type="text" class="form-control inputs" id="txtFecha" name="input[]"  placeholder="Fecha" value="'.$row['bit_tiempo'].'"><input type="hidden" class="form-control inputs" id="txtIdBitacora" name="idBitacora" value="'.$id.'"></div></div>';
											}						
										echo '<div class="row" ><div class="col-md-5 form-group" style="margin-left:10px;">'.$row1['nombre'].':</div><div class="col-md-6 form-group" ><input type="text" class="form-control inputs" id="txtFecha" name="input[]"  placeholder="Fecha" value="'.$row1['valor'].'"></div></div>';
										}
									}
								}
								
		
							?>

											<div class="col-md-6 col-md-offset-5 form-group">
												<button type="button" class="btn btn-success inputs pull-right" id="btnGrabar" name="btnGrabar" value="<?php echo $id?>" ><span class="fa fa-save"></span> Grabar</button>
											</div>
						</div>
					</form>
						
					</div>
				</div>
			</div>
		</section>
 	</div>
 </div>
<div class="container-fluid">
	
</div>




   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="js/jquery.min.js"></script> 
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="js/app.plugin.js"></script>
  <!--<script src="bootstrap/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>-->
  <script src="js/main.js"></script>
  <script src="js/bootstrap-notify.min.js"></script>
    
  <script src="js/alertify.js"></script>
  <script src="js/filtro.js"></script>
  <script src="js/bitacoraDinamica.js"></script>


<script type="text/javascript">
	
var numero = 0;

// Funciones comunes
c= function (tag) { // Crea un elemento
   return document.createElement(tag);
}
d = function (id) { // Retorna un elemento en base al id
   return document.getElementById(id);
}
e = function (evt) { // Retorna el evento
   return (!evt) ? event : evt;
}
f = function (evt) { // Retorna el objeto que genera el evento
   return evt.srcElement ?  evt.srcElement : evt.target;
}

addField = function (num) {
   container = d('files'+num);
   
   span = c('SPAN');
   span.className = 'file';
   span.id = 'file' + (++numero);
   span.style = 'height: 25px;';
   

   field = c('INPUT');   
   field.name = 'archivos'+num+'[]';
   field.type = 'file';
   field.required = 'true';
   field.multiple = 'true';
   field.style = 'float:left;';
   field.onchange = function() {
    control(this);
	}
   

   a = c('A');
   a.name = span.id;
   a.href = '#';
   a.onclick = removeField;
   a.innerHTML = 'Quitar';
   

   span.appendChild(field);
   span.appendChild(a);
   container.appendChild(span);
}

removeField = function (evt) {
   lnk = f(e(evt));
   span = d(lnk.name);
   span.parentNode.removeChild(span);
}
</script>

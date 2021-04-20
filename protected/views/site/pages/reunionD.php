
<?php 

extract($_GET);
if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}

include("conexion.php");
mysqli_set_charset( $mysqli, 'utf8');

$myquery = "SELECT *, date_format(reu_tiempo, '%d-%m-%Y') as fechaE 
			FROM min_reunion as r
			JOIN min_eess as es ON(r.eess_rut = es.eess_rut)
			JOIN min_trabajador as t ON(r.reu_evaluador = t.tra_rut)
			WHERE reu_id = $id";

$resultado = $mysqli->query($myquery);
$row = $resultado ->fetch_assoc();

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

          
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="row" >
				<span style="float:right; margin-top: 20px;">
					<a title="Volver al listado" href="index.php?r=site/page&view=reunion"><img src="img/list.png" width="40px;"></a>
					<a title="Exportar PDF" target="_blank" href='Informes/InformeT.php?id=<?php echo $id; ?>'><img src="img/pdf.png" width="40px;"></a>
				</span>

			</div>
			<section style="margin-left: 30px; margin-right: 30px; margin-top: 5px; margin-bottom: 30px; background-color: white;">
	
			<div  id="exportdiv12" class="col-md-12 borInp2" style="background-color: #365fa0;color: white;">Actividad</div>


			<div class="row" >
				<div class="col-md-12 mrgnrow">
					<div class=" form-group">
						<div class="col-md-4 ">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Rut EESS</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<input class="form-control" type="text" name="" value="<?php echo $row['eess_rut']; ?>" disabled>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">ID</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['reu_correlativo']; ?>" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Nombre EESS</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['eess_razon_social']; ?>" disabled>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Fecha Evento/Reunion</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['fechaE']; ?>" disabled>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Representante Legal/Gerente</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['eess_representante']; ?>" disabled>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Ubicación</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name=""  value="<?php echo $row['reu_lugar']; ?>" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Asesor (APR)</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['eess_apr']; ?>" disabled>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Area</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['reu_area']; ?>" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Jefe de Area</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['reu_jefe_area']; ?>" disabled>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Georeferencia</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['reu_geo_x'].' , '.$row['reu_geo_y']; ?>" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Gerente Operaciones</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['reu_gerente_operaciones']; ?> " disabled>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Ejecutor de la Actividad</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['tra_nombres'].' '.$row['tra_apellidos']; ?>" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12 mrgn">
									 <span class="tittlecolor">Participantes</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									 <input class="form-control" type="text" name="" value="<?php echo $row['reu_participantes']; ?>" disabled>
								</div>
							</div>
						</div>
						<?php if (strlen($row['reu_foto']) > 30) { ?>
						<div class="col-md-4">
							<div style="width: 50px; float: left;">
								<div class="row">
									<div class="col-md-12">
										<a data-toggle="modal" data-target="#myModal_foto" class="btn btn-rounded btn-md btn-icon btn-default">
											<i class="fa fa-camera large"></i>
										</a>
										<!-- Modal -->
										<div class="modal fade" id="myModal_foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog modal-lg" style="height: 90%;" role="document">
												<div class="modal-content" style="height: 90%;">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
														<h4 class="modal-title" id="myModalLabel" align="center">Imagen adjunta</h4>
													</div>
													<div class="modal-body" style="height:80%" align="center">
														<img src="<?php echo $row['reu_foto']; ?>" style="width:80%; height:100%;" data-toggle="modal" data-target="#myModal_foto">	
													</div>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->

										<?php /*<img src="<?php echo $row4['img_foto']; ?>" style="height: 100px; width: 100px;"> */ ?>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mrgn">
					<label class="tittlecolor">Descripcion del Evento/Reunion</label>
				</div>
				<div class="col-md-12">
					<textarea style="max-width: 100%; min-width: 100%; min-height: 60px;" disabled> <?php echo $row['reu_descripcion'] ?></textarea>
				</div>
			</div>
		</section>
			<?php 

			$myquery = "SELECT * FROM min_reunion_acuerdo where reu_id = $id";

			$resultado = $mysqli->query($myquery);
			
			while($row2 = $resultado ->fetch_assoc()){
				$acu_id = $row2['acu_id'];
				$today = date("Y-m-d"); //$today = date("Y-m-d H:i");

				if ($row2['acu_seguimiento'] == 0 and $row2['acu_plazo'] < $today) {
					$semaforo = "<img style='height:25px;' src='images/semaforo_rojo.png'>";
				}else if ($row2['acu_seguimiento'] == 0 and $row2['acu_plazo'] >= $today) {
					$semaforo = "<img style='height:25px;' src='images/semaforo_amarillo.png'>";
				}else if ($row2['acu_seguimiento'] == 1) {
					$semaforo = "<img style='height:25px;' src='images/semaforo_verde.png'>";
				}
			 ?>
			<section style="margin: 30px; background-color: white;">
			<div  id="exportdiv12" class="col-md-12 borInp2" style="background-color: #365fa0;color: white;">Acuerdos</div>
			<div class="form-group">
				<div class="col-md-7 mrgnrow">
					<div class="row">
						<div class="col-md-12 mrgn">
							<label class="tittlecolor">Acuerdos</label>
						</div>
						<div class="col-md-12">
							<p><?php echo $row2['acu_descripcion'] ?></p>
						</div>
					</div>
				</div>
				<div class="col-md-3 mrgnrow">
					<div class="row">
						<div class="col-md-12 mrgn">
							<label class="tittlecolor">Plazo</label>
						</div>
						<div class="col-md-12">
							<input class="form-control" type="date" name="" value="<?php echo $row2['acu_plazo'] ?>" disabled>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="row">
						<div class="col-md-12 mrgn">
							<label class="tittlecolor">Seguimiento</label>
						</div>
						<div class="col-md-12">
							<?php echo $semaforo; ?>
						</div>
					</div>
				</div>

			</div>
			<form name="formulario" action="insertMensaje.php" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-7">
					<div class="form-group">
						<div class="col-md-12 mrgn">
							<label class="tittlecolor">Respuesta EESS</label>
							<input type="hidden" name="acu_id" value="<?php echo $acu_id; ?>" >
							<input type="hidden" name="id_ar" value="<?php echo $id; ?>" >

						</div>
						<div class="col-md-12">
							<textarea style="max-width: 100%; min-width: 100%; min-height: 40px;" name="mensaje" required></textarea>
							<!-- <input type="file" name="file"> -->
							<!-- <dt><label>Archivos Adjuntos:</label>&nbsp;&nbsp;&nbsp;<a href="#" onclick="addField(<?php echo $acu_id; ?>)" accesskey="5">A&ntilde;adir Archivo</a></dt> -->

							<dt><label>Archivos Adjuntos:</label>&nbsp;&nbsp;&nbsp;<input type="button" title="Presionar una o mas veces segun la cantidad de archivos que necesite cargar." name="btn_add" value="Añadir Archivo" onclick="addField(<?php echo $acu_id; ?>)" accesskey="5" style="background-color: #e3e1e3; color: #12131a;"></dt>
							<dd><div id="files<?php echo $acu_id; ?>" required></div></dd>
						</div>
					</div>
				</div>
				<div class="col-md-5 mrgn">
					<div class="row">
						<div class="col-md-12" style="height: 20px;">
							
						</div>
						<div class="col-md-12">
							<input class="btn btn-sm btn-default" type="submit" value="Desaprobar" style="padding-left: 30px; padding-right: 30px; padding-top: 5px; padding-bottom: 5px; " >
						</div>
					</div>
				</div>
				<?php 

				$myquery3 = "SELECT * FROM min_reunion_mensaje where acu_id = ".$row2['acu_id'];

				$resultado3 = $mysqli->query($myquery3);
				
				while($row3 = $resultado3 ->fetch_assoc()){

					$myquery5 = "SELECT eess_logo FROM min_eess WHERE eess_rut = '".$row['eess_rut']."'";
            		$resultado5 = $mysqli->query($myquery5);
            		$row5 = $resultado5 ->fetch_assoc();

            		if ($row3['ms_tipo'] == 1) {
					  //$color = '#DCDCDC';
					  $logo = "<img src='images/logo2-chat.gif' style='width: 10mm'>";
					}else{
					  //$color = '#edf4f7';
					  $logo = "<img src='".$row5['eess_logo']."' style='width: 10mm'>";
					}
				 ?>
				<div class="col-md-7">
					<div class="row">
						<div class="col-md-1">
							<?php echo $logo; ?>
						</div>
						<div class="col-md-11" style="padding-left: 0px; ">
							<textarea style="max-width: 100%; min-width: 100%; min-height: 40px;" name="mensaje" disabled><?php echo $row3['ms_mensaje']; ?></textarea>
						</div>
					</div>
				</div>
				<?php 
				$myquery4 = "SELECT *, LEFT(img_foto,10) as img FROM min_reunion_imagen where ms_id = ".$row3['ms_id'];

				$resultado4 = $mysqli->query($myquery4);
				$num = 1;
				while($row4 = $resultado4 ->fetch_assoc()){

				if ($row4['img'] == 'data:image') {
						//$download = '<button id="descarga" name="descarga" onclick="dlDataUrlBin2('.$num.')">Descarga</button>';
						//$input = '<input type="hidden" id="texto2'.$num.'"" value="'.$filamensaje['imagen'].'"></input>';

						$imgpdf = '<img src="'.$row4['img_foto'].'" style="width:80%; height:100%;" data-toggle="modal" data-target="#myModal_imagen'.$row3['ms_id'].$num.'">';
						//$imgpdf = '<iframe src="'.$row4['img_foto'].'" style="width:80%; height:100%;" data-toggle="modal" data-target="#myModal_imagen'.$row3['ms_id'].$num.'"></iframe>';
						
						$icon = '<i class="fa fa-camera large"></i>';
					}elseif($row4['img'] == 'data:appli'){
						//$download = '';
						//$input = '';
						$imgpdf = '<embed  src="'.$row4['img_foto'].'" style="width:80%; height:100%;" data-toggle="modal" data-target="#myModal_imagen'.$row3['ms_id'].$num.'"></embed>';
						$icon = '<img src="images/pdf-m2.jpg" style="height: 20px;">';
					}
					
				 ?>
				<div style="width: 50px; float: left;">
					<div class="row">
						<div class="col-md-12">
							<a data-toggle="modal" data-target="#myModal_imagen<?php echo $row3['ms_id'].$num; ?>" class="btn btn-rounded btn-md btn-icon btn-default">
								<?php echo $icon; ?>
							</a>
							<!-- Modal -->
							<div class="modal fade" id="myModal_imagen<?php echo $row3['ms_id'].$num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog modal-lg" style="height: 90%;" role="document">
									<div class="modal-content" style="height: 90%;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel" align="center">Imagen adjunta</h4>
										</div>
										<div class="modal-body" style="height:80%" align="center">
											<?php echo $imgpdf; ?>
											
										</div>

									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

							<?php /*<img src="<?php echo $row4['img_foto']; ?>" style="height: 100px; width: 100px;"> */ ?>
						</div>
					</div>
				</div>
				<?php 
				$num++;
				}
				}
				?>
				
			</div>
			</form>
			</section>
			
			<?php 
			$acu_id++;
			}
			?>
		</div>
	</div>
</div>




  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="js/app.plugin.js"></script>
  <!--<script src="bootstrap/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>-->
  <script src="js/main.js"></script>
    
  <script src="js/alertify.js"></script>
  <script src="js/filtro.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="js/jquery.table2excel.js"></script>

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
 
<script type="text/javascript">
	function control(f){
		var ext=['gif','jpg','jpeg','png','pdf'];
		var v=f.value.split('.').pop().toLowerCase();
		for(var i=0,n;n=ext[i];i++){
		if(n.toLowerCase()==v)
		return
		}
		var t=f.cloneNode(true);
		t.value='';
		f.parentNode.replaceChild(t,f);
		alert('La extensión del archivo no es válida, subir solo en formato de imagen');
	}
</script>
<script type="text/javascript">
	function dlDataUrlBin2(b){
		var valor2 = document.getElementById("texto2"+b).value;
		download(valor2, "Descarga.jpeg", "image/");
	}
</script>

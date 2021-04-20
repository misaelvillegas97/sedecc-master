<?php 
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/sedecc/Classes/PHPExcel.php');
	require_once('Classes/PHPExcel/Reader/Excel2007.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/sedecc/Classes/PHPExcel/IOFactory.php');
?>

<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this ExcesosVelocidadController */
			/* @var $model ExcesosVelocidad */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'excesos-velocidad-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),
			)); ?>
			<!--
			<p class="note">Los campos que contienen <span class="required">*</span> son obligatorios.</p>
			
			<!--?php echo $form->errorSummary($model); ?-->
		
						<!--<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'tra_rut'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'tra_rut',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'tra_rut'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'exc_fecha'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'exc_fecha',array('class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'exc_fecha'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'exc_zona'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'exc_zona',array('class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'exc_zona'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'veh_patente'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'veh_patente',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'veh_patente'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'exc_velocidad'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'exc_velocidad',array('class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'exc_velocidad'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'exc_limite'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'exc_limite',array('class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'exc_limite'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'veh_codigoCamion'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'veh_codigoCamion',array('class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'veh_codigoCamion'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php //echo $form->labelEx($model,'exc_turno'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php //echo $form->textField($model,'exc_turno',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php //echo $form->error($model,'exc_turno'); ?>
			    </div>
			</div>-->
			
	        <!--<input type='submit' name='enviar'  value="Importar" />
	        
	        
						<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default')); ?>
				</div>
			</div>-->
			<?php $this->endWidget(); 
			$dir = 'files/';
			//$url = 'index.php?r=eess/update&id='.$_GET['id'];
			if(!file_exists($dir)) mkdir($dir, 0777, true);?>
			
			<form enctype="multipart/form-data" method="post">
			<div class="container-fluid">
				<div class="row ">
					<div class="col-lg-4">
						<label for="">Tipo : </label>
						<select class="form-control" id="variable" name="variable" required>
							<?php
								$eess= '';
								if(Yii::app()->controller->usertype() == 1){
									$eess = Yii::app()->user->id;
									$rows = Yii::app()->db->createCommand("SELECT * FROM min_modulo_variable mv
																			join min_modulo_variable_detalle mvd on mvd.mv_id= mv.mv_id
																			join min_variable_evaluacion ve on ve.var_id= mvd.var_id
																			WHERE 
																				mv.eess_rut = '".Yii::app()->user->id."' 
																				and mv.mv_descripcion='Excesos de velocidad' ")->query()->readAll();
								}
								else if(Yii::app()->controller->usertype() == 3){
									$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
									$rows = Yii::app()->db->createCommand("SELECT * FROM min_modulo_variable mv
																			join min_modulo_variable_detalle mvd on mvd.mv_id= mv.mv_id
																			join min_variable_evaluacion ve on ve.var_id= mvd.var_id
																			WHERE mv.eess_rut = '".$eess."' 
																			and mv.mv_descripcion='Excesos de velocidad'")->query()->readAll();
								}	
								
								
								echo '<option value="0" selected>Seleccionar</option>';
								for($i=0;$i<count($rows);$i++){

									echo '<option value="'.$rows[$i]['var_nombre'].'">'.$rows[$i]['var_nombre'].'</option>';
								}
							?>
						</select>
					
					</div>
							
					<style>
						.btn-file {
							position: relative;
							overflow: hidden;
						}
						.btn-file input[type=file] {
							position: absolute;
							top: 0;
							right: 0;
							min-width: 100%;
							min-height: 100%;
							font-size: 100px;
							text-align: right;
							filter: alpha(opacity=0);
							opacity: 0;
							outline: none;
							background: white;
							cursor: inherit;
							display: block;
						}
					</style>
					<div class="col-lg-5 col-md-6">
						<label for="">Registro de jornada: </label>
						<div class="input-group">
							<label class="input-group-btn">
								<span class="btn btn-primary">
									Seleccionar archivo <input type="file" style="display: none;" id="jornada" name="jornada" accept=".xlsx,.xls" required>
								</span>
							</label>
							<input type="text" class="form-control" readonly>
						</div>
					</div>
					<script>
						// We can attach the `fileselect` event to all file inputs on the page
						$(document).on('change', ':file', function() {
							var input = $(this),
								numFiles = input.get(0).files ? input.get(0).files.length : 1,
								label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
							input.trigger('fileselect', [numFiles, label]);
						});
						// We can watch for our custom `fileselect` event like this
						$(document).ready( function() {
							$(':file').on('fileselect', function(event, numFiles, label) {

								var input = $(this).parents('.input-group').find(':text'),
									log = numFiles > 1 ? numFiles + ' files selected' : label;

								if( input.length ) {
									input.val(log);
								} else {
									if( log ) alert(log);
								}

							});
						});
					
					</script>
					<!-- <div class="col-lg-4">
						<label for="">Registro de jornada: </label>
						<input type="file" name="excesos" accept=".xlsx,.xls"  required />
					</div> -->
				</div>
				<div class="row">
					<div class="col-lg-5 col-md-6 col-md-offset-4">
						<label for="">Excesos : </label>
						<div class="input-group">
							<label class="input-group-btn">
								<span class="btn btn-primary">
									Seleccionar archivo <input type="file" style="display: none;" id="excesos" name="excesos" accept=".xlsx,.xls" required>
								</span>
							</label>
							<input type="text" class="form-control" readonly>
						</div>
					</div>
				</div>
						
					<div class="row">
						<button type="submit" onclick="return validate()" class="btn btn-sm btn-default" style="float: right; background-color: #f8b53d; color: white !important; padding-top: 7px; padding-bottom: 7px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Grabar</button>
						<script> 
							function validate() {
								if( document.getElementById("variable").value == 0){
									alert("Para poder continuar, seleccione un tipo.");
									return false;
								}

								if( document.getElementById("excesos").files.length == 0 || document.getElementById("jornada").files.length == 0 ){
									alert("Para poder completar la acción, suba todos los archivos solicitados.");
									return false;
								}
							}
						</script>
					</div>
				</div>
				
				
				<!--<input type="hidden" value="upload" name="action" />-->
			</form>
			<?php
				//var_dump($_FILES);
				if (!empty($_FILES)){
					// Subir
			
					$model=new ExcesosVelocidad;
					
					try {
					    if(isset($_FILES['jornada'])){
							//var_dump($_FILES);
							$destino='';
							$flagJornada= true;
							

							//$uploadfile = $dir.substr(md5(microtime()),1,8).basename($_FILES['file']['name']);
							//$uploadfile = $dir.$_FILES['excel']['name'];
							$archivo = $_FILES['jornada']['name'];
							$destino = $dir."bak_" . $archivo;
							
							$textoInfo = '';

							
							if (copy($_FILES['jornada']['tmp_name'], $destino)) {
								
								$textoInfo .= 'Archivo subido correctamente <br/>';

								//return;
							} else {
								
								$textoInfo .= 'Error al subir archivo <br/>';
								return;
							}
							

	
				            if (file_exists($dir."bak_" . $archivo)) {
				                /** Clases necesarias */
				                
				                
				                
				                $inputFileType = PHPExcel_IOFactory::identify($dir."bak_" . $archivo);
							    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
							    $objPHPExcel = $objReader->load($dir."bak_" . $archivo);
				
				                // Cargando la hoja de cálculo
				                /*$objReader = new PHPExcel_Reader_Excel2007();
				                $objPHPExcel = $objReader->load($dir."bak_" . $archivo);
				                $objFecha = new PHPExcel_Shared_Date();*/
				
				                // Asignar hoja de excel activa
				                $objPHPExcel->setActiveSheetIndex(0);
				
				                //$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
				                $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				
				                //conectamos con la base de datos 
				                //$cn = mysql_connect("localhost", "innoapsi_sebasti", "sebastian102938") or die("ERROR EN LA CONEXION");
				                      //mysql_query("SET CHARACTER SET utf8"); 
							          //mysql_query("SET NAMES utf8"); 
				                //$db = mysql_select_db("innoapsi_sebastian", $cn) or die("ERROR AL CONECTAR A LA BD");
				
				                // Llenamos el arreglo con los datos  del archivo xlsx
				                //$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				                for ($i = 6; $i <= $highestRow; $i++) {
				                    $datosJornada[$i]['tra_rut'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
				                    $datosJornada[$i]['nombre'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
				                    $datosJornada[$i]['inicioJornada'] = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue(), 'YYYY/MM/DD hh:mm:ss'); 
				                    //$datosJornada[$i]['inicioJornada'] = date('d-m-Y H:i', PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue()));
				                    $datosJornada[$i]['terminoJornada'] = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue(), 'YYYY/MM/DD hh:mm:ss'); 
				                    $datosJornada[$i]['patente'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
				                    	                
				                }
								//var_dump($datosJornada);
								
								if(isset($_FILES['excesos'])){
									
									$destinoExcesos='';	
							

									//$uploadfile = $dir.substr(md5(microtime()),1,8).basename($_FILES['file']['name']);
									//$uploadfile = $dir.$_FILES['excel']['name'];
									$archivo = $_FILES['excesos']['name'];
									$destinoExcesos = $dir."bak_" . $archivo;

									if (copy($_FILES['excesos']['tmp_name'], $destinoExcesos)) {
										// do something to show
									} 
									
									$inputFileType = PHPExcel_IOFactory::identify($dir."bak_" . $archivo);
									$objReader = PHPExcel_IOFactory::createReader($inputFileType);
									$objPHPExcel = $objReader->load($dir."bak_" . $archivo);

									// Cargando la hoja de cálculo
									/*$objReader = new PHPExcel_Reader_Excel2007();
									$objPHPExcel = $objReader->load($dir."bak_" . $archivo);
									$objFecha = new PHPExcel_Shared_Date();*/

									// Asignar hoja de excel activa
									$objPHPExcel->setActiveSheetIndex(0);

									//$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
									$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
									
									$tolerancia= Yii::app()->db->createCommand("SELECT ifnull(var_tolerancia,0) FROM min_variable_evaluacion WHERE var_nombre = '".$_POST['variable']."'  and eess_rut ='".$eess."' ")->queryScalar();
									$excesosSinJornada='';
									 for ($i = 3; $i <= $highestRow; $i++) {
									 			
									 		
									 	$velocidad = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
										$limite = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
										
									 	if( ($limite + $tolerancia) < $velocidad ){
											//echo 'entro '.$i;
											//echo '<br>';
									 		
											$fecha=PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue(), 'YYYY/MM/DD hh:mm:ss');
											$patente = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue(), 'YYYY/MM/DD hh:mm:ss');
											$tra_rut='';
											$tolerancia='';
											$jornada=false;
											
	
											for ($j = 6; $j <= count($datosJornada); $j++) {
												
												if(( $fecha >= $datosJornada[$j]['inicioJornada'] ) && ( $fecha <= $datosJornada[$j]['terminoJornada'] ) && $datosJornada[$j]['patente'] == $patente){
													//var_dump($fecha);
													//var_dump($datosJornada[$j]['inicioJornada']);
													//var_dump($datosJornada[$j]['terminoJornada']);
													//echo '<br>';
													$tra_rut=explode("-", $datosJornada[$j]['tra_rut']);
													$jornada=true;
													//var_dump($tra_rut);
												}
											} 
											
											
											$datosExceso[$i]['exc_fecha'] = $fecha;
											$datosExceso[$i]['exc_zona'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue(); 						
											$datosExceso[$i]['veh_patente'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();  
											$datosExceso[$i]['exc_velocidad'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
											$datosExceso[$i]['exc_limite'] = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
											
											
											
											if($jornada){
												$datosExceso[$i]['tra_rut'] = $tra_rut[0];
												$datosExceso[$i]['tra_dv'] = $tra_rut[1];
												$comprobarExistencia= Yii::app()->db->createCommand("SELECT exc_id FROM min_excesos_velocidad WHERE exc_fecha = '".$fecha."' and eess_rut= '".Yii::app()->user->id."' ")->queryScalar();
												//var_dump($comprobarExistencia);
												// TO-DO
												if(empty($comprobarExistencia)){
													$sql = "INSERT INTO min_excesos_velocidad 
															VALUES 
															(NULL,
															'".$datosExceso[$i]['tra_rut']."',
															'".$datosExceso[$i]['tra_dv']."',
															'".$datosExceso[$i]['exc_fecha']."',
															'".$datosExceso[$i]['exc_zona']."',
															'".$datosExceso[$i]['veh_patente']."',
															'".$datosExceso[$i]['exc_velocidad']."',
															'".$datosExceso[$i]['exc_limite']."',
															NULL,
															NULL,
															'".Yii::app()->user->id."',
															'".$_POST["variable"]."'
															)";
													Yii::app()->db->createCommand($sql)->execute();
												}
												
											}else{
												$flagJornada = false;
												$excesosSinJornada.='<tr style="border-bottom:1px solid #cccccc;">';
												$excesosSinJornada.='<td style="padding:5px; width:150px;">'.$datosExceso[$i]['exc_fecha'].'</td>';
												$excesosSinJornada.='<td style="padding:5px; width:150px;">'.utf8_encode($datosExceso[$i]['exc_zona']).'</td>';
												$excesosSinJornada.='<td style="padding:5px; width:150px;">'.$datosExceso[$i]['veh_patente'].'</td>';
												$excesosSinJornada.='<td style="padding:5px; width:150px;">'.$datosExceso[$i]['exc_velocidad'].'</td>';
												$excesosSinJornada.='<td style="padding:5px; width:150px;">'.$datosExceso[$i]['exc_limite'].'</td>';
												$excesosSinJornada.='</tr>';
											}
											
											
											
											//echo $jornada == false ? 'Sin Jornada<br>' : '';
	
											
									 		
									 	}																											

									}
	
									if(!$flagJornada){
										
										$textoInfo .= 'Hubo algunos registros sin jornadas correspondientes, los cuales no fueron grabados. El detalle fue enviado a su correo';
										
										$tabla='<table style="border-collapse:collapse; background:#f3f3f3;>';
										$tabla.='<thead>';
										$tabla.='<tr style="border-bottom:1px solid #cccccc;">';
										$tabla.='<th style="padding:5px;"> Fecha </th>';
										$tabla.='<th style="padding:5px;"> Zona </th>';
										$tabla.='<th style="padding:5px;"> Patente </th>';
										$tabla.='<th style="padding:5px;"> Velocidad </th>';
										$tabla.='<th style="padding:5px;"> Límite </th>';
										$tabla.='</tr>';
										$tabla.='</thead>';
										$tabla.='<tbody>';
										$tabla.=$excesosSinJornada;
										$tabla.='</tbody>';
										
										// Enviar correo
										$email = '';
										$dir = 'images/respuesta_medidas_control/';
										// Obtener nombre de trabajador

										$email .='
										<p>Señores<br>
										<b>'.Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".Yii::app()->user->id."'")->queryScalar().'</b></p>
										<p>Informamos a usted que en la carga de archivos relacionados con los Excesos de Velocidad realizada el <b>'.date("d-m-Y").'</b> a las <b>'.date("H:i").'</b> hrs  
										se ha detectado la falta de Jornada Laboral para los registros indicados en la Tabla adjunta, razón por la cual éstos no han sido grabados. 
										Para corregir lo anterior, debe regularizar el archivo Jornada Laboral y volver a subir los archivos correspondientes..</p>';

										$email.=$tabla;
									

										$direccioneses = Yii::app()->db->createCommand("SELECT eess_email FROM `min_eess` WHERE eess_rut = '".Yii::app()->user->id."'")->queryScalar();
									
										//$archivo = chunk_split(base64_encode(file_get_contents("http://innoapsion.cl/sedecc/index.php?r=evaEquipos/pdf&id=".$obj->timestamp)));
										$headers = "From: Excesos de velocidad sin jornada correspondiente <sedecca@innoapsion.cl> \r\n";

										$headers .= "Cc:  ".$direccioneses." \r\n"; //
										$headers .= "Bcc:  eduardoacevedo@innoapsion.cl, gustavoogueda@innoapsion.cl " . "\r\n"; //
										$headers .= "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: multipart/mixed; boundary=\"=A=G=R=O=\"\r\n\r\n";
										$email_message = "--=A=G=R=O=\r\n";
										$email_message .= "Content-type: text/html; charset=iso-8859-1\r\n";
										$email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
										$email_message .= $email . "\r\n\r\n";
										$email_message .= "--=A=G=R=O=\r\n";

										mail(utf8_decode($direccioneses), utf8_decode('Respuesta Medidas de Control'), utf8_decode($email_message), utf8_decode($headers)); // Quitar email de prueba
									}
									
									//echo $tabla;
									//var_dump($datosExceso);
									unlink($destinoExcesos);
									//var_dump($_POST);
									//var_dump($datosExceso);
									
									echo '<div class="alert alert-info">';
									echo $textoInfo;
									echo "</div>";

								}
								
								//return;
				            }
				
				            //si por algo no cargo el archivo bak_ 
				            else {
				                echo "Necesitas primero importar el archivo";
								//return;
				            }
				
				            $errores = 0;
				

				            unlink($destino);
				    							
						}
					} catch(Exception $e) {
					    die('Error loading file : '.$e->getMessage());
					}
					
				}
			
			?>
    	</div>
	</div>
</section>

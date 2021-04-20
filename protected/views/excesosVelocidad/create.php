<?php
/* @var $this ExcesosVelocidadController */
/* @var $model ExcesosVelocidad */

$this->breadcrumbs=array(
	'Excesos Velocidads'=>array('index'),
	'Nuevo',
);
?>


<span style='float:right;'>
	<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<!--<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>-->
</span>
<h1>Nuevo Registro de Excesos de Velocidad</h1>

			<!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL 
		    Selecciona el archivo a importar:

			<input type="file" name="excel" accept=".xlsx" required />
	        <input type='submit' name='enviar'  value="Importar" />
	        <input type="hidden" value="upload" name="action" />-->
		   <!-- <form name="importa" method="post" action="index.php?r=excesosVelocidad/create" enctype="multipart/form-data" >
		        <input type="file" name="excel" accept=".xlsx" required />
		        <input type='submit' name='enviar'  value="Importar" />
		        <input type="hidden" value="upload" name="action" />
		    </form>-->
		    <!-- CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload -->
		    <?php
		    	/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				    extract($_POST);
		
			        if ($action == "upload"){
			            //cargamos el archivo al servidor con el mismo nombre solo le agregue el sufijo bak_ 
			            $archivo = $_FILES['excel']['name'];
			            $tipo = $_FILES['excel']['type'];   
			            $destino = "files/bak_" . $archivo;
			
			            if (copy($_FILES['excel']['tmp_name'], $destino)){
			                echo "Archivo Cargado Con Éxito";
			            }
			
			            else{
			                echo "Error Al Cargar el Archivo";
			            }
			
			            if (file_exists("bak_" . $archivo)) {
			                /** Clases necesarias */
			               /* require_once('Classes/PHPExcel.php');
			                require_once('Classes/PHPExcel/Reader/Excel2007.php');
			
			                // Cargando la hoja de cálculo
			                $objReader = new PHPExcel_Reader_Excel2007();
			                $objPHPExcel = $objReader->load("bak_" . $archivo);
			                $objFecha = new PHPExcel_Shared_Date();
			
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
			                //$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();﻿
			                for ($i = 2; $i <= $highestRow; $i++) {
			                    $_DATOS_EXCEL[$i]['tra_rut'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
			                    $_DATOS_EXCEL[$i]['exc_fecha'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
			                    $_DATOS_EXCEL[$i]['exc_zona'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
			                    $_DATOS_EXCEL[$i]['veh_patente'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
			                    $_DATOS_EXCEL[$i]['exc_velocidad'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
			                    $_DATOS_EXCEL[$i]['exc_limite'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
			                    $_DATOS_EXCEL[$i]['veh_codigoCamion'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
			                    $_DATOS_EXCEL[$i]['exc_turno'] = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();		                
			                }
			            }
			
			            //si por algo no cargo el archivo bak_ 
			            else {
			                echo "Necesitas primero importar el archivo";
			            }
			
			            $errores = 0;*/
			
			            //recorremos el arreglo multidimensional 
			            //para ir recuperando los datos obtenidos
			            //del excel e ir insertandolos en la BD
			            /* foreach ($_DATOS_EXCEL as $campo => $valor) {
			                $sql = "INSERT INTO datos(nombre,direccion,num) VALUES ('";
			                foreach ($valor as $campo2 => $valor2) {
			                    $campo2 == "num" ? $sql.= $valor2 . "');" : $sql.= $valor2 . "','";
			                }*/
			
			           /* foreach ($_DATOS_EXCEL as $campo => $valor) {
			            	echo $valor;
			                $sql = "INSERT INTO Trabajadores VALUES (NULL,'";
			                foreach ($valor as $campo2 => $valor2) {
			                	echo $valor2;
			                    $campo2 == "fechaNacimiento" ? $sql.= $valor2 . "');" : $sql.= $valor2 . "','";
			                }
			
			                //echo $sql;
			                //Yii::app()->db->createCommand($sql)->execute();
			                //$result = mysql_query($sql);
			
			                if (!$result) {
			                    echo "Error al insertar registro " . $campo;
			
			                    $errores+=1;
			                }
			            }
			
			            echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
			
			            //una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
			            unlink($destino);
			        }
				}
		        */
		
		    ?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>
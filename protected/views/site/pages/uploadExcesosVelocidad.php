
<?php 
	if(!isset(Yii::app()->user->id)){
	  header('Location: index.php?r=site/login');
	}
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		extract($_POST);
		if(!file_exists('files/')) mkdir($dir, 0777, true);
        if ($action == "upload"){
            //cargamos el archivo al servidor con el mismo nombre solo le agregue el sufijo bak_ 
            $archivo = $_FILES['excel']['name'];
            $tipo = $_FILES['excel']['type'];   
            $destino = "files/bak_" . $archivo;

            if (copy($_FILES['excel']['tmp_name'], $destino)){
                //echo "Archivo Cargado Con Éxito";
            }

            else{
                echo "Error Al Cargar el Archivo";
            }

            if (file_exists("files/bak_formato excesos velocidad.xlsx")) {
                /** Clases necesarias */
                require_once('PHPExcel/Classes/PHPExcel.php');
                require_once('PHPExcel/Classes/PHPExcel/Reader/Excel2007.php');

                // Cargando la hoja de cálculo
                $objReader = new PHPExcel_Reader_Excel2007();
                $objPHPExcel = $objReader->load("files/bak_" . $archivo);
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
                    $_DATOS_EXCEL[$i]['Rut'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
					$_DATOS_EXCEL2[$i]['Rut'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['Fecha'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
					$_DATOS_EXCEL[$i]['Fecha'] = PHPExcel_Style_NumberFormat::toFormattedString($_DATOS_EXCEL[$i]['Fecha'], 'yyyy-mm-dd hh:mm:ss');
                    $_DATOS_EXCEL[$i]['Zona'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['Patente'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['Velocidad'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['Limite'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['CodigoCamion'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['Turno'] = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
					$_DATOS_EXCEL2[$i]['PautaEvaluacion'] = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
					$_DATOS_EXCEL2[$i]['InformeSegtrans'] = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();			
					$_DATOS_EXCEL2[$i]['FonoDenuncia'] = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();		                
                }
            }

            //si por algo no cargo el archivo bak_ 
            else {
                echo "Necesitas primero importar el archivo";
            }

            $errores = 0;

            //recorremos el arreglo multidimensional 
            //para ir recuperando los datos obtenidos
            //del excel e ir insertandolos en la BD
            /* foreach ($_DATOS_EXCEL as $campo => $valor) {
                $sql = "INSERT INTO datos(nombre,direccion,num) VALUES ('";
                foreach ($valor as $campo2 => $valor2) {
                    $campo2 == "num" ? $sql.= $valor2 . "');" : $sql.= $valor2 . "','";
                }*/

            foreach ($_DATOS_EXCEL as $campo => $valor) {
            	//print_r($valor);
                $sql = "INSERT INTO min_excesos_velocidad VALUES (NULL,'";
                foreach ($valor as $campo2 => $valor2) {
                	
					//print_r($valor2);
                    $campo2 == "Turno" ? $sql.= $valor2 . "');" : $sql.= $valor2 . "','";
                }

                //echo $sql;
                Yii::app()->db->createCommand($sql)->execute();
                //$result = mysql_query($sql);

                /*if (!$result) {
                    echo "Error al insertar registro " . $campo;

                    $errores+=1;
                }*/
            }
			
			foreach ($_DATOS_EXCEL2 as $campo => $valor) {
            	//print_r($valor);
                $sql = "INSERT INTO min_observaciones VALUES (NULL,'";
                foreach ($valor as $campo2 => $valor2) {
                	
					//print_r($valor2);
                    $campo2 == "FonoDenuncia" ? $sql.= $valor2 . "');" : $sql.= $valor2 . "','";
                }

                //echo $sql;
                Yii::app()->db->createCommand($sql)->execute();
                //$result = mysql_query($sql);

                /*if (!$result) {
                    echo "Error al insertar registro " . $campo;

                    $errores+=1;
                }*/
            }
			echo '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-ok-sign"></i><strong>ARCHIVO IMPORTADO CON EXITO, EN TOTAL '.$campo.' REGISTROS Y '.$errores.' ERRORES</strong></div>';
			//echo '<div class="alert alert-success " ><strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL '.$campo.' REGISTROS Y '.$errores.' ERRORES</center></strong><button type="button" class="close" data-dismiss="alert">×</button></div>';

            //una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
            unlink($destino);
        }
	}
	
?>
<div class="span-19">
	<div id="content">
		<span style="float:right;">
			<a class="btn btn-rounded btn-sm btn-icon btn-default" href="/sedecc/index.php?r=excesosVelocidad/index"><i class="i i-list2"></i></a>
			<a href="excel/FormatoExcesosVelocidad.xlsx" download> <img src="images/excel.jpg" width="40px;"></a>
		</span>
		<h1>Ingresar Excesos de Velocidad</h1>
		<section class="panel panel-default">
			<!--header class="panel-heading font-bold">Horizontal form</header-->
			<div class="panel-body">
				<div class="bs-example form-horizontal">
					 <!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
				    Selecciona el archivo a importar:
				    <form name="importa" method="post" action="index.php?r=site/page&view=uploadExcesosVelocidad" enctype="multipart/form-data" >
				        <input type="file" name="excel" accept=".xlsx" required />
				        <input type='submit' name='enviar'  value="Importar" />
				        <input type="hidden" value="upload" name="action" />
				    </form>
				    <!-- CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload -->
				</div>
			</div>
		</section>
			
	</div>
</div>


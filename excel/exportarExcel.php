<?php

extract($_GET);
	
	//$EESS = '76885630';
	//$tipo = 'Control Operacional en Tareas de Conductor';
	
    include("../conexion.php");
	mysqli_set_charset( $mysqli, 'utf8');

	$consulta = "SELECT res_enunciado, TRUNCATE(((SC*100)/(SC+NC+NA)),0) as verde, TRUNCATE(((NC*100)/(SC+NC+NA)),0) as rojo, TRUNCATE(((NA*100)/(SC+NC+NA)),0) as amarillo  FROM (SELECT R.res_enunciado, R.res_respuesta,
		SUM(CASE WHEN R.res_respuesta = 'si' THEN 1 else 0 END) as SC,
		SUM(CASE WHEN R.res_respuesta = 'no' THEN 1 else 0 END) as NC,
		SUM(CASE WHEN R.res_respuesta = 'n/a' THEN 1 else 0 END) as NA

		FROM min_evaluacion as E 
		JOIN min_respuesta as R 
		ON(E.eva_id = R.eva_id) 
		WHERE E.eess_rut = '".$EESS."' AND E.eva_tipo = '".$tipo."' AND R.tem_id = 'Seguridad-Conductas observadas en la tarea'
		GROUP BY R.res_enunciado) as zxc";
	 	$resultado = mysqli_query($mysqli,$consulta) or die(mysqli_error());
 		


	if($resultado->num_rows > 0 ){
						
		date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../PHPExcel/Classes/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de alumnos")
							 ->setKeywords("reporte alumnos carreras")
							 ->setCategory("Reporte excel");


		$tituloReporte = "EESS";
		$titulosColumnas = array('Enunciado', 'Cumple', 'No Cumple', 'No Aplica');
		
		$objPHPExcel->setActiveSheetIndex(0);
        		    //->mergeCells('A1:AC1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					//->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A1',  $titulosColumnas[0])
 					->setCellValue('B1',  $titulosColumnas[1])
        		    ->setCellValue('C1',  $titulosColumnas[2])
                    ->setCellValue('D1',  $titulosColumnas[3]);
					
		//Se agregan los datos de los alumnos
		$i = 2;
		while ($fila = $resultado->fetch_array()) {

           

			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['res_enunciado'])
		            ->setCellValue('B'.$i,  $fila['verde'].'%')
        		    ->setCellValue('C'.$i,  $fila['rojo'].'%')
        		    ->setCellValue('D'.$i,  $fila['amarillo'].'%');
                    

            		
					$i++;
		}
		
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => '179bd7')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF' //color letra 
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'ffffff' //color 1 
        		),
        		'endcolor'   => array(
            		'argb' => '179bd7' //color 2
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => 'ffffff' //color linea arriba
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '179bd7' //color linea abajo
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000' //color letra registros 
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'ffffff') //color 1
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => 'ffffff' //color 2
                   	)
               	)             
           	)
        ));
		 
		//$objPHPExcel->getActiveSheet()->getStyle('A1:AC1')->applyFromArray($estiloTituloReporte);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:AC3')->applyFromArray($estiloTituloColumnas);		
		//$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:AC".($i-1));
		
		
				
		
			
for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}





		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Item');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,5);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Item.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
<?php

extract($_GET);


    include("../conexion.php");
  mysqli_set_charset( $mysqli, 'utf8');

  $consulta = "SELECT *, 
  CASE 
  WHEN prom >= 96 THEN 'Bajo'
  WHEN prom >= 86 and prom < 96 THEN 'Medio'
  WHEN prom >= 0 and prom < 86 THEN 'Alto'
  END as seguimiento
  FROM (SELECT tra_rut, eva_nombres, eva_apellidos, eva_tipo, TRUNCATE(AVG(eva_cache_porcentaje),0) as prom FROM min_evaluacion WHERE eess_rut = '$rut' AND eva_tipo = '$tipo' GROUP BY tra_rut ORDER BY prom DESC) as asd";
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
    $titulosColumnas = array('Rut Trabajador', 'Nombres Trabajador', 'Apellidos Trabajador', 'Actividad', 'Promedio', 'Nivel de Riesgo');
    
    $objPHPExcel->setActiveSheetIndex(0);
                //->mergeCells('A1:AC1');
            
    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
          //->setCellValue('A1',$tituloReporte)
                ->setCellValue('A1',  $titulosColumnas[0])
                ->setCellValue('B1',  $titulosColumnas[1])
                ->setCellValue('C1',  $titulosColumnas[2])
                ->setCellValue('D1',  $titulosColumnas[3])
                ->setCellValue('E1',  $titulosColumnas[4])
                ->setCellValue('F1',  $titulosColumnas[5]);
          
    //Se agregan los datos de los alumnos
    $i = 2;
    while ($fila = $resultado->fetch_array()) {

      $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $fila['tra_rut'])
                ->setCellValue('B'.$i,  $fila['eva_nombres'])
                ->setCellValue('C'.$i,  $fila['eva_apellidos'])
                ->setCellValue('D'.$i,  $fila['eva_tipo'])
                ->setCellValue('E'.$i,  $fila['prom'])
                ->setCellValue('F'.$i,  $fila['seguimiento']);
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
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('argb' => '179bd7')
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
            'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
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
            'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'ffffff') //color 1
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
    
    
        
    /*
    $objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
    $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(12);
    $objXLS->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
    $objXLS->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
    */


$objPHPExcel->getActiveSheet()->getStyle('A2:A4000')->getNumberFormat()->setFormatCode("#");

//$objPHPExcel->getActiveSheet()->getStyle('B4:BN')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

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
    header('Content-Disposition: attachment;filename="Seguimiento a Evaluaciones.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
    
  }
  else{
    print_r('No hay resultados para mostrar');
  }
?>
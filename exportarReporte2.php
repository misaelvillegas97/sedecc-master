<?php

extract($_GET);


    include("../conexionQ.php");
  mysqli_set_charset( $mysqli, 'utf8');
if(isset($_GET['filtro_tipo'])){
        $where= "WHERE car_id = '".$_GET['filtro_tipo']."'";
    }else{
        $where= '';
    }/**/

$consulta_temas = "SELECT DISTINCT(tem_id) FROM min_pregunta ".$where."");

$resultado_temas = mysqli_query($mysqli,$consulta_temas) or die(mysqli_error());



/*$completo= "SELECT tra_rut, eva_nombres, eva_fecha_evaluacion ,eva_cache_porcentaje FROM min_evaluacion ";

    $consulta = "SELECT car_id,
     car_tipo,
      car_eess,
      car_razon_social, 
      car_rut, 
      CONCAT(car_nombres,' ',car_apellidos) as nombre_completo, 
      car_cache_porcentaje, 
      date_format(car_fecha_evaluacion, '%d-%m-%Y') as fecha, 
      car_eva, 
      M.seguimiento,
       b.VIGENCIA
                FROM min_cargo as c 
                JOIN min_base as b
                ON(c.car_rut = b.RUT)
                INNER JOIN ( 
                SELECT che_id, max(CASE
                WHEN res_seguimiento = 1 THEN 1
                WHEN res_seguimiento = 0 AND res_plazo >= curdate() THEN 2
                WHEN res_seguimiento = 0 AND res_plazo < curdate() THEN 3
                END) as seguimiento
                FROM min_respuesta
                GROUP BY che_id
                ) as M 
                ON (M.che_id = c.car_id)
                ORDER by car_id asc";

    $resultado = mysqli_query($mysqli,$consulta) or die(mysqli_error());
    */


  if($resultado_temas->num_rows > 0 ){
            
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
  
    $titulosColumnas = array('ID', 'Cargo', 'Rut EESS', 'Nombre EESS', 'Rut Trabajador', 'Nombre Trabajador', 'Porcentaje', 'Fecha Evaluación', 'N° Evaluación', 'Seguimiento', 'Vigencia');
    
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
                ->setCellValue('F1',  $titulosColumnas[5])
                ->setCellValue('G1',  $titulosColumnas[6])
                ->setCellValue('H1',  $titulosColumnas[7])
                ->setCellValue('I1',  $titulosColumnas[8])
                ->setCellValue('J1',  $titulosColumnas[9])
                ->setCellValue('K1',  $titulosColumnas[10]);
          
    //Se agregan los datos de los alumnos
    $i = 2;
    while ($fila = $resultado->fetch_array()) {

            if ($fila['seguimiento'] == 1) {
                $semaforo = "APROBADA";
            }elseif($fila['seguimiento'] == 2){
                $semaforo = "EN PROCESO";
            }elseif($fila['seguimiento'] == 3){
                $semaforo = "VENCIDA";
            }

      $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $fila['car_id'])
                ->setCellValue('B'.$i,  $fila['car_tipo'])
                ->setCellValue('C'.$i,  $fila['car_eess'])
                ->setCellValue('D'.$i,  $fila['car_razon_social'])
                ->setCellValue('E'.$i,  $fila['car_rut'])
                ->setCellValue('F'.$i,  $fila['nombre_completo'])
                ->setCellValue('G'.$i,  $fila['car_cache_porcentaje'])
                ->setCellValue('H'.$i,  $fila['fecha'])
                ->setCellValue('I'.$i,  $fila['car_eva'])
                ->setCellValue('J'.$i,  $semaforo)
                ->setCellValue('K'.$i,  $fila['VIGENCIA']);
                   

                
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
    header('Content-Disposition: attachment;filename="Reportes2.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
    
  }
  else{
    print_r('No hay resultados para mostrar');
  }
?>
<?php
$u = Yii::app()->user->id;
$tipo = '';
?>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/serial.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuojqC59sKz9CrNOHGyyAXCzxwl_f1NVA" type="text/javascript"></script>
	<script type="text/javascript" src="js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="https://www.amcharts.com/lib/3/serial.js"></script>
	<script src="https://www.amcharts.com/lib/3/gauge.js"></script>
	<script type="text/javascript" src="js/amcharts/pie.js"></script>
		
<!-- amCharts -->
<link href="https://www.amcharts.com/lib/3/plugins/export/export.css" media="all" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/plugins/export/export.js"></script>
<!-- <script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script> 
<script type="text/javascript" src="http://cdn.amcharts.com/lib/3/gauge.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
-->
<script src="https://code.jquery.com/jquery-1.7.0.min.js"></script>
<script src="js/jquery.animateNumber.js"></script>
<style type="text/css">
	#exportdiv5:hover .amcharts-export-menu {

  opacity: 1;adS
}

.amcharts-export-menu .export-main>a, .amcharts-export-menu .export-drawing>a, .amcharts-export-menu .export-delayed-capturing>a {
	     margin-top: 30px;
      width: 20px;
    height: 20px;
}
</style>
	<?php 

extract($_GET);
include("conexion.php");
  mysqli_set_charset( $mysqli, 'utf8');

?>

<?php 
	if (isset($eess) and $eess != "") {
		$where2 = "and E.eess_rut = '".$eess."' ";
	}else if(!isset($eess) or $eess == ""){
		$where2 = "";
		$eess = "";
	}
	
 ?>
<?php
  $where = "";
  if(Yii::app()->controller->usertype() == 1){
    //echo 'Empresa';
    $u = Yii::app()->user->id;
    $where.= "AND E.eess_rut = '".$u."' ";
    $tipo=1;
  }
  if(Yii::app()->controller->usertype() == 2){
   $u = Yii::app()->user->id;
   $tipo=2;
  }
  if(Yii::app()->controller->usertype() == 3){
    //echo 'Evaluador';
    $u = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
    $where.= "AND E.eess_rut = '".$u."' ";
    $tipo=3;
  }
  
  

?>
</b></i></p>
<hr>
<!--
<div class="alert alert-warning" style="background-color: #e6b548; color: white;">
  Para comenzar: <b>Seleccione una opción del menú a la izquierda.</b>
</div>-->

<script type="text/javascript"> 
function refrescar(opc) 
{ 
var x=document.getElementById("time"); 
t=x.options[x.selectedIndex].text; 
window.location.href = 'index.php?r=site/page&view=index&eess='+opc;
} 
</script> 

<?php if ($u == 'admin'): ?>
	<select  id="time" onchange="refrescar(this.value)" >
	<option name="" value="">Seleccione una Empresa</option>
	<?php  


  $myquery = "SELECT * FROM min_eess WHERE eess_estado = 1 ORDER BY eess_nombre_corto ASC";
            $resultado = $mysqli->query($myquery);

            while($fila = $resultado ->fetch_assoc()){
            	?>
            	<option value="<?php echo $fila['eess_rut']; ?>" <?php if ($fila['eess_rut'] == $eess): ?>
            		selected
            	<?php endif ?>><?php echo $fila['eess_nombre_corto']; ?></option>
            <?php }
            ?>
             
		
	</select>
<?php endif ?>


<div class="row" style="margin-bottom: 15px;">
  <div class="col-md-3">
  <div class="col-md-12" align="center" style="padding: 0px; background-color: #FFFFFF;">
  <div style="width: 100%; margin-bottom: 18px; border-bottom: 2px solid #eeecee;">Nivel de Riesgo Cargos Críticos</div>
  <div id="chartdiv55" style="width: 100%; height: 128px;"></div>
    <!-- <div id="chartdiv" style="width: 100%; height: 128px;" ></div> -->
    <div id="chartdiv5" style="width: 100%; height: 72px;" ></div>
  </div>
  </div>
  <div class="col-md-9" align="center" style="padding: 0px; background-color: #FFFFFF; width: 74%">
    <div style="width: 100%; margin-bottom: 18px; border-bottom: 2px solid #eeecee;">% Cumplimiento por Máquina</div>
    <div id="chartdiv2" style="width: 100%; height: 200px;" ></div>
  </div>
</div>
<div class="row">
  
    

  <!-- <div class="col-md-3"> 
    <div class="col-md-12" align="center" style="padding: 0px; background-color: #FFFFFF;">
      <div style="width: 100%; margin-bottom: 18px; border-bottom: 2px solid #eeecee;">N° Evaluaciones por Cargo</div>
      <div id="chartdiv11" style="width: 100%; height: 230px; margin: auto;"></div>
    </div>
  </div> -->
  <div class="col-md-7" style="padding-right: 0px"> 
    <div class="col-md-12" align="center" style="padding: 0px; background-color: #FFFFFF;">
      <div style="width: 100%; border-bottom: 2px solid #eeecee;">N° Evaluaciones por Evaluador</div>
       <div id="chartdiv99" style="width: 100%;  height: 250px;"></div>  
    </div>
  </div>

<?php /*
  <div class="col-md-3">
    <div align="center" id="chartdiv0" style="width: 100%; height: 200px; background-color: white;">
      N° de Evaluaciones
            <?php
            $rows = Yii::app()->db->createCommand("SELECT SUM(MES) as m, SUM(ANO) as a, SUM(TRI) as t FROM(SELECT 
case when DATE_FORMAT(eva_fecha_evaluacion,'%Y-%m-%d') > DATE_SUB(CURDATE(), INTERVAL 1 MONTH) then 1 else 0 END as MES,
case when DATE_FORMAT(eva_fecha_evaluacion,'%Y-%m-%d') > DATE_SUB(CURDATE(), INTERVAL 12 MONTH) then 1 else 0 END as ANO,
case when DATE_FORMAT(eva_fecha_evaluacion,'%Y-%m-%d') > DATE_SUB(CURDATE(), INTERVAL 3 MONTH) then 1 else 0 END as TRI
FROM min_evaluacion
WHERE 1 ".$where.") as sa")->query()->readAll();

            for($i=0;$i<count($rows);$i++){

              echo '
                <div class="row">
                  <div class="col-md-12">
                    <div style="width: 80px; height: 80px; background-color: #f3f3f3; border-radius: 50px; padding: 10px;">
                      <span id="MES" style="color: #899197; font-size: 40px;"></span><span style="color: #899197; font-size: 10px;">mes</span>
                      
                    </div>
                  <div>
                </div>
              

              
                <div class="row">
                  <div class="col-md-6">
                    <div style="width: 70px; height: 70px; background-color: #f3f3f3; border-radius: 50px; padding: 10px; " >
                      <span id="TRI" class="col-md-12" style="padding-left: 0px; padding-right: 0px; color: #899197; font-size: 20px;"></span>
                      <span class="col-md-12" style="color: #899197; font-size: 10px;">tri</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div style="width: 70px; height: 70px; background-color: #f3f3f3; border-radius: 50px; padding: 10px; " >
                      <span id="ANO" class="col-md-12" style="padding-left: 0px; padding-right: 0px; color: #899197; font-size: 20px;"></span>
                      <span class="col-md-12" style="color: #899197; font-size: 10px;">año</span>
                    </div>
                  </div>
                </div></div></div>';
            ?>
            <script type="text/javascript">
            //MES
              $('#MES')
                .ready('number', 0)
                .animateNumber(
                  {
                    number: <?php echo $rows[$i]['m']; ?>
                  },
                  2000
                );
            //TRIMESTRE
              $('#TRI')
                .ready('number', 0)
                .animateNumber(
                  {
                    number: <?php echo $rows[$i]['t']; ?>
                  },
                  2000
                );

            //AÑO
              $('#ANO')
                .ready('number', 0)
                .animateNumber(
                  {
                    number: <?php echo $rows[$i]['a']; ?>
                  },
                  2000
                );
            </script>
      <?php 
            }

            ?>
      </div>
  </div>
  */ ?>
  <div class="col-md-3" style="padding-right: 0px;">
    <div class="col-md-12" align="center" style="padding: 0px; background-color: #FFFFFF;">
      <div style="width: 100%; border-bottom: 2px solid #eeecee;">Seguimiento a Incumplimientos</div>
      <div id="exportdiv5" style="width: 100%;  height: 250px; overflow-y: auto;">

          <div id="chartdiv66" style="width: 90%; height: 100%;"></div>
      </div>
    </div>
  </div>

  <div class="col-md-2">
    <div align="center" id="chartdiv0" style="width: 100%; height: 133px; background-color: white;">
      <div style="width: 100%; margin-bottom: 5px; border-bottom: 2px solid #eeecee;">N° de Maquinas</div>
            <?php
            $countEquipos = Yii::app()->db->createCommand("SELECT COUNT(*) as trab FROM min_equipos as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1 ".$where2." ".$where." ")->queryScalar();
            $countVehiculos = Yii::app()->db->createCommand("SELECT COUNT(*) as trab FROM min_vehiculo as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1 ".$where2." ".$where." ")->queryScalar();
            $count=$countEquipos+$countVehiculos;
			 echo '                           
                    <div style="margin-top: 0px; max-width: 100px; height: 100px; background-color: #f3f3f3; border-radius: 80px; padding-top: 20px;">
                      <span id="TRAB" style="color: #899197; font-size: 40px;">'.$count.'</span>
                    </div>                                                   
                ';

             
            ?>
            <script type="text/javascript">
            //numero trabajadores
              $('#TRAB')
                .ready('number', 0)
                .animateNumber(
                  {
                    number: <?php echo $count; ?>
                  },
                  2000
                );

            </script>

            
      

      </div>
      <div align="center" id="chartdiv0" style="width: 100%; height: 132px; background-color: white;">
      <div style="width: 100%; margin-bottom: 5px; margin-top: 10px; border-bottom: 2px solid #eeecee;">N° de Evaluaciones</div>
            <?php
            $rows = Yii::app()->db->createCommand("SELECT COUNT(*) as trab FROM min_evaluacion_equipos as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1 ".$where2." ".$where." ")->query()->readAll();

            for($i=0;$i<count($rows);$i++){

              echo '
                
                  
                    <div style="margin-top: 0px; max-width: 100px; height: 100px; background-color: #f3f3f3; border-radius: 80px; padding-top: 20px;">
                      <span id="TRAB2" style="color: #899197; font-size: 40px;">'.$rows[$i]['trab'].'</span>
                    </div>
               
                
              

              
                ';
            ?>
            <script type="text/javascript">
            //numero trabajadores
              $('#TRAB2')
                .ready('number', 0)
                .animateNumber(
                  {
                    number: <?php echo $rows[$i]['trab']; ?>
                  },
                  2000
                );

            </script>
      <?php 
            }

            ?>
            
      

      </div>

  </div>
</div>



<div class="row" style="margin-top: 10px;">
  <div class="col-md-12">
    
  
    <div class="col-md-12" align="center" style="background-color: #FFFFFF;">
      <div style="border-bottom: 2px solid #eeecee;">% Cumplimiento de Maquinas por Jefe de Faena</div>
      <div style="height: 250px;">
          <div id="chartdiv3" style="width: 100%; height: 100%;"></div>  
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
      AmCharts.makeChart("chartdiv",
        {
          "type": "pie",
          "marginBottom": -20,
          "marginTop": -20,
          
          <?php
          $porc = Yii::app()->db->createCommand("SELECT AVG(eva_cache_porcentaje) FROM min_evaluacion_equipos as E WHERE 1 ".$where." ")->queryScalar();
          $nota = '';
          $limit1 = Yii::app()->params['riesgoalto'];
          $limit2 = Yii::app()->params['riesgomedio'];
          if($porc>=0 && $porc<=$limit1) $nota = ((0.029*$porc)+1);
          if($porc>$limit1 && $porc<=$limit2) $nota = ((0.05*$porc)-0.5);
          if($porc>$limit2 && $porc<=100) $nota = ((0.1*$porc)-5);
          $nota = number_format(floor($nota*10)/10,1,".",",");
          $porcen = bcdiv(floatval($porc),1,0);
          ?>

          "balloonText": "% Cumplimiento: <?php echo $porcen; ?>%",
          "innerRadius": "70%",
          "labelText": "",
          "titleField": "category",
          "valueField": "column-1",
          "colorField": "color",
          "allLabels": [{
              "x": "50%",
              "y": "35%",
              "text": "<?php echo $nota;?>", 
              "size": 30,   
              "align": "middle",
              "color": "#555"
            }, ],
          "balloon": {},
          "titles": [],
          "dataProvider": [
            {
              "category": "category-1",
              "column-1": <?php echo $nota;?>,
              "color": "red"
            },
            {
              "category": "category-2",
              "column-1": 5.0 - <?php echo $nota;?>,
              "color": "#f8f5f5"
            }
          ]
        }
      );
    </script>
    <script type="text/javascript">
  
      AmCharts.makeChart("chartdiv2",
        {
          "type": "serial",
          "categoryField": "cargo",
          "fontSize": 7,
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "autoWrap": true,
            "fontSize": 7,
            "labelRotation": 30,
            "minHorizontalGap":1,
            "minimum":0,
            "maximum":100
          },/*
          "export": {
            "enabled": true,
            "divId": "exportdiv5",
            "menu": [{
              "class": "export-main",
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
          },*/
          "trendLines": [],

          "graphs": [
    {
      "balloonText": "N° de Evaluaciones: [[cantidad]]",
              "fillAlphas": 1,              
              "id": "AmGraph-1",
              "legendPeriodValueText": "",
              "legendValueText": "",
              
              "lineThickness": 0,
              "tabIndex": 6,
              "title": "Cumplimiento",
              "type": "column",
              "valueField": "Porcentaje",
              "labelText": " [[value]]%",
              "colorField": "color",
              "labelRotation": 300
    }
  ],


          "guides": [],
          "valueAxes": [ {

            
            
            "gridAlpha": 0,
            "dashLength": 0,
            "minimum": 0,
            "maximum": 105,
            "minVerticalGap": 20,
            "showLastLabel": false,
            "axisAlpha": 1        
            }
          ],
          "allLabels": [],
          "balloon": {},
           "listeners": [{
           "event": "clickGraphItem",
           "method": function(event) {
             //document.location.href = 'http://innoapsion.cl/vlm/index.php?r=site/page&view=indicadores&eess='+event.item.category
               // alert('asd'+event.item.category);
              }
            }],
              "titles": [],
          "dataProvider": [
            <?php
            $limit1 = Yii::app()->params['riesgoalto'];
            $limit2 = Yii::app()->params['riesgomedio'];
             //#e14d57 //rojo
             //#f7e523 //amarillo
             //#4fbd5b //verde
            $rows = Yii::app()->db->createCommand("SELECT COUNT(E.eva_id) as cantidad, T.eq_maquina, AVG(eva_cache_porcentaje) as porc, E.eq_codigo,E.eva_codigo_camion
                           FROM min_evaluacion_equipos as E
                           JOIN min_equipos as T
                           ON(E.eq_codigo = T.eq_codigo)
                           JOIN min_eess as EE
                           ON(E.eess_rut = EE.eess_rut)
                           WHERE EE.eess_estado = 1 ".$where2." ".$where."
                           
                           GROUP BY E.eq_codigo,E.eva_codigo_camion
                           ORDER BY porc ASC")->query()->readAll();
            for($i=0;$i<count($rows);$i++){
             // $rows[$i]['color'] = '#e14d57';

             // if($rows[$i]['porc'] > Yii::app()->params['riesgoalto']) $rows[$i]['color'] = '#f7e523';
            // if($rows[$i]['porc'] > Yii::app()->params['riesgomedio']) $rows[$i]['color'] = '#4fbd5b'; //color amarillo
            $porc = floor($rows[$i]['porc']);
           if($porc>=0 && $porc<=$limit1) $rows[$i]['color'] = '#e14d57';
            if($porc>$limit1 && $porc<=$limit2) $rows[$i]['color'] = '#f7e523';
            if($porc>$limit2 && $porc<=100)  $rows[$i]['color'] = '#4fbd5b';
           $cargo='';
           	if(trim($rows[$i]['eq_codigo']) !== '' && $rows[$i]['eq_codigo'] !== NULL){
           		$cargo=$rows[$i]['eq_codigo'];
           	}
           	if(trim($rows[$i]['eva_codigo_camion']) !== '' && $rows[$i]['eva_codigo_camion'] !== NULL){
           		$cargo=$rows[$i]['eva_codigo_camion'];
           	}
              echo '
              {
                "cargo": "'.$cargo.'",
                "Porcentaje": "'.floor($rows[$i]['porc']).'",               
                "color": "'.$rows[$i]['color'].'",
                "cantidad": "'.$rows[$i]['cantidad'].'"
              },
              ';
              //cambio de round que es redonde hacia arriba por floor que es redondeo hacia abajo!
            }
            ?>
          ]
        }
      );
    </script>
    <script type="text/javascript">
  
      AmCharts.makeChart("chartdiv3",
        {
          "type": "serial",
          "categoryField": "cargo",
          "startDuration": 1,
          "rotate": false,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "autoWrap": true,
            "fontSize": 8,
            "labelRotation": 30,
            "minHorizontalGap":1,
            "minimum":0,
            "maximum":100
          },/*
          "export": {
            "enabled": true,
            "divId": "exportdiv5",
            "menu": [{
              "class": "export-main",
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
          },*/
          "trendLines": [],

          "graphs": [
    {
    	//"columnWidth": 0.1,
      "balloonText": "[[Porcentaje]]%",
              "fillAlphas": 1,              
              "id": "AmGraph-1",
              "legendPeriodValueText": "",
              "legendValueText": "",
              
              "lineThickness": 0,
              "tabIndex": 6,
              "title": "Cumplimiento",
              "type": "column",
              "valueField": "Porcentaje",
              "labelText": "[[value]]%",
              "colorField": "color"
    }
  ],


          "guides": [],
          "valueAxes": [ {

            
            
            "gridAlpha": 0,
            "dashLength": 0,
            "minimum": 0,
            "maximum": 100,
            "minVerticalGap": 20,
            "showLastLabel": false,
            "axisAlpha": 1        
            }
          ],
          "allLabels": [],
          "balloon": {},
           "listeners": [{
           "event": "clickGraphItem",
           "method": function(event) {
             //document.location.href = 'http://innoapsion.cl/vlm/index.php?r=site/page&view=indicadores&eess='+event.item.category
               // alert('asd'+event.item.category);
              }
            }],
              "titles": [
              
            ],
          "dataProvider": [
            <?php
            $rows = Yii::app()->db->createCommand("SELECT eva_jefe_faena, AVG(eva_cache_porcentaje) as porc FROM min_evaluacion_equipos as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1 and eva_jefe_faena != '' ".$where2." ".$where." GROUP BY eva_jefe_faena
            ORDER BY porc ASC")->query()->readAll();
            for($i=0;$i<count($rows);$i++){
              $rows[$i]['color'] = '#e14d57';
              if($rows[$i]['porc'] > Yii::app()->params['riesgoalto']) $rows[$i]['color'] = '#f7e523';
              if($rows[$i]['porc'] > Yii::app()->params['riesgomedio']) $rows[$i]['color'] = '#4fbd5b';
              echo '
              {
                "cargo": "'.$rows[$i]['eva_jefe_faena'].'",
                "Porcentaje": "'.floor($rows[$i]['porc']).'",               
                "color": "'.$rows[$i]['color'].'"
              },
              ';
            }
            ?>
          ]
        }
      );
    </script>
    <script>
var chart = AmCharts.makeChart("chartdiv4", {
    "type": "serial",
    "theme": "light",
    "dataProvider": [{
        "lineColor": "#b7e021",
        "date": "2012-01-01",
        "duration": 408
    }, {
        "date": "2012-01-02",
        "duration": 482
    }, {
        "date": "2012-01-03",
        "duration": 562
    }, {
        "date": "2012-01-04",
        "duration": 379
    }, {
        "lineColor": "#fbd51a",
        "date": "2012-01-05",
        "duration": 501
    }, {
        "date": "2012-01-06",
        "duration": 443
    }, {
        "date": "2012-01-07",
        "duration": 405
    }, {
        "date": "2012-01-08",
        "duration": 309,
        "lineColor": "#2498d2"
    }, {
        "date": "2012-01-09",
        "duration": 287
    }, {
        "date": "2012-01-10",
        "duration": 485
    }, {
        "date": "2012-01-11",
        "duration": 890
    }, {
        "date": "2012-01-12",
        "duration": 810
    }],
    "balloon": {
        "cornerRadius": 6,
        "horizontalPadding": 15,
        "verticalPadding": 10
    },
    "valueAxes": [{
      "labelsEnabled": false,
        "duration": "mm",
        "durationUnits": {
            "hh": "h ",
            "mm": "min"
        },
        "axisAlpha": 0
    }],
    "graphs": [{
        "bullet": "square",
        "bulletBorderAlpha": 1,
        "bulletBorderThickness": 1,
        "fillAlphas": 0.3,
        "fillColorsField": "lineColor",
        "legendValueText": "[[value]]",
        "lineColorField": "lineColor",
        "title": "duration",
        "valueField": "duration"
    }],

    "chartCursor": {
        "categoryBalloonDateFormat": "YYYY MMM DD",
        "cursorAlpha": 0,
        "fullWidth": true,
        "cursorColor": "white",
        "cursorPosition": 2
    },
    "dataDateFormat": "YYYY-MM-DD",
    "categoryField": "date",
    "categoryAxis": {
      "gridThickness": 0,
      "labelsEnabled": false,
        "dateFormats": [{
            "period": "DD",
            "format": "DD"
        }, {
            "period": "WW",
            "format": "MMM DD"
        }, {
            "period": "MM",
            "format": "MMM"
        }, {
            "period": "YYYY",
            "format": "YYYY"
        }],
        "parseDates": true,
        "autoGridCount": false,
        "axisColor": "#555555",
        "gridAlpha": 0,
        "gridCount": 50
    }
    /*,
    "export": {
        "enabled": true
    }*/
});



chart.addListener("dataUpdated", zoomChart);

function zoomChart() {
    chart.zoomToDates(new Date(2012, 0, 3), new Date(2012, 0, 11));
}

</script>
<script type="text/javascript">
      AmCharts.makeChart("chartdiv5",
        {
          "type": "serial",
          "categoryField": "category",
          "marginTop": 22,
          "minMarginBottom": 0,
          "minMarginLeft": 0,
          "startDuration": 1,
          "categoryAxis": {
            "autoRotateAngle": 0,
            "autoRotateCount": 0,
            "gridPosition": "start",
            "startOnAxis": true,
            "axisAlpha": 0,
            "axisThickness": 0,
            "firstDayOfWeek": 0,
            "fontSize": 0,
            "gridAlpha": 0,
            "gridCount": 0,
            "gridThickness": 0,
            "labelsEnabled": false,
            "minorGridAlpha": 0,
            "offset": -1,
            "tickLength": 0
          },
          "trendLines": [],
          "graphs": [
            {

              "balloonText": "[[mes]]: [[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "graph 1",
              "valueField": "column-1",
              //"fillAlphas": 0, 
              "bullet": "round",
              "bulletSize": 5,
              "fillAlphas": 0.2,
              "lineThickness": 2,
        "fillColorsField": "lineColor",
        "legendValueText": "[[value]]",
        "lineColorField": "lineColor"

            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              
              "axisAlpha": 0.3,
              "labelsEnabled": false,
              "tickLength": 0,
              "title": "",
              "minimum": 0,
              "maximum": 5,
              "gridThickness": 0
            }
          ],
          "allLabels": [],
          "balloon": {},
          "titles": [],
          "dataProvider": [
            <?php
            $rows = Yii::app()->db->createCommand("SELECT YEAR(eva_fecha_evaluacion) as ano, MONTH(eva_fecha_evaluacion) as mes, AVG(eva_cache_porcentaje) as prom FROM min_evaluacion_equipos as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1 ".$where2." ".$where." GROUP BY YEAR(eva_fecha_evaluacion), MONTH(eva_fecha_evaluacion) ORDER BY eva_fecha_evaluacion ASC LIMIT 0,6")->query()->readAll();
            for($i=0;$i<count($rows);$i++){
              $mes='';
              if($rows[$i]['mes'] == 1){
                $mes = 'Enero';
              }elseif($rows[$i]['mes'] == 2){
                $mes = 'Febrero';
              }elseif($rows[$i]['mes'] == 3){
                $mes = 'Marzo';
              }elseif($rows[$i]['mes'] == 4){
                $mes = 'Abril';
              }elseif($rows[$i]['mes'] == 5){
                $mes = 'Mayo';
              }elseif($rows[$i]['mes'] == 6){
                $mes = 'Junio';
              }elseif($rows[$i]['mes'] == 7){
                $mes = 'Julio';
              }elseif($rows[$i]['mes'] == 8){
                $mes = 'Agosto';
              }elseif($rows[$i]['mes'] == 9){
                $mes = 'Septiembre';
              }elseif($rows[$i]['mes'] == 10){
                $mes = 'Octubre';
              }elseif($rows[$i]['mes'] == 11){
                $mes = 'Noviembre';
              }elseif($rows[$i]['mes'] == 12){
                $mes = 'Diciembre';
              }

              $nota = '';
              $limit1 = Yii::app()->params['riesgoalto'];
              $limit2 = Yii::app()->params['riesgomedio'];
              $porc = $rows[$i]['prom'];
              if($porc>=0 && $porc<=$limit1) $nota = ((0.029*$porc)+1);
              if($porc>$limit1 && $porc<=$limit2) $nota = ((0.05*$porc)-0.5);
              if($porc>$limit2 && $porc<=100) $nota = ((0.1*$porc)-5);
              $nota = number_format(floor($nota*10)/10,1,".",",");
          
              echo '
              {
                "category": "'.$rows[$i]['ano'].' '.$rows[$i]['mes'].'",
                "column-1": '.$nota.',
                "mes": "'.$mes.'",
                "lineColor": "#2498d2"
              },
              ';
            }
            ?>
          ]
        }
      );
    </script>

    <!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv99", {
  "type": "serial",
  "dataLoader": {
              "url": "graphsC/tiempoMaquina.php?eess=<?php echo $u; ?>&empresa=<?php echo $eess; ?>"
          },
  "theme": "light",
  "dataDateFormat": "YYYY-MM-DD",
  "startDuration": 1,
  "fontSize": 7,
  "precision": 0,
  "valueAxes": [{
    "id": "v1",
    "title": "Evaluaciones Mes",
    "position": "left",
    "autoGridCount": false,
    "titleBold": false,
    "fontSize": 7
    
  }, {
    "id": "v2",
    "title": "Evaluaciones Año",
    "gridAlpha": 0,
    "position": "right",
    "autoGridCount": false,
    "titleBold": false,
    "fontSize": 7
  }],
  "graphs": [
  /*{
    "id": "g3",
    "valueAxis": "v1",
    "lineColor": "#e1ede9",
    "fillColors": "#e1ede9",
    "fillAlphas": 1,
    "type": "column",
    "title": "Meta Mes",
    "valueField": "sales2",
    "clustered": false,
    "columnWidth": 0.5,
    "legendValueText": "[[value]]",
    "balloonText": "[[title]]: <b style='font-size: 130%'>[[value]]</b>"
  },*/ {
    "id": "g4",
    "valueAxis": "v1",
    "lineColor": "#50a8bc",
    "fillColors": "#50a8bc",
    "fillAlphas": 1,
    "type": "column",
    "title": "Actual Mes",
    "valueField": "sales1",
    "clustered": false,
    "columnWidth":0.5,
    "legendValueText": "[[value]]",
    "balloonText": "[[title]]: <b style='font-size: 130%'>[[value]]</b>"
  }, {
    "id": "g1",
    "valueAxis": "v2",
    "bullet": "round",
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "lineColor": "#666666",
    "type": "smoothedLine",
    "title": "Actual Año",
    "useLineColorForBulletBorder": true,
    "valueField": "market1",
    "balloonText": "[[title]]: <b style='font-size: 130%'>[[value]]</b>"
  }/*, {
    "id": "g2",
    "valueAxis": "v2",
    "bullet": "round",
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "lineColor": "#e1ede9",
    "type": "smoothedLine",
    "dashLength": 5,
    "title": "Meta Año",
    "useLineColorForBulletBorder": true,
    "valueField": "market2",
    "balloonText": "[[title]]: <b style='font-size: 130%'>[[value]]</b>"
  }*/
  ],
  /*
  "chartScrollbar": {
    "graph": "g1",
    "oppositeAxis": false,
    "offset": 30,
    "scrollbarHeight": 50,
    "backgroundAlpha": 0,
    "selectedBackgroundAlpha": 0.1,
    "selectedBackgroundColor": "#888888",
    "graphFillAlpha": 0,
    "graphLineAlpha": 0.5,
    "selectedGraphFillAlpha": 0,
    "selectedGraphLineAlpha": 1,
    "autoGridCount": true,
    "color": "#AAAAAA"
  },*/
  "chartCursor": {
    "pan": true,
    "valueLineEnabled": true,
    "valueLineBalloonEnabled": true,
    "cursorAlpha": 0,
    "valueLineAlpha": 0.2
  },
  "categoryField": "date",
  "categoryAxis": {
    "parseDates": false,
    "dashLength": 1,
    "minorGridEnabled": true,
    "labelRotation": 30,
    "fontSize": 9,
    "gridPosition": "start",
    "position": "left",
    "autoWrap": true,
    "minHorizontalGap":1,
    "minimum":0,
    "maximum":100
  },
  "legend": {
    "useGraphSettings": true,
    "position": "top",
    "fontSize": 9,
    "valueWidth": 20,
    "autoMargins": false,
    "markerSize": 7
  },
  "balloon": {
    "borderThickness": 1,
    "shadowAlpha": 0
  },
  /*
  "export": {
   "enabled": true
  },*/
  
});
</script>

<!-- Chart code -->
<script>
var chart55 = AmCharts.makeChart("chartdiv55", {
  "theme": "light",
  "type": "gauge",
  "axes": [{
    "labelsEnabled": false,
    "tickThickness": 0,
    "axisAlpha": 0,
    "topTextFontSize": 20,
    "topTextYOffset": 10,
    "axisColor": "#31d6ea",
    "axisThickness": 1,
    "endValue": 100,
    "gridInside": true,
    "inside": true,
    "radius": "50%",
    "valueInterval": 10,
    "tickColor": "#67b7dc",
    "startAngle": -90,
    "endAngle": 90,
    "unit": "%",
    "bandOutlineAlpha": 0,
    "bands": [{
      //"color": "#0080ff",
      "color": "#eeecee",
      "endValue": 200,
      "innerRadius": "105%",
      "radius": "170%",
      //"gradientRatio": [0],
      "startValue": 0
    }, {
      
      "endValue": 0,
      "innerRadius": "105%",
      "radius": "170%",
      //"gradientRatio": [0.5, 0, -0.5],
      "startValue": 0
    }]
  }],
  "arrows": []
});
</script>
<!-- amCharts javascript code -->
    <script type="text/javascript">
      var chart66 = AmCharts.makeChart("chartdiv66",
        {
          "type": "pie",
          "dataLoader": {
              "url": "graphsC/desviacionMaquina.php?eess=<?php echo $u; ?>&empresa=<?php echo $eess; ?>"
          },

          "percentPrecision": 0,
          "balloonText": "[[title]]<br><span style='color: black; font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "startDuration": 1,
          "radius": 50,
          "innerRadius": "50%",
          "labelsEnabled": false,
          "colorField": "color",
          "titleField": "category",
          "valueField": "column",
          "allLabels": [],
          "balloon": {},
          "pullOutOnlyOne": true,
          /*
          "export": {
						"enabled": true,
						"divId": "exportdiv5",
						"menu": [{
							"class": "export-main",
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
					},*/
          "legend": {
            "position": "bottom",
            "enabled": true,
            "align": "center",
            "markerType": "circle",
            "markerSize": 5,
            "fontSize": 9,
            "valueWidth": 20,
            "verticalGap": 0
          },
          "titles": [],
        
        }
      );
    </script>

<?php
$limit1 = Yii::app()->params['riesgoalto'];
$limit2 = Yii::app()->params['riesgomedio'];
              $myquery2 = "SELECT TRUNCATE(porc,0) as P, TRUNCATE(CASE
WHEN (porc >= 0 AND porc <= '".$limit1."') THEN ((0.029*porc)+1)
WHEN (porc > '".$limit1."' AND porc <= '".$limit2."') THEN ((0.05*porc)-0.5)
WHEN (porc > '".$limit2."' AND porc <= 100) THEN ((0.1*porc)-5) END,1) as nota
FROM(SELECT AVG(eva_cache_porcentaje) as porc FROM min_evaluacion_equipos as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1  ".$where2." ".$where.") as czx
                    ";
            $resultado2 = $mysqli->query($myquery2);
            $eess3=[];
          
              
            while($fila2 = $resultado2 ->fetch_assoc()){
          

            array_push($eess3, [$fila2['nota'], $fila2['P']]);
              
            }
            
            
            echo '<script>';
            echo 'eess3 = '.json_encode($eess3);
            
            echo '</script>';
            ?>

<script type="text/javascript">
setInterval(randomValue, 1000);

// set random value
function randomValue() {
  var nota = eess3[0][0];
  //var nota = 2.5;
  //var nota = nota2.toFixed(1);
  var value = Math.round((nota * 200)/5.0);
  //chart.arrows[0].setValue(value);
  chart55.axes[0].setTopText(nota);

  if (nota < 3.0) {
     chart55.axes[0].bands[1].color = '#e14d57';
  }else if(nota >= 3.0 && nota < 4.0){
     chart55.axes[0].bands[1].color = '#f7e523';
  }else if(nota >= 4.0 && nota <= 5.0){
     chart55.axes[0].bands[1].color = '#4fbd5b';
  }
  chart55.axes[0].bands[1].balloonText = "% Promedio de Cumplimiento: "+eess3[0][1]+"%";
  // adjust darker band to new value
  chart55.axes[0].bands[1].setEndValue(value);
}
</script>

<script type="text/javascript">
		
function modificarexportar(){
	var x = document.getElementsByClassName("export-main");
	var c = x.length;

	for(i=0;i<c;i++){
		<?php if (isset($eess)) { 
      if($tipo == 1){ ?>
        x[i].getElementsByTagName('ul')[0].getElementsByTagName('li')[1].innerHTML = "<li><?php echo "<a href='index.php?r=site/desviaciones&tipo=$tipo&eess=$u'>Exportar datos</a>";  ?></li>"		
      <?php }else if($tipo == 2){ ?>
        x[i].getElementsByTagName('ul')[0].getElementsByTagName('li')[1].innerHTML = "<li><?php echo "<a href='index.php?r=site/desviaciones&tipo=$tipo&eess=$eess'>Exportar datos</a>";  ?></li>"   
      <?php }else if($tipo == 3){ ?>
        x[i].getElementsByTagName('ul')[0].getElementsByTagName('li')[1].innerHTML = "<li><?php echo "<a href='index.php?r=site/desviaciones&tipo=$tipo&eess=$u'>Exportar datos</a>";  ?></li>"   
      <?php } 
    }?>
	}
}
setTimeout(modificarexportar,3000);
		</script>

<?php
return;
?>

<div class="topinfo">
	<div class="row">
		<div class="col-sm-1">
			<h2 class="fa fa-calendar pull-right"></h2> 
		</div>
		<div class="col-sm-2">
			Año
			<select class="form-control m-b">
				<?php
				for($i=date("Y");$i>2000;$i--){
					echo '<option>'.$i.'</option>';
				}
				?>
			</select> 
		</div>
		<div class="col-sm-2">
			Mes
			<select class="form-control m-b">
				<option value="1">Enero</option>
				<option value="2">Febrero</option>
				<option value="3">Marzo</option>
				<option value="4">Abril</option>
				<option value="5">Mayo</option>
				<option value="6">Junio</option>
				<option value="7">Julio</option>
				<option value="8">Agosto</option>
				<option value="9">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
			</select>
		</div>
		<div class="col-sm-7">
   
			<div class="pull-right">
				<p></p>
      
				<a class="btn btn-default" href="#"><i class="fa fa-file"></i> Exportar xls</a>
			</div>
		</div>
	</div>
	
</div>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Reporte producción</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reporte productos</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Días trabajados</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div id="flot-pie-donut" style="width:100%;height:400px"></div>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
    	<div id="flot-sp1ine" style="width:100%;height:400px"></div>
    	<div class="row text-center no-gutter">
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">5,860</span>
                            <small class="text-muted m-b block">Orders</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">10,450</span>
                            <small class="text-muted m-b block">Sellings</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">21,230</span>
                            <small class="text-muted m-b block">Items</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">7,230</span>
                            <small class="text-muted m-b block">Customers</small>                        
                          </div>
		</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
    	fdsfdsfds
    </div>
  </div>

</div>


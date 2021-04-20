

  
  <script type="text/javascript" src="js/amcharts/amcharts.js"></script>
  <script type="text/javascript" src="js/amcharts/dataloader.js"></script>
  <script type="text/javascript" src="js/amcharts/serial.js"></script>
  <script type="text/javascript" src="js/amcharts/gauge.js"></script>
  <script type="text/javascript" src="js/amcharts/pie.js"></script>
<!-- Chart code -->
<!-- Styles -->
<script src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
<script src="js/jquery.animateNumber.js"></script>

<?php
  $where = "";
  if(Yii::app()->controller->usertype() == 1){
    //echo 'Empresa';
    $u = Yii::app()->user->id;
    $where.= "AND E.eess_rut = '".$u."' ";
  }
  if(Yii::app()->controller->usertype() == 2){
   $u = Yii::app()->user->id;
  }
  if(Yii::app()->controller->usertype() == 3){
    //echo 'Evaluador';
    $u = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
    $where.= "AND E.eess_rut = '".$u."' ";
  }

?>
</b></i></p>
<hr>
<!--
<div class="alert alert-warning" style="background-color: #e6b548; color: white;">
  Para comenzar: <b>Seleccione una opción del menú a la izquierda.</b>
</div>-->
<div class="row" style="margin-bottom: 15px;">
  <div class="col-md-3">
  <div class="col-md-12" align="center" style="padding: 0px; background-color: #FFFFFF;">
  <div style="width: 100%; margin-bottom: 18px; border-bottom: 2px solid #eeecee;">Nivel de Riesgo Cargos Críticos</div>
  <div id="chartdiv55" style="width: 100%; height: 128px;"></div>
    <!-- <div id="chartdiv" style="width: 100%; height: 128px;" ></div> -->
    <div id="chartdiv5" style="width: 100%; height: 72px;" ></div>
  </div>
  </div>
  <div class="col-md-4" align="center" style="padding: 0px; background-color: #FFFFFF;">
    <div style="width: 100%; margin-bottom: 18px; border-bottom: 2px solid #eeecee;">% Cumplimiento por Cargos Criticos</div>
    <div id="chartdiv2" style="width: 100%; height: 200px;" ></div>
  </div>
  <div class="col-md-5">
    <div class="col-md-12" align="center" style="padding: 0px; background-color: #FFFFFF;">
     <div style="width: 100%; margin-bottom: 18px; border-bottom: 2px solid #eeecee;">Vigencia Certificaciones</div>
      <div style="width: 33%; height: 20px; float: left; font-size: 11px;">Examen Corma</div><div style="width: 33%; height: 20px; float: left; font-size: 11px;">Examen Ocupacional</div><div style="width: 33%; height: 20px; float: left; font-size: 11px;">Licencia Conducir</div>
      <div id="chartdiv22" style="width: 33%; height: 180px; float: left;"></div>
      <div id="chartdiv33" style="width: 33%; height: 180px; float: left;" ></div>
      <div id="chartdiv44" style="width: 33%; height: 180px; float: left;" ></div>
  </div>
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
      <div style="width: 100%; border-bottom: 2px solid #eeecee;">% Cumplimiento por Faena</div>
      <div style="width: 100%;  height: 250px; overflow-y: auto;">
          <div id="chartdiv3" style="width: 100%;  height: 150%;"></div>  
      </div>
       
    </div>

   
  </div>
  <div class="col-md-2">
    <div align="center" id="chartdiv0" style="width: 100%; height: 135px; background-color: white;">
      <div style="width: 100%; margin-bottom: 5px; border-bottom: 2px solid #eeecee;">N° de Trabajadores</div>
            <?php
            $rows = Yii::app()->db->createCommand("SELECT COUNT(*) as trab FROM min_trabajador as E WHERE 1 ".$where." ")->query()->readAll();

            for($i=0;$i<count($rows);$i++){

              echo '
                <div class="row">
                  <div class="col-md-12">
                    <div style="margin-top: 0px; max-width: 100px; height: 100px; background-color: #f3f3f3; border-radius: 80px; padding-top: 20px;">
                      <span id="TRAB" style="color: #899197; font-size: 40px;">'.$rows[$i]['trab'].'</span>
                    </div>
                  <div>
                
              

              
                ';
            ?>
            <script type="text/javascript">
            //numero trabajadores
              $('#TRAB')
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
      <div align="center" id="chartdiv0" style="width: 100%; height: 135px; background-color: white;">
      <div style="width: 100%; margin-bottom: 5px; margin-top: 10px; border-bottom: 2px solid #eeecee;">N° de Evaluaciones</div>
            <?php
            $rows = Yii::app()->db->createCommand("SELECT COUNT(*) as trab FROM min_evaluacion as E WHERE 1 ".$where." ")->query()->readAll();

            for($i=0;$i<count($rows);$i++){

              echo '
                
                  <div class="col-md-12">
                    <div style="margin-top: 0px; max-width: 100px; height: 100px; background-color: #f3f3f3; border-radius: 80px; padding-top: 20px;">
                      <span id="TRAB2" style="color: #899197; font-size: 40px;">'.$rows[$i]['trab'].'</span>
                    </div>
                  <div>
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
<script type="text/javascript">
      AmCharts.makeChart("chartdiv",
        {
          "type": "pie",
          "marginBottom": -20,
          "marginTop": -20,
          
          <?php
          $porc = Yii::app()->db->createCommand("SELECT AVG(eva_cache_porcentaje) FROM min_evaluacion as E WHERE 1 ".$where." ")->queryScalar();
          $nota = '';
          if($porc>=0 && $porc<70) $nota = ((0.029*$porc)+1);
          if($porc>=70 && $porc<90) $nota = ((0.05*$porc)-0.5);
          if($porc>=90 && $porc<=100) $nota = ((0.1*$porc)-5);
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
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "autoWrap": true,
            "fontSize": 9,
            "labelRotation": 30,
            "minHorizontalGap":1,
            "minimum":0,
            "maximum":100
          },
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
          },
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
              "labelText": "[[value]]%",
              "colorField": "color"
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
            $rows = Yii::app()->db->createCommand("SELECT COUNT(T.car_id) as cantidad, C.car_descripcion, AVG(eva_cache_porcentaje) as porc 
                           FROM min_evaluacion as E
                           JOIN min_trabajador as T
                           ON(E.tra_rut = T.tra_rut)
                           JOIN min_cargo as C
                           ON(T.car_id = C.car_id)
                           WHERE 1 $where
                           GROUP BY T.car_id")->query()->readAll();
            for($i=0;$i<count($rows);$i++){
              $rows[$i]['color'] = 'red';
              if($rows[$i]['porc'] > Yii::app()->params['limit1']) $rows[$i]['color'] = 'yellow';
              if($rows[$i]['porc'] > Yii::app()->params['limit2']) $rows[$i]['color'] = 'green';
              echo '
              {
                "cargo": "'.$rows[$i]['car_descripcion'].'",
                "Porcentaje": "'.round($rows[$i]['porc']).'",               
                "color": "'.$rows[$i]['color'].'",
                "cantidad": "'.$rows[$i]['cantidad'].'"
              },
              ';
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
          "rotate": true,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "autoWrap": true,
            "fontSize": 8,
            "labelRotation": 30,
            "minHorizontalGap":1,
            "minimum":0,
            "maximum":100
          },
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
          },
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
            $rows = Yii::app()->db->createCommand("SELECT eva_faena, AVG(eva_cache_porcentaje) as porc FROM min_evaluacion as E WHERE eva_faena != '' ".$where." GROUP BY eva_faena")->query()->readAll();
            for($i=0;$i<count($rows);$i++){
              $rows[$i]['color'] = 'red';
              if($rows[$i]['porc'] > Yii::app()->params['limit1']) $rows[$i]['color'] = 'yellow';
              if($rows[$i]['porc'] > Yii::app()->params['limit2']) $rows[$i]['color'] = 'green';
              echo '
              {
                "cargo": "'.$rows[$i]['eva_faena'].'",
                "Porcentaje": "'.round($rows[$i]['porc']).'",               
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
                      "fillAlphas": 0.3,
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
            $rows = Yii::app()->db->createCommand("SELECT YEAR(eva_fecha_evaluacion) as ano, MONTH(eva_fecha_evaluacion) as mes, AVG(eva_cache_porcentaje) as prom FROM min_evaluacion as E WHERE 1 ".$where." GROUP BY YEAR(eva_fecha_evaluacion), MONTH(eva_fecha_evaluacion) ORDER BY eva_fecha_evaluacion ASC LIMIT 0,6")->query()->readAll();
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
              $porc = $rows[$i]['prom'];
              if($porc>=0 && $porc<70) $nota = ((0.029*$porc)+1);
              if($porc>=70 && $porc<90) $nota = ((0.05*$porc)-0.5);
              if($porc>=90 && $porc<=100) $nota = ((0.1*$porc)-5);
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
    <?php /*
<script>
var gaugeChart = AmCharts.makeChart("chartdiv11", {
  "type": "gauge", 
  "theme": "light",
  "axes": [{
    "axisAlpha": 0,
    "tickAlpha": 0,
    "labelsEnabled": false,
    "startValue": 0,
    "endValue": 100,
    "startAngle": 0,
    "endAngle": 270,
    "bands": [{
      "color": "#eee",
      "startValue": 0,
      "endValue": 100,
      "radius": "100%",
      "innerRadius": "85%"
    },{
      "color": "#84b761",
      "startValue": 0,
      "endValue": 0,
      "radius": "100%",
      "innerRadius": "85%",
      
      "balloonText": "1%"
    }, {
      "color": "#eee",
      "startValue": 0,
      "endValue": 100,
      "radius": "80%",
      "innerRadius": "65%"
    }, {
      "color": "#fdd400",
      "startValue": 0,
      "endValue": 0,
      "radius": "80%",
      "innerRadius": "65%",
      "valueField": "valor1",
      "balloonText": "2%"
    }, {
      "color": "#eee",
      "startValue": 0,
      "endValue": 100,
      "radius": "60%",
      "innerRadius": "45%"
    }, {
      "color": "#cc4748",
      "startValue": 0,
      "endValue": 0,
      "radius": "60%",
      "innerRadius": "45%",
      "balloonText": "1%"
    }, {
      
      "color": "#eee",
      "startValue": 0,
      "endValue": 100,
      "radius": "40%",
      "innerRadius": "25%"
    }, {
      "color": "#67b7dc",
      "startValue": 0,
      "endValue": 0,
      "radius": "40%",
      "innerRadius": "25%",
      "balloonText": "2%"
    }]
  }],
  "allLabels": [{
    "text": "Conductor",
    "x": "49%",
    "y": "5%",
    "size": 9,
    "bold": true,
    "color": "#84b761",
    "align": "right"
  }, {
    "text": "Jefe de Faena",
    "x": "49%",
    "y": "15%",
    "size": 9,
    "bold": true,
    "color": "#fdd400",
    "align": "right"
  }, {
    "text": "Motosierristas",
    "x": "49%",
    "y": "24%",
    "size": 9,
    "bold": true,
    "color": "#cc4748",
    "align": "right"
  }, {
    "text": "Calibrador",
    "x": "49%",
    "y": "33%",
    "size": 9,
    "bold": true,
    "color": "#67b7dc",
    "align": "right"
  }],

  
});


</script>


<?php
           include("conexion.php");
  mysqli_set_charset( $mysqli, 'utf8');            
            $myquery1 = "SELECT 
SUM(CASE WHEN eva_tipo = 'Conductor' THEN 1 ELSE 0 END) as conductor,
SUM(CASE WHEN eva_tipo = 'Jefe de Faena' THEN 1 ELSE 0 END) as jefe,
SUM(CASE WHEN eva_tipo = 'Motosierristas' THEN 1 ELSE 0 END) as moto,
SUM(CASE WHEN eva_tipo = 'Calibrador' THEN 1 ELSE 0 END) as supervisor
FROM `min_evaluacion` 
where eess_rut = '76885630'
                    ";
            $resultado1 = $mysqli->query($myquery1);
            $eess2=[];
            $contt = 0;
              
            while($fila1 = $resultado1 ->fetch_assoc()){
              $contt++;

            array_push($eess2, [$fila1['conductor'], $fila1['jefe'], $fila1['moto'], $fila1['supervisor']]);
              
            }
            
            
            echo '<script>';
            echo 'eess2 = '.json_encode($eess2);
            
            echo '</script>';
            ?>

<script type="text/javascript">
setInterval(randomValue2, 1000);
function randomValue2(value) {
  gaugeChart.axes[0].bands[1].setEndValue(eess2[0][0]);
  gaugeChart.axes[0].bands[1].balloonText = eess2[0][0];
  gaugeChart.axes[0].bands[3].setEndValue(eess2[0][1]);
  gaugeChart.axes[0].bands[3].balloonText = eess2[0][1];
  gaugeChart.axes[0].bands[5].setEndValue(eess2[0][2]);
  gaugeChart.axes[0].bands[5].balloonText = eess2[0][2];
  gaugeChart.axes[0].bands[7].setEndValue(eess2[0][3]);
  gaugeChart.axes[0].bands[7].balloonText = eess2[0][3];

}

</script>
*/ ?>
<!-- amCharts javascript code -->
    <script type="text/javascript">
      var chart2 = AmCharts.makeChart("chartdiv22",
        {
          "type": "pie",
          "dataLoader": {
              "url": "graphsC/corma2.php?eess=<?php echo $u; ?>"
          },
          "percentPrecision": 0,
          "balloonText": "[[title]]<br><span style='color: black; font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "startDuration": 0,
          "radius": 50,
          "innerRadius": "50%",
          "labelsEnabled": false,
          "colorField": "color",
          "titleField": "category",
          "valueField": "column",
          "allLabels": [],
          "balloon": {},
          "pullOutOnlyOne": true,

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

    <!-- amCharts javascript code -->
    <script type="text/javascript">
      var chart3 = AmCharts.makeChart("chartdiv33",
        {
          "type": "pie",
          "dataLoader": {
              "url": "graphsC/ocupacional2.php?eess=<?php echo $u; ?>"
          },
          "percentPrecision": 0,
          "balloonText": "[[title]]<br><span style='color: black; font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "startDuration": 0,
          "radius": 50,
          "innerRadius": "50%",
          "labelsEnabled": false,
          "colorField": "color",
          "titleField": "category",
          "valueField": "column",
          "allLabels": [],
          "balloon": {},
          "pullOutOnlyOne": true,
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

     <!-- amCharts javascript code -->
    <script type="text/javascript">
      var chart4 = AmCharts.makeChart("chartdiv44",
        {
          "type": "pie",
          "dataLoader": {
              "url": "graphsC/licencia2.php?eess=<?php echo $u; ?>"
          },
          "percentPrecision": 0,
          "balloonText": "[[title]]<br><span style='color: black; font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "startDuration": 0,
          "radius": 50,
          "innerRadius": "50%",
          "labelsEnabled": false,
          "colorField": "color",
          "titleField": "category",
          "valueField": "column",
          "allLabels": [],
          "balloon": {},
          "pullOutOnlyOne": true,
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

    <!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv99", {
  "type": "serial",
  "dataLoader": {
              "url": "graphsC/tiempo2.php?eess=<?php echo $u; ?>"
          },
  "theme": "light",
  "dataDateFormat": "YYYY-MM-DD",
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
  "graphs": [{
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
  }, {
    "id": "g4",
    "valueAxis": "v1",
    "lineColor": "#62cf73",
    "fillColors": "#62cf73",
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
    "lineColor": "#20acd4",
    "type": "smoothedLine",
    "title": "Actual Año",
    "useLineColorForBulletBorder": true,
    "valueField": "market1",
    "balloonText": "[[title]]: <b style='font-size: 130%'>[[value]]</b>"
  }, {
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
  }],
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
      
      "endValue": 200,
      "innerRadius": "105%",
      "radius": "170%",
      "gradientRatio": [0.5, 0, -0.5],
      "startValue": 0
    }, {
      
      "endValue": 0,
      "innerRadius": "105%",
      "radius": "170%",
      "gradientRatio": [0.5, 0, -0.5],
      "startValue": 0
    }]
  }],
  "arrows": []
});
</script>


<?php
           include("conexion.php");
  mysqli_set_charset( $mysqli, 'utf8');            
            $myquery2 = "SELECT TRUNCATE(porc,0) as P, TRUNCATE(CASE
WHEN (porc >= 0 AND porc < 70) THEN ((0.029*porc)+1)
WHEN (porc >= 70 AND porc < 90) THEN ((0.05*porc)-0.5)
WHEN (porc >= 90 AND porc <= 100) THEN ((0.1*porc)-5) END,1) as nota
FROM(SELECT AVG(eva_cache_porcentaje) as porc FROM min_evaluacion as E WHERE 1 ".$where.") as czx
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
     chart55.axes[0].bands[1].color = '#ff0000';
  }else if(nota >= 3.0 && nota < 4.0){
     chart55.axes[0].bands[1].color = '#ffff00';
  }else if(nota >= 4.0 && nota <= 5.0){
     chart55.axes[0].bands[1].color = '#00cc00';
  }
  chart55.axes[0].bands[1].balloonText = "% Promedio de Cumplimiento: "+eess3[0][1]+"%";
  // adjust darker band to new value
  chart55.axes[0].bands[1].setEndValue(value);
}
</script>
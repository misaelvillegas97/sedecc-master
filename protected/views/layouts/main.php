<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>SEDECC</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/icon.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />
  <link rel="stylesheet" href="css/difusion.css" type="text/css" />
  <link rel="stylesheet" href="js/calendar/bootstrap_calendar.css" type="text/css" />
  <script src="js/jquery.min.js"></script>
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
  <style>
    .marg{
          padding-left: 0px !important;
          padding-right: 0px !important;
        }
  	.grid-view .summary{
  		display:none;
  	}
  	/* .form-control{
  		text-transform: uppercase;
  	} */
    .letraB{
      color:white;
    }
.aside-md li a:hover,
    .aside-md li ul li a:hover,
    .aside-md li:hover,
    .aside-md li ul li:hover
    {
      background: #219ebd !important;
    }
    body{
    	  background-image: url(img/2.jpg);
          background-size: 100% 100%;
    }
    .menuBorder{
      width: 280px !important;
      border-radius: 0px 30px 30px 0px !important;
    }
    .paddli{
      padding-top: 2px;
      padding-bottom: 2px;
    }

    .active a {
    background-color: #e6b548 !important;
}
.button-column a img{
	width:25px; height: 25px;
}

.errorMessage{
	background:#C9302C;
	color:#ffffff;
	padding:3px;
	font-size:8pt;
	line-height: 12px;
}
#imagencriterio{
  text-align: left;
  width: 1100px;
  background-color: #eee;
  display: block;
  margin-left: auto;
  margin-right: auto;
}
.aside-md {
    width: 246px !important;
}
  </style>


</head>
<body class="">
  <section class="vbox" >
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow" style="background-color: #e6b548;">
      <div class="navbar-header aside-md dk" style="width:10%;">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="index.php" class="navbar-brand">
          <!--img src="images/logo.png" style="padding:10px; max-height:60px;"-->
          <img src="img/logo-web.png">
          <!-- <span class="hidden-nav-xs"><?php echo CHtml::encode(Yii::app()->name); ?></span> -->
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm pull-left" style="width: 70px; height: 40px; margin-top: -10px; padding-right: 5px;">
            <?php
											$where = "";
											extract($_GET);
											$u = 0;
											if (Yii::app()->controller->usertype() == 1) {
			    //echo 'Empresa';
												$u = Yii::app()->user->id;

											}
											if (Yii::app()->controller->usertype() == 2) {
												$u = isset($_GET['eess']) ? $_GET['eess'] : Yii::app()->user->id;
											}
											if (Yii::app()->controller->usertype() == 3) {
			    //echo 'Evaluador';
												$u = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '" . Yii::app()->user->id . "'")->queryScalar();
											}
											if (!isset($u)) {
												header('Location: index.php?r=site/login');
											}
            // Lógica logo
											$dir = 'images/eess/';
											$flag = 0;
			// Intentar obtener logo si el usuario es EESS
											$directorio = opendir($dir);
											while ($archivo = readdir($directorio))
												if ($archivo == Yii::app()->user->id . '.jpg') {
												echo '<img src="' . $dir . $archivo . '" style="width:100%; height: 100%;">';
												$flag = 1;
											}
											closedir($directorio);
			// Intentar obtener logo si el usuario es trabajador
											$directorio = opendir($dir);
											if ($flag != 1) {
												$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '" . Yii::app()->user->id . "'")->queryScalar();
												while ($archivo = readdir($directorio))
													if ($archivo == $eess . '.jpg') {
													echo '<img src="' . $dir . $archivo . '" style="width:100%; height: 100%;">';
													$flag = 1;
												}
												closedir($directorio);
											}
			// Logo default
											if ($flag != 1) echo '<img src="https://cdn2.iconfinder.com/data/icons/rcons-user/32/male-circle-512.png" align="right" style="width:50px; height: 100%;">';
											?>

            </span>
            <?php
            // Lógica nombre de usuario
											$nombre = Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '" . Yii::app()->user->id . "'")->queryScalar();
											if ($nombre == '') $nombre = Yii::app()->db->createCommand("SELECT tra_nombres FROM min_trabajador WHERE tra_rut = '" . Yii::app()->user->id . "'")->queryScalar();
											if ($nombre == '') $nombre = Yii::app()->user->id;
											echo $nombre;
											?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <li>
              <a href="index.php?r=site/logout">Salir</a>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black aside-md hidden-print  scrollable" id="nav" style="background-color: #217fbd; color: white;">
          <section class="vbox ">

          <!--
          <section class="w-f scrollable">
          <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
          -->

            <section class="w-f">
          <div data-height="100%" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">



                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <!--div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Start</div-->
                  <ul class="nav nav-main" data-ride="collapse">
                  	<?php
																		$linkepp = '';
                  	// Menú activo
																		function active($menu)
																		{
																			if (!isset($_GET['r'])) {
																				if ($menu == '') return 'active';
																			} else {
																				if ($menu != '' && strpos($_GET['r'], $menu) !== false) {
              								//echo $_GET['r'];
																					return 'active';
																				} elseif ($menu != '' && $_GET['r'] == 'site/page' && strpos($_GET['view'], $menu) !== false) {
              								//echo $_GET['r'].$_GET['view'];
																					return 'active';
																				}

																			}
																			return '';
																		}
																		if (Yii::app()->user->id == '78264940' || Yii::app()->user->id == 'admin' || (isset($eess) && $eess == '78264940')) {
																			$linkepp = '
	              		<li>
	              			<a href="../cortealto/index.php?r=site/login&token=' . base64_encode(Yii::app()->user->id) . '" class="menuBorder" target="_blank">
	              				<img src="img/config.png" width="7%;" class="paddli">
	                        	<span class="font-bold letraB">EPP / Capacitación</span>
	                        </a>
	              		</li>
						';
																		}
					
					
					
					//JORQUERA ACCIDENTE
																		$accidente = '';
																		$variableEvaluacion = '';
																		$excesosVelocidad = '';
																		if (Yii::app()->user->id == '79620090') {
																			$accidente = '<li class="' . active('accidente') . '">
                      <a href="index.php?r=accidente" class="menuBorder">
                        <img src="img/faena.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Accidente</span>
                      </a>
                    </li>                
                    ';
					/*$excesosVelocidad = '<li class="'.active('excesosVelocidad').'">
                      <a href="index.php?r=accidente" class="menuBorder">
                        <img src="img/faena.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Excesos de Velocidad</span>
                      </a>
                    </li>                
                    ';*/
																			$variableEvaluacion = '<li class="' . active('variableEvaluacion') . '">
                      <a href="index.php?r=variableEvaluacion" class="menuBorder">
                        <img src="img/faena.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Variables Evaluación</span>
                      </a>
                    </li>                
                    ';
																		} else {
																			$accidente = '';
																			$variableEvaluacion = '';
																		}

																		$francoNova = '';
																		if (Yii::app()->user->id == '76670135' || Yii::app()->controller->usertype() == 2) {
																			$francoNova = '	<li class="' . active('bitacora2') . '">
                      <a href="index.php?r=site/page&view=bitacora2" class="menuBorder">
                        <img src="img/grafico.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Bitacoras</span>
                      </a>
                    </li>';
																		} else {
																			$francoNova = '';
																		}
																		$reporteEquipo = '';
																		if (Yii::app()->controller->usertype() == 2) {
																			$reporteEquipo .= '<li class="' . active('reporteEquipo') . '">
	                      <a href="index.php?r=site/page&view=reporteEquipo" class="menuBorder" style="background-color:#1f6a9b!important; background:white;">
	                        <img src="img/009-bar-chart.png" width="7%;" class="paddli">
	                        <span>Reporte de Equipos</span>
	                      </a>
	                    </li>';
																		} else {
																			$rows = Yii::app()->db->createCommand("SELECT * FROM min_evaluacion_equipos WHERE eess_rut =" . $u . " ")->query()->readAll();
																			if (count($rows) > 1) {
																				$reporteEquipo .= '<li class="' . active('reporteEquipo') . '">
		                      <a href="index.php?r=site/page&view=reporteEquipo" class="menuBorder" style="background-color:#1f6a9b!important; background:white;"> 
		                        <img src="img/009-bar-chart.png" width="7%;" class="paddli">
		                        <span>Reporte de Equipos</span>
		                      </a>
		                    </li>';
																			}

																		}
												
					
					// Empresa
																		if (Yii::app()->controller->usertype() == 1) {
						//CICLO PARA COMPROBAR SI LA EESS TIENE EVALUACIONES, YA SEA TRABAJADOR, EQUIPO O INSTALACIÓN
																			$evaluacionTrabajador = '';
																			$evaluacionEquipo = '';
																			$evaluacionInstalacion = '';
																			$reporteEquipo = '';
																			$reporteTrabajador = '';
																			$reporteInstalacion = '';
																			$indicadorEquipo = '';
																			$indicadorTrabajador = '';
																			$indicadorInstalacion = '';
																			$countEvaluacionTrabajadores = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion
						WHERE eess_rut = '" . Yii::app()->user->id . "' ")->queryScalar();
																			$countEvaluacionEquipos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion_equipos
						WHERE eess_rut = '" . Yii::app()->user->id . "' ")->queryScalar();
																			$countEvaluacionInstalaciones = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion_instalaciones
						WHERE eess_rut = '" . Yii::app()->user->id . "' ")->queryScalar();
																			if ($countEvaluacionTrabajadores > 0) {
																				$evaluacionTrabajador .= '
			              				<li class="' . active('evaluacion') . '"> 
			              					<a href="index.php?r=evaluacion" class="auto" style="background-color:#1f6a9b!important; background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli">
			              						<span>Evaluaciones de trabajadores</span> 
			              					</a> 
			              				</li> ';
																				$reporteTrabajador .= '
			              				<li class="' . active('reporte2') . '"> 
			              					<a href="index.php?r=site/page&view=reporte2" class="auto" style="background-color:#1f6a9b!important; background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli">
			              						<span>Reporte de Trabajadores</span> 
			              					</a> 
			              				</li> ';
																				$indicadorTrabajador .= '
			              				<li class="' . active('') . '">
					                      <a href="index.php" class="auto" style="background-color:#1f6a9b!important; background:white;">
					                        <img src="img/grafico.png" width="7%;" class="paddli">
					                        <span class="">Indicadores Trabajadores</span>
					                      </a>
					                    </li>';
																			}
																			if ($countEvaluacionEquipos > 0) {
																				$evaluacionEquipo .= '
			              				<li class="' . active('evaEquipos') . '"> 
			              					<a href="index.php?r=evaEquipos" class="auto" style="background-color:#1f6a9b!important;background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli">
			              						<span>Evaluaciones de Equipos</span> 
			              					</a> 
			              				</li> ';
																				$reporteEquipo .= '
			              				<li class="' . active('reporteEquipo') . '">
					                      <a href="index.php?r=site/page&view=reporteEquipo" class="menuBorder" style="background-color:#1f6a9b!important; background:white;">
					                        <img src="img/009-bar-chart.png" width="7%;" class="paddli">
					                        <span>Reporte de Equipos</span>
					                      </a>
					                    </li>';
																				$indicadorEquipo .= '
			              				<li class="' . active('index') . '">
				                      		<a href="index.php?r=site/page&view=index" style="background-color:#1f6a9b!important; background:white; class="menuBorder">
				                        		<img src="img/grafico.png" width="7%;" class="paddli">
				                        		<span class="">Indicadores Equipos</span>
				                      		</a>
				                    	</li> ';
																			}
																			if ($countEvaluacionInstalaciones > 0) {
																				$evaluacionInstalacion .= '
			              				<li class="' . active('evalInstalaciones') . '"> 
			              					<a href="index.php?r=evalInstalaciones" class="auto" style="background-color:#1f6a9b!important;background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli"> 
			              						<span>Evaluaciones de Instalaciones</span> 
			              					</a> 
			              				</li>';
																				$reporteInstalacion .= '
			              					<li class="' . active('reporteInstalaciones') . '">
					                      <a href="index.php?r=site/page&view=reporteInstalaciones" class="menuBorder" style="background-color:#1f6a9b!important; background:white;"> 
					                        <img src="img/009-bar-chart.png" width="7%;" class="paddli">
					                        <span>Reporte de Instalaciones</span>
					                      </a>
					                    </li>';
																				$indicadorInstalacion .= '
			              					<li class="' . active('indicadorInstalaciones') . '">
																<a href="index.php?r=site/page&view=indicadorInstalaciones" style="background-color:#1f6a9b!important; background:white; class="menuBorder">
																	<img src="img/grafico.png" width="7%;" class="paddli">
																	<span class="">Indicadores Instalaciones</span>
																</a>
				                    	</li> ';
																			}
																			$vehiculo = '';
																			if (Yii::app()->user->id == '76520410') {
																				$vehiculo .= '<li class="' . active('vehiculo') . '">
		                      <a href="index.php?r=vehiculo" class="menuBorder">
		                        <img src="img/faena.png" width="7%;" class="paddli">
		                        <span class="font-bold letraB">Vehículos</span>
		                      </a>
		                    </li>';
																			}
																			$accidente = '';
																			if (Yii::app()->user->id == '76458497' || Yii::app()->user->id == '76520410') {
																				$accidente .= '<li class="' . active('accidente') . '">
		                      <a href="index.php?r=accidente" class="menuBorder">
		                        <img src="img/faena.png" width="7%;" class="paddli">
		                        <span class="font-bold letraB">Accidente</span>
		                      </a>
		                    </li>';
																				$excesosVelocidad .= '<li class="' . active('excesosVelocidad') . '">
							                      <a href="index.php?r=excesosVelocidad" class="menuBorder">
							                        <img src="img/faena.png" width="7%;" class="paddli">
							                        <span class="font-bold letraB">Excesos de Velocidad</span>
							                      </a>
							                    </li>';
																			}
																			$variablesEvaluacion = '';
																			if (Yii::app()->user->id == '76458497' || Yii::app()->user->id == '76520410' || Yii::app()->user->id == '77543980' || Yii::app()->user->id == '76156347' || Yii::app()->user->id == '79620090' || Yii::app()->user->id == '76474505' || Yii::app()->user->id == '76170580' || Yii::app()->user->id == '76136587' || Yii::app()->user->id == '78057000') {
																				$variablesEvaluacion .= '<li class="' . active('variableEvaluacion') . '">
		                      <a href="index.php?r=variableEvaluacion" class="menuBorder">
		                        <img src="img/faena.png" width="7%;" class="paddli">
		                        <span class="font-bold letraB">Variables de Evaluación</span>
		                      </a>
		                    </li>';
																			}
						 
						//MECHARV
																			if (Yii::app()->user->id == '96960670') {
																				$amecharv = '	<li class="">
			                        	<a href="index.php?r=equipos" class="menuBorder">
			                          		<img src="img/007-edit.png" width="7%;" class="paddli">
			                          		<span class="font-bold letraB">Equipos</span>
			                        	</a>
			                      	</li>
			                      	<li class="' . active('reunion') . '">
			                      		<a href="index.php?r=site/page&view=reunion" class="menuBorder">
			                        		<img src="img/grafico.png" width="7%;" class="paddli">
			                        		<span class="font-bold letraB">Bitacoras</span>
			                      		</a>
			                    	</li>' . $indicadorTrabajador . $indicadorEquipo . $indicadorInstalacion;
																				echo '
			                    <li class="' . active('faena') . '">
			                      <a href="index.php?r=faena" class="menuBorder">
			                        <img src="img/faena.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Faenas</span>
			                      </a>
			                    </li>	
			                    <li class="' . active('trabajador') . '">
			                      <a href="index.php?r=trabajador" class="menuBorder">
			                        <img src="img/trabajador.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Trabajadores</span>
			                      </a>
			                    </li>';

																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liEval"> 
			              			<a href="#" class="menuBorder"> 
			              				<span class="pull-right text-muted" style="margin-right:40px;">
			              					<span class="fa fa-angle-down" style="color:white;"></span>
			              				</span>
			              				<img src="img/EESS.png" width="7%;" class="paddli">
			                        	<span class="font-bold letraB">Evaluaciones</span>
			              			</a> 
			              			<ul class="nav dk" style="display: none;" id="ulEval"> '
																						. $evaluacionTrabajador . $evaluacionEquipo . $evaluacionInstalacion .
																						'</ul> 
			              		</li>';
																				}
																				echo '
			                   ' . $francoNova . '
			                   ' . $amecharv . '
			                   <li class="' . active('mapa') . '">
			                      <a href="index.php?r=site/page&view=mapa" class="menuBorder">
			                        <img src="img/map.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Mapa</span>
			                      </a>
			                    </li>';

																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liReportes"> 
				              			<a href="#" class="menuBorder"> 
				              				<span class="pull-right text-muted" style="margin-right:40px;">
				              					<span class="fa fa-angle-down" style="color:white;"></span>
				              				</span>
				              				<img src="img/EESS.png" width="7%;" class="paddli">
				                        	<span class="font-bold letraB">Reportes</span>
				              			</a> 
				              			<ul class="nav dk" style="display: none;" id="ulReporte">  '
																						. $reporteTrabajador . '' . $reporteEquipo . '' . $reporteInstalacion .
																						'</ul> 
				              		</li>';
																				}

																				echo '
			                    <li class="' . active('eess') . '">
			                      <a href="index.php?r=eess/update&id=' . Yii::app()->user->id . '" class="menuBorder">
			                        <img src="img/trabajador.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Perfil</span>
			                      </a>
			                    </li>
			                    <li>
			              			<a href="#" data-toggle="modal" data-target="#criterio" class="menuBorder">
			              				<img src="img/config.png" width="7%;" class="paddli">
			                        	<span class="font-bold letraB">Criterios de calificación</span>
			                        </a>
			              		</li>
			                    ' . $linkepp . '
			                    ';
																			} else {
																				$amecharv = '';
																				echo '<li class="liEval"> 
											<a href="#" class="menuBorder"> 
												<span class="pull-right text-muted" style="margin-right:40px;">
													<span class="fa fa-angle-down" style="color:white;"></span>
												</span>
												<img src="img/grafico.png" width="7%;" class="paddli">
												<span class="font-bold letraB">Indicadores</span>
											</a> 
											<ul class="nav dk" style="display: none;" id="ulIndi"> '
																					. $indicadorTrabajador . $indicadorEquipo . $indicadorInstalacion .
																					'</ul> 
										</li>';

																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liReportes"> 
																<a href="#" class="menuBorder"> 
																	<span class="pull-right text-muted" style="margin-right:40px;">
																		<span class="fa fa-angle-down" style="color:white;"></span>
																	</span>
																	<img src="img/EESS.png" width="7%;" class="paddli">
																			<span class="font-bold letraB">Reportes</span>
																</a> 
																<ul class="nav dk" style="display: none;" id="ulReporte">  '
																						. $reporteTrabajador . $reporteEquipo . $reporteInstalacion .
																						'</ul> 
															</li>';
																				}
																				echo '<!--li>
			                      <a href="index.php?r=area" class="menuBorder ' . active('area') . '">
			                        <i class="i i-statistics icon"></i>
			                        <span class="font-bold letraB">Áreas</span>
			                      </a>
			                    </li-->
			                    <!--li>
			                      <a href="index.php?r=cargo" class="menuBorder">
			                        <i class="i i-statistics icon"></i>
			                        <span class="font-bold letraB">Cargos</span>
			                      </a>
			                    </li-->
			                    <!--li class="' . active('fundo') . '">
			                      <a href="index.php?r=fundo" class="menuBorder">
			                        <img src="img/fundo.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Fundos</span>
			                      </a>
			                    </li-->
			                    <li class="' . active('faena') . '">
			                      <a href="index.php?r=faena" class="menuBorder">
			                        <img src="img/faena.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Faenas</span>
			                      </a>
			                    </li>' . $vehiculo . '' . $accidente . '' . $variablesEvaluacion . '' . $excesosVelocidad . '
			
			                    <li class="' . active('trabajador') . '">
			                      <a href="index.php?r=trabajador" class="menuBorder">
			                        <img src="img/trabajador.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Trabajadores</span>
			                      </a>
			                    </li>';

																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liEval"> 
				              			<a href="#" class="menuBorder"> 
				              				<span class="pull-right text-muted" style="margin-right:40px;">
				              					<span class="fa fa-angle-down" style="color:white;"></span>
				              				</span>
				              				<img src="img/EESS.png" width="7%;" class="paddli">
				                        	<span class="font-bold letraB">Evaluaciones</span>
				              			</a> 
				              			<ul class="nav dk" style="display: none;" id="ulEval"> '
																						. $evaluacionTrabajador . $evaluacionEquipo . $evaluacionInstalacion .
																						'</ul> 
				              		</li>';
																				}
																				echo '
			                   ' . $francoNova . '
			                   ' . $amecharv . '
			                   <li class="' . active('mapa') . '">
			                      <a href="index.php?r=site/page&view=mapa" class="menuBorder">
			                        <img src="img/map.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Mapa</span>
			                      </a>
			                    </li>';

																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liReportes"> 
				              			<a href="#" class="menuBorder"> 
				              				<span class="pull-right text-muted" style="margin-right:40px;">
				              					<span class="fa fa-angle-down" style="color:white;"></span>
				              				</span>
				              				<img src="img/EESS.png" width="7%;" class="paddli">
				                        	<span class="font-bold letraB">Reportes</span>
				              			</a> 
				              			<ul class="nav dk" style="display: none;" id="ulReporte">  '
																						. $reporteTrabajador . $reporteEquipo . $reporteInstalacion .
																						'</ul> 
				              		</li>';
																				}

																				echo '
			                    <li class="' . active('eess') . '">
			                      <a href="index.php?r=eess/update&id=' . Yii::app()->user->id . '" class="menuBorder">
			                        <img src="img/trabajador.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Perfil</span>
			                      </a>
			                    </li>
			                    <li>
			              			<a href="#" data-toggle="modal" data-target="#criterio" class="menuBorder">
			              				<img src="img/config.png" width="7%;" class="paddli">
			                        	<span class="font-bold letraB">Criterios de calificación</span>
			                        </a>
			              		</li> 
			                    ' . $linkepp . '
			                    ';
																			}
																		}
                  	
					// Admin
																		if (Yii::app()->controller->usertype() == 2) echo '
                  	<li class="' . active('') . '">
                      <a href="index.php" class="menuBorder">
                        <img src="img/012-construction.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Indicadores Trabajadores</span>
                      </a>
                    </li>
                    <li class="' . active('indicadorInstalaciones') . '">
											<a href="index.php?r=site/page&view=indicadorInstalaciones" class="menuBorder">
												<img src="img/grafico.png" width="7%;" class="paddli">
												<span class="font-bold letraB">Indicadores Instalaciones</span>
											</a>
										</li>
										<li class="' . active('index') . '">
												<a href="index.php?r=site/page&view=index" class="menuBorder">
													<img src="img/grafico.png" width="7%;" class="paddli">
													<span class="font-bold letraB">Indicadores Equipos</span>
												</a>
										</li> 
                    <!--li class="' . active('area') . '">
                      <a href="index.php?r=area" class="menuBorder">
                        <img src="img/012-construction.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Áreas</span>
                      </a>
                    </li-->
                    <li class="' . active('cargo') . '">
                      <a href="index.php?r=cargo" class="menuBorder">
                        <img src="img/cargos.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Cargos</span>
                      </a>
                    </li>
                    <li class="' . active('eess') . '">
                      <a href="index.php?r=eess" class="menuBorder">
                        <img src="img/EESS.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Empresas de servicio</span>
                      </a>
                    </li>
                    <li class="liEval"> 
              			<a href="#" class="menuBorder"> 
              				<span class="pull-right text-muted" style="margin-right:40px;">
              					<span class="fa fa-angle-down" style="color:white;"></span>
              				</span>
              				<img src="img/EESS.png" width="7%;" class="paddli">
                        	<span class="font-bold letraB">Evaluaciones</span>
              			</a> 
              			<ul class="nav dk" style="display: none;" id="ulEval"> 
              				<li class="' . active('evaluacion') . '"> 
              					<a href="index.php?r=evaluacion" class="auto" style="background-color:#1f6a9b!important; background:white;"> 
              						<img src="img/EESS.png" width="7%;" class="paddli">
              						<span>Evaluaciones de trabajadores</span> 
              					</a> 
              				</li> 
              				<li class="' . active('evaEquipos') . '"> 
              					<a href="index.php?r=evaEquipos" class="auto" style="background-color:#1f6a9b!important;background:white;"> 
              						<img src="img/EESS.png" width="7%;" class="paddli">
              						<span>Evaluaciones de Equipos</span> 
              					</a> 
              				</li> 
              				<li class="' . active('evalInstalaciones') . '"> 
              					<a href="index.php?r=evalInstalaciones" class="auto" style="background-color:#1f6a9b!important;background:white;"> 
              						<img src="img/EESS.png" width="7%;" class="paddli"> 
              						<span>Evaluaciones de Instalaciones</span> 
              					</a> 
              				</li> 
              			</ul> 
              		</li>  
                    <li class="' . active('reunion') . '">
                      <a href="index.php?r=site/page&view=reunion" class="menuBorder">
                        <img src="img/grafico.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Bitacoras-Mecharv</span>
                      </a>
                    </li>
                    ' . $francoNova . '
                    <li class="' . active('pregunta') . '">
                      <a href="index.php?r=pregunta" class="menuBorder">
                        <img src="img/preguntas.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Preguntas</span>
                      </a>
                    </li>
                    <!--li class="' . active('tematica') . '">
                      <a href="index.php?r=tematica" class="menuBorder">
                        <img src="img/tematica.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Temáticas</span>
                      </a>
                    </li-->
                    <li class="' . active('trabajador') . '">
                      <a href="index.php?r=trabajador" class="menuBorder">
                        <img src="img/trabajador.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Trabajadores</span>
                      </a>
                    </li>
                    <!--li class="' . active('evento') . '">
                      <a href="index.php?r=evento" class="menuBorder">
                        <img src="img/trabajador.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Accidentes / Incidentes</span>
                      </a>
                    </li-->
                    <li class="' . active('fundo') . '">
                      <a href="index.php?r=fundo" class="menuBorder">
                        <img src="img/fundo.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Fundos</span>
                      </a>
                    </li>
                    <li class="' . active('faena') . '">
                      <a href="index.php?r=faena" class="menuBorder">
                        <img src="img/faena.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Faenas</span>
                      </a>
                    </li>
                    <li class="' . active('vehiculo') . '">
                      <a href="index.php?r=vehiculo" class="menuBorder">
                        <img src="img/faena.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Vehículos</span>
                      </a>
                    </li>
                    <li class="' . active('accidente') . '">
                      <a href="index.php?r=accidente" class="menuBorder">
                        <img src="img/faena.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Accidente</span>
                      </a>
                    </li>
                    <li class="' . active('excesosVelocidad') . '">
                      <a href="index.php?r=excesosVelocidad" class="menuBorder">
                        <img src="img/faena.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Excesos de Velocidad</span>
                      </a>
                    </li>
                    <li class="' . active('usuario') . '">
                      <a href="index.php?r=usuario" class="menuBorder">
                        <img src="img/004-user.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Usuarios</span>
                      </a>
                    </li>
                    <li class="' . active('mapa') . '">
                      <a href="index.php?r=site/page&view=mapa" class="menuBorder">
                        <img src="img/map.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Mapa</span>
                      </a>
                    </li>
                    <li class="liReportes"> 
              			<a href="#" class="menuBorder"> 
              				<span class="pull-right text-muted" style="margin-right:40px;">
              					<span class="fa fa-angle-down" style="color:white;"></span>
              				</span>
              				<img src="img/EESS.png" width="7%;" class="paddli">
                        	<span class="font-bold letraB">Reportes</span>
              			</a> 
              			<ul class="nav dk" style="display: none;" id="ulReporte"> 
              				<li class="' . active('reporte2') . '"> 
              					<a href="index.php?r=site/page&view=reporte2" class="auto" style="background-color:#1f6a9b!important; background:white;"> 
              						<img src="img/EESS.png" width="7%;" class="paddli">
              						<span>Reporte de Trabajadores</span> 
              					</a> 
              				</li> 
              				' . $reporteEquipo . '
              				<li class="' . active('reporteInstalaciones') . '">
		                      <a href="index.php?r=site/page&view=reporteInstalaciones" class="menuBorder" style="background-color:#1f6a9b!important; background:white;"> 
		                        <img src="img/009-bar-chart.png" width="7%;" class="paddli">
		                        <span>Reporte de Instalaciones</span>
		                      </a>
		                    </li>
              			</ul> 
              		</li>  
                    <li class="' . active('configuracion') . '">
                      <a href="index.php?r=site/page&view=configuracion" class="menuBorder">
                        <img src="img/config.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Configuración</span>
                      </a>
                    </li>
                    <li class="' . active('asignarVariableEval') . '">
                      <a href="index.php?r=site/page&view=asignarVariableEval" class="menuBorder">
                        <img src="img/config.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Configuración de Variables</span>
                      </a>
                    </li>
                    <li class="' . active('formularios') . '">
                      <a href="index.php?r=formularios" class="menuBorder">
                        <img src="img/config.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Formularios Checklist</span>
                      </a>
                    </li>
					<li class="' . active('formulariobitacora') . '">
                      <a href="index.php?r=formulariobitacora" class="menuBorder">
                        <img src="img/config.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Formularios Bitácora</span>
                      </a>
                    </li>
                    <li>
              			<a href="#" data-toggle="modal" data-target="#criterio" class="menuBorder">
              				<img src="img/config.png" width="7%;" class="paddli">
                        	<span class="font-bold letraB">Criterios de calificación</span>
                        </a>
              		</li> 
              		' . $linkepp . '             		          		
                  	';
					// Evaluador
																		if (Yii::app()->controller->usertype() == 3) {
						
						//CICLO PARA COMPROBAR SI LA EESS TIENE EVALUACIONES, YA SEA TRABAJADOR, EQUIPO O INSTALACIÓN
																			$evaluacionTrabajador = '';
																			$evaluacionEquipo = '';
																			$evaluacionInstalacion = '';
																			$reporteEquipo = '';
																			$reporteTrabajador = '';
																			$reporteInstalacion = '';
																			$indicadorEquipo = '';
																			$indicadorTrabajador = '';
																			$indicadorInstalacion = '';
																			$countEvaluacionTrabajadores = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion
						WHERE eess_rut = '" . $u . "' ")->queryScalar();
																			$countEvaluacionEquipos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion_equipos
						WHERE eess_rut = '" . $u . "' ")->queryScalar();
																			$countEvaluacionInstalaciones = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion_instalaciones
						WHERE eess_rut = '" . $u . "' ")->queryScalar();
																			if ($countEvaluacionTrabajadores > 0) {
																				$evaluacionTrabajador .= '
			              				<li class="' . active('evaluacion') . '"> 
			              					<a href="index.php?r=evaluacion" class="auto" style="background-color:#1f6a9b!important; background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli">
			              						<span>Evaluaciones de trabajadores</span> 
			              					</a> 
			              				</li> ';
																				$reporteTrabajador .= '
			              				<li class="' . active('reporte2') . '"> 
			              					<a href="index.php?r=site/page&view=reporte2" class="auto" style="background-color:#1f6a9b!important; background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli">
			              						<span>Reporte de Trabajadores</span> 
			              					</a> 
			              				</li> ';
																				$indicadorTrabajador .= '
			              				<li class="' . active('') . '">
															<a href="index.php" class="menuBorder active">
																<img src="img/012-construction.png" width="7%;" class="paddli">
																<span class="font-bold letraB">Indicadores Trabajadores</span>
															</a>
														</li>';
																			}
																			if ($countEvaluacionEquipos > 0) {
																				$evaluacionEquipo .= '
			              				<li class="' . active('evaEquipos') . '"> 
			              					<a href="index.php?r=evaEquipos" class="auto" style="background-color:#1f6a9b!important;background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli">
			              						<span>Evaluaciones de Equipos</span> 
			              					</a> 
			              				</li> ';
																				$reporteEquipo .= '
			              				<li class="' . active('reporteEquipo') . '">
					                      <a href="index.php?r=site/page&view=reporteEquipo" class="menuBorder" style="background-color:#1f6a9b!important; background:white;">
					                        <img src="img/009-bar-chart.png" width="7%;" class="paddli">
					                        <span>Reporte de Equipos</span>
					                      </a>
					                    </li>';
																				$indicadorEquipo .= '
			              				<li class="' . active('index') . '">
				                      		<a href="index.php?r=site/page&view=index" class="menuBorder">
				                        		<img src="img/grafico.png" width="7%;" class="paddli">
				                        		<span class="font-bold letraB">Indicadores Equipos</span>
				                      		</a>
				                    	</li> ';
																			}
																			if ($countEvaluacionInstalaciones > 0) {
																				$evaluacionInstalacion .= '
			              				<li class="' . active('evalInstalaciones') . '"> 
			              					<a href="index.php?r=evalInstalaciones" class="auto" style="background-color:#1f6a9b!important;background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli"> 
			              						<span>Evaluaciones de Instalaciones</span> 
			              					</a> 
			              				</li>';
																				$reporteInstalacion .= '
			              				<li class="' . active('reporteInstalaciones') . '">
					                      <a href="index.php?r=site/page&view=reporteInstalaciones" class="menuBorder" style="background-color:#1f6a9b!important; background:white;"> 
					                        <img src="img/009-bar-chart.png" width="7%;" class="paddli">
					                        <span>Reporte de Instalaciones</span>
					                      </a>
					                    </li>';
																				$indicadorInstalacion .= '
			              				<li class="' . active('indicadorInstalaciones') . '">
				                      		<a href="index.php?r=site/page&view=indicadorInstalaciones" class="menuBorder">
				                        		<img src="img/grafico.png" width="7%;" class="paddli">
				                        		<span class="font-bold letraB">Indicadores Instalaciones</span>
				                      		</a>
				                    	</li> ';
																			}

																			if ($u == '96960670') {
																				echo $indicadorTrabajador . $indicadorEquipo . $indicadorInstalacion . '
			                  	
			                    <li class="' . active('trabajador') . '">
			                      <a href="index.php?r=trabajador" class="menuBorder">
			                        <img src="img/trabajador.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Trabajadores</span>
			                      </a>
			                    </li>';
																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liEval"> 
				              			<a href="#" class="menuBorder"> 
				              				<span class="pull-right text-muted" style="margin-right:40px;">
				              					<span class="fa fa-angle-down" style="color:white;"></span>
				              				</span>
				              				<img src="img/EESS.png" width="7%;" class="paddli">
				                      <span class="font-bold letraB">Evaluaciones</span>
				              			</a> 
				              			<ul class="nav dk" style="display: none;" id="ulEval"> '
																						. $evaluacionTrabajador . $evaluacionEquipo . $evaluacionInstalacion .
																						'</ul> 
				              		</li>';
																				}
																				echo '
			                    ' . $francoNova . '
			                    <li class="' . active('mapa') . '">
			                      <a href="index.php?r=site/page&view=mapa" class="menuBorder">
			                        <img src="img/map.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Mapa</span>
			                      </a>
			                    </li>
			                    <li class="liReportes"> 
			              			<a href="#" class="menuBorder"> 
			              				<span class="pull-right text-muted" style="margin-right:40px;">
			              					<span class="fa fa-angle-down" style="color:white;"></span>
			              				</span>
			              				<img src="img/EESS.png" width="7%;" class="paddli">
			                        	<span class="font-bold letraB">Reportes</span>
			              			</a> 
			              			<ul class="nav dk" style="display: none;" id="ulReporte"> 
			              				<li class="' . active('reporte2') . '"> 
			              					<a href="index.php?r=site/page&view=reporte2" class="auto" style="background-color:#1f6a9b!important; background:white;"> 
			              						<img src="img/EESS.png" width="7%;" class="paddli">
			              						<span>Reporte de Trabajadores</span> 
			              					</a> 
			              				</li> 
			              				' . $reporteEquipo . '
			              				
			              				
			              			</ul> 
			              		</li> 
			                  	';
																			} else {
																				echo $indicadorTrabajador . $indicadorEquipo . $indicadorInstalacion . '
			                    <!--li class="' . active('area') . '">
			                      <a href="index.php?r=area letraB" class="menuBorder">
			                        <img src="img/012-construction.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Áreas</span>
			                      </a>
			                    </li-->
			                    <!--li class="' . active('cargo') . '">
			                      <a href="index.php?r=cargo" class="menuBorder">
			                        <img src="img/012-construction.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Cargos</span>
			                      </a>
			                    </li-->
			                    <!--
			                    <li class="' . active('faena') . '">
			                      <a href="index.php?r=faena" class="menuBorder">
			                        <img src="img/faena.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Faenas</span>
			                      </a>
			                    </li>
			                    -->
			                    <li class="' . active('trabajador') . '">
			                      <a href="index.php?r=trabajador" class="menuBorder">
			                        <img src="img/trabajador.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Trabajadores</span>
			                      </a>
			                    </li>';
																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liEval"> 
				              			<a href="#" class="menuBorder"> 
				              				<span class="pull-right text-muted" style="margin-right:40px;">
				              					<span class="fa fa-angle-down" style="color:white;"></span>
				              				</span>
				              				<img src="img/EESS.png" width="7%;" class="paddli">
				                        	<span class="font-bold letraB">Evaluaciones</span>
				              			</a> 
				              			<ul class="nav dk" style="display: none;" id="ulEval"> '
																						. $evaluacionTrabajador . $evaluacionEquipo . $evaluacionInstalacion .
																						'</ul> 
				              		</li>';
																				}
																				echo '
			                    ' . $francoNova . '
			                    <li class="' . active('mapa') . '">
			                      <a href="index.php?r=site/page&view=mapa" class="menuBorder">
			                        <img src="img/map.png" width="7%;" class="paddli">
			                        <span class="font-bold letraB">Mapa</span>
			                      </a>
			                    </li>';
																				if ($countEvaluacionTrabajadores > 0 || $countEvaluacionEquipos > 0 || $countEvaluacionInstalaciones > 0) {
																					echo '<li class="liReportes"> 
				              			<a href="#" class="menuBorder"> 
				              				<span class="pull-right text-muted" style="margin-right:40px;">
				              					<span class="fa fa-angle-down" style="color:white;"></span>
				              				</span>
				              				<img src="img/EESS.png" width="7%;" class="paddli">
				                        	<span class="font-bold letraB">Reportes</span>
				              			</a> 
				              			<ul class="nav dk" style="display: none;" id="ulReporte">  '
																						. $reporteTrabajador . $reporteEquipo . $reporteInstalacion .
																						'</ul> 
				              		</li>';
																				}

																			}

																		}
																		if (Yii::app()->controller->usertype() == 4) echo '
                  	<li class="' . active('') . '">
                      <a href="index.php" class="menuBorder">
                        <img src="img/012-construction.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Indicadores Trabajadores</span>
                      </a>
                    </li>
                  	<li class="' . active('evaluacion') . '">
                      <a href="index.php?r=evaluacion" class="menuBorder">
                       <img src="img/007-edit.png" width="7%;" class="paddli">
                        <span class="font-bold letraB">Evaluaciones</span>
                      </a>
                    </li>
                    ' . $linkepp . '
                  	';
                    //
																		?>
                    <!--?php } ?-->
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            <!--
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="index.php?r=site/logout" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>

              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>

            </footer>
              -->
              <!-- Modal -->
<div class="modal fade" id="criterio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:95%;">
    <div class="modal-content">
     	<div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Metodología de Calificación</h4>
				<!--iframe src="http://docs.google.com/viewer?url=http://innoapsion.cl/mininco/images/metodologia.pdf&embedded=true    " frameborder="0" style="width:100%; height:600px; margin-bottom:-5px;">
					No hay soporte de iframes
				</iframe-->
				<img id="imagencriterio" src="https://innoapsion.cl/sedecc/img/criterio.png" width="80%" height="100%">
					<!--p>It appears you don't have a PDF plugin for this browser.
					No biggie... you can <a href="myfile.pdf">click here to
					download the PDF file.</a></p-->
  	  	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      	</div>
    	</div>
  	</div>
	</div>
</div>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content" style="padding-left:30px;">
          <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable padder" style="">
                  <?php echo $content; ?>
                </section>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
  
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
    <!--<script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="js/charts/flot/jquery.flot.min.js"></script>
  <script src="js/charts/flot/jquery.flot.tooltip.min.js"></script>
  <script src="js/charts/flot/jquery.flot.spline.js"></script>
  <script src="js/charts/flot/jquery.flot.pie.min.js"></script>
  <script src="js/charts/flot/jquery.flot.resize.js"></script>
  <script src="js/charts/flot/jquery.flot.grow.js"></script>
  <script src="js/charts/flot/demo.js"></script>

  <script src="js/calendar/bootstrap_calendar.js"></script>
  <script src="js/calendar/demo.js"></script>-->

  <script src="js/sortable/jquery.sortable.js"></script>
  <script src="js/app.plugin.js"></script>

  <h1 id="mensaje_espere" style="width:100%; position:fixed; top:30%; z-index:10000; text-align:center; display:none;">
  	<img src="http://loadinggif.com/images/image-selection/32.gif"><br><br><br>4
  	Espere mientras se genera el stock...
  </h1>

  <script type="text/javascript">
  	function quitarmarca(){
	  	var x = document.querySelectorAll('[title="JavaScript charts"]');
	  	var c = x.length;

	  	for(i=0;i<c;i++){
	  		document.querySelectorAll('[title="JavaScript charts"]')[0].remove();
	  	}
  	}
  	setTimeout(quitarmarca,100);
  </script>
  

</body>
</html>


<?php return;/* @var $this Controller */ ?>




	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu', array(
		'items' => array(
			array('label' => 'Home', 'url' => array('/site/index')),
			array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
			array('label' => 'Contact', 'url' => array('/site/contact')),
			array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
		),
	)); ?>
	</div>
	<?php if (isset($this->breadcrumbs)) : ?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links' => $this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
	<?php endif ?>



		Copyrightt &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>

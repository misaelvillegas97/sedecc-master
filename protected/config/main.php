<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema de evaluación de desempeño para Cargos Críticos',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'0000',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','*'),
		),//'186.106.237.130'
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=innoapsi_sedecc',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'prefix'=>'test_',
		'gmt'=>0,
		'limit1'=>85,
		'limit2'=>95,
		//agregamos niveles de riesgo
		//nivel bajo rango mas que 95 y a lo mas 100
		//nivel medio rango mas que 85 y a lo mas 95
		'riesgomedio'=>95,
		//nivel alto rango a lo mas 85
		'riesgoalto' =>85,
	
		'pagesize'=>150,
		//multiplicadores de ecuacion en conversion de nota
		//datos de la pendiente de la ecuación(columna M excel fórmula)
		'MalNotaBaja'=>0.0294,
		'MalNotaMedia'=>0.0667,
		'MalNotaAlta'=>0.1750,
		//resta o suma de ecuacion en conversion de nota
		//datos del intercepto de la ecuación (columna N excel fórmula)
		//estos rangos están al revés
		//rallimbajo--> límite de riesgo alto
		//rallimalto--> límite de riesgo bajo
		'RalLimBajo' => 1.0000,
		'RalLimMedio' => 2.1333,
		'RalLimAlto' => 12.5000,
		'LimiteNotaBaja' => 3.5,
		'LimiteNotaMedia' => 4.2,



	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	/*'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'prefix'=>'test_',
		'gmt'=>0,
		'limit1'=>75,
		'limit2'=>90,
		//agregamos niveles de riesgo
		//nivel bajo rango mas que 95 y a lo mas 100
		//nivel medio rango mas que 85 y a lo mas 95
		'riesgomedio'=>95,
		//nivel alto rango a lo mas 85
		'riesgoalto' =>85,
	
		'pagesize'=>150,
		//multiplicadores de ecuacion en conversion de nota
		'MalNotaBaja'=>0.0223,
		'MalNotaMedia'=>0.1,
		'MalNotaAlta'=>0.25,
		//resta o suma de ecuacion en conversion de nota
		'RalLimBajo' => 1.0045,
		'RalLimMedio' => 5.6,
		'RalLimAlto' => 20,


	),*/
);
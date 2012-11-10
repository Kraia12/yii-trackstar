<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Trackstar',
	'homeUrl'=>'project',
	'theme'=>'new',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.admin.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'about' => array('site/page','defaultParams' => array('view' => 'about')),
               // '/' => 'site/index',
                'contact' => 'site/contact',
                'login'=>array('site/login'),
                'logout'=>array('site/logout'),
                'registration'=>array('site/registration'),
                'recovery'=>array('site/recovery'),
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'<id:\d+>/commentfeed'=>array('comment/feed', 'urlSuffix'=>'.xml', 'caseSensitive'=>false),
				'commentfeed'=>array('comment/feed','urlSuffix'=>'.xml', 'caseSensitive'=>false),
			),
			'showScriptName'=>false,
		),
		'cache'=>array(
			'class'=>'system.caching.CFileCache',
		),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=trackstar_dev',
			'emulatePrepare' => true,
			'username' => 'usrtrackstar',
			'password' => 'pwdtrackstar',
			'charset' => 'utf8',
		),
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
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
				'levels'=>'error',
			),
		array(
			'class'=>'CFileLogRoute',
			'levels'=>'info, trace',
			'logFile'=>'infoMessages.log',
		),
		array(
			'class'=>'CWebLogRoute',
			'levels'=>'warning',
		),

			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
<?php 
/*
|---------------------------------------------------------------
| PHP ERROR REPORTING LEVEL
|---------------------------------------------------------------
|
| By default CI runs with error reporting set to ALL.  For security
| reasons you are encouraged to change this when your site goes live.
| For more info visit:  http://www.php.net/error_reporting
|
*/
	//error_reporting(E_ALL);
	error_reporting(0);

/*
|---------------------------------------------------------------
| SYSTEM FOLDER NAME
|---------------------------------------------------------------
|
| This variable must contain the name of your "system" folder.
| Include the path if the folder is not in the same  directory
| as this file.
|
| NO TRAILING SLASH!
|
*/
	$system_folder = "system";

/*
|---------------------------------------------------------------
| APPLICATION FOLDER NAME
|---------------------------------------------------------------
|
| If you want this front controller to use a different "application"
| folder then the default one you can set its name here. The folder 
| can also be renamed or relocated anywhere on your server.
| For more info please see the user guide:
| http://codeigniter.com/user_guide/general/managing_apps.html
|
|
| NO TRAILING SLASH!
|
*/
	$application_folder = "agent";

/*
|===============================================================
| END OF USER CONFIGURABLE SETTINGS
|===============================================================
*/


/*
|---------------------------------------------------------------
| SET THE SERVER PATH
|---------------------------------------------------------------
|
| Let's attempt to determine the full-server path to the "system"
| folder in order to reduce the possibility of path problems.
| Note: We only attempt this if the user hasn't specified a 
| full server path.
|
*/
if (strpos($system_folder, '/') === FALSE)
{
	if (function_exists('realpath') AND @realpath(dirname(__FILE__)) !== FALSE)
	{
		$system_folder = realpath(dirname(__FILE__)).'/'.$system_folder;
	}
}
else
{
	// Swap directory separators to Unix style for consistency
	$system_folder = str_replace("\\", "/", $system_folder); 
}

/*
|---------------------------------------------------------------
| DEFINE APPLICATION CONSTANTS
|---------------------------------------------------------------
|
| EXT		- The file extension.  Typically ".php"
| SELF		- The name of THIS file (typically "index.php")
| FCPATH	- The full server path to THIS file
| BASEPATH	- The full server path to the "system" folder
| APPPATH	- The full server path to the "application" folder
|
*/
define('EXT', '.php');
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('FCPATH', str_replace(SELF, '', __FILE__));
define('BASEPATH', $system_folder.'/');

if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.229' || $_SERVER['HTTP_HOST']=='192.168.0.17')
{
	//echo $_SERVER['HTTP_HOST']; exit;
	define('WEB_URL','http://'.$_SERVER['HTTP_HOST'].'/egspirit/index.php/');
	define('WEB_DIR','http://'.$_SERVER['HTTP_HOST'].'/egspirit/');
	define('WEB_URL_ADMIN',"http://".$_SERVER['HTTP_HOST']."/egspirit/admin/index.php/");
	define('WEB_DIR_ADMIN',"http://".$_SERVER['HTTP_HOST']."/egspirit/admin/");
}
/*
else
{
	define('WEB_URL','http://'.$_SERVER['HTTP_HOST'].'/index.php/');
	define('WEB_DIR','http://'.$_SERVER['HTTP_HOST'].'/');
	define('WEB_URL_ADMIN',"http://".$_SERVER['HTTP_HOST']."/admin/index.php/");
	define('WEB_DIR_ADMIN',"http://".$_SERVER['HTTP_HOST']."/admin/");
	
}




else
{ 
	define('WEB_URL','http://'.$_SERVER['HTTP_HOST'].'/index.php/');
	define('WEB_DIR','http://'.$_SERVER['HTTP_HOST'].'/');
	define('WEB_URL_ADMIN',"http://".$_SERVER['HTTP_HOST']."/index.php/");
	define('WEB_DIR_ADMIN',"http://".$_SERVER['HTTP_HOST']."/admin/");
	
}
*/
else
{ 
	define('WEB_URL','https://'.$_SERVER['HTTP_HOST'].'/index.php/');
	define('WEB_DIR','https://'.$_SERVER['HTTP_HOST'].'/');
	define('WEB_URL_ADMIN',"https://".$_SERVER['HTTP_HOST']."/index.php/");
	define('WEB_DIR_ADMIN',"https://".$_SERVER['HTTP_HOST']."/admin/");
	
}

/*define('WEB_URL','http://'.$_SERVER['HTTP_HOST'].'/Dom@2010/solcefiles/index.php/'); //Server
define('WEB_DIR','http://'.$_SERVER['HTTP_HOST'].'/Dom@2010/solcefiles/');//Server
*/


if (is_dir($application_folder))
{ 
	define('APPPATH', $application_folder.'/');
}
else
{ 
	if ($application_folder == '')
	{
		$application_folder = 'application';
	}

	define('APPPATH', BASEPATH.$application_folder.'/');
}

/*
|---------------------------------------------------------------
| LOAD THE FRONT CONTROLLER
|---------------------------------------------------------------
|
| And away we go...
|
*/
require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;

/* End of file index.php */
/* Location: ./index.php */

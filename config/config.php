<?php 

ob_start();
session_start();

$url = 'http://'.$_SERVER['HTTP_HOST'].'/';


if ($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '::1') {
	define('ENVIRONMENT', 'DEVELOPMENT');
} else {
	define('ENVIRONMENT', 'PRODUCTION');
}
if (ENVIRONMENT == "DEVELOPMENT") {
	//error_log(E_ALL);
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PWD', 'bsVRVo.4t1oM');
	define('DB_NAME', 'shikshak');
} else {
	//error_log(E_ALL); 
	define('DB_HOST', 'localhost');
	define('DB_USER', 'oxygenal_admin');
	define('DB_PWD', 'bsVRVo.4t1oM');
	define('DB_NAME', 'oxygenal_shikshak');
}

define('ALLOWED_IMAGE', array('jpg', 'jpeg', 'png', 'gif', 'bmp'));
define('ALLOWED_FILE', array('mp3', 'mp4', 'ogg', 'wav', 'mpeg', 'm4v', 'webm'));


define('ERROR_PATH', $_SERVER['DOCUMENT_ROOT'].'/error/');
define('CONFIG_PATH', $_SERVER['DOCUMENT_ROOT'].'/config/');
define('CLASS_PATH', $_SERVER['DOCUMENT_ROOT'].'/class/');

define('DSN', 'mysql:host='.DB_HOST.';dbname='.DB_NAME);

define('SITE_URL', $url);
define('ADMIN_URL', SITE_URL.'admin/');
define('ADMIN_ASSETS_URL', ADMIN_URL.'assets/');
define('ADMIN_CSS_URL', ADMIN_ASSETS_URL.'css/');
define('ADMIN_JS_URL', ADMIN_ASSETS_URL.'js/');
define('ADMIN_IMAGE_PATH', ADMIN_ASSETS_URL.'images/');
define('SITE_TITLE', 'Kinmel');
define('ADMIN_PAGE_TITLE', 'Admin kinmel');
/*define('ALLOWED_IMAGE_EXTENSION', array('jpg', 'jpeg', 'png', 'gif', 'bmp'));*/
define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/uploads/');
define('UPLOAD_URL', SITE_URL.'uploads/');

/*************Configuration for Frontend*************/
define('FRONT_ASSETS_URL', SITE_URL.'assets/');
define('FRONT_CSS_URL', FRONT_ASSETS_URL.'css/');
define('FRONT_JS_URL', FRONT_ASSETS_URL.'js/');
define('ADMIN_TINYMCE_URL', ADMIN_ASSETS_URL.'tinymce/');
define('FRONT_IMAGES_URL', FRONT_ASSETS_URL.'img/');
define('FRONT_FONTS_URL', FRONT_ASSETS_URL.'fonts/');
define('KEYWORDS', 'clothing online, nepali ecommerce, ecommerce');
define('DESCRIPTION', 'Kinmel.com is the shopping store where you can find all types of attire you want to.');
define('OG_URL', SITE_URL);
define('OG_TITLE', SITE_TITLE);
define('OG_DESCRIPTION', DESCRIPTION);
define('OG_TYPE', 'article');
define('OG_IMAGE', FRONT_IMAGES_URL.'logo.png');


/*************Configuration for Frontend*************/
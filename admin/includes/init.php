<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', DS . 'media' . DS . 'myegane49' . DS . 'storage' . DS . 'Files' . DS . 'Documents' . DS . 'projects-0' . DS . 'from-courses' . DS . 'php-oop' . DS . 'gallery');
define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

require_once('functions.php');
require_once('new_config.php');
require_once('database.php');
require_once('db_object.php');
require_once('user.php');
require_once('photo.php');
require_once('session.php');
?>
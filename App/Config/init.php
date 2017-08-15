<?php
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", $_SERVER['DOCUMENT_ROOT'].DS.'invoice-master');
define('SUB_DIR', str_replace($_SERVER['DOCUMENT_ROOT'], '', ROOT));
define('HOST', str_replace($_SERVER['DOCUMENT_ROOT'], 'http://localhost', ROOT));

require_once(ROOT.DS.'vendor'.DS.'autoload.php');

use Blab\Libs\DB;

$db = DB::getDBInstance();
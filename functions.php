<?php
require_once 'App/Config/init.php';
function asset($url = ''){

	echo SUB_DIR.DS.'App'.DS.'public'.DS.'assets'.DS.$url;
}
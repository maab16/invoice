<?php

namespace Blab\Invoice\Libs\Views;

class View
{

	protected $data;

	protected $viewPath;

	public function __construct($path=null){

		if (!file_exists($path)) {
			
			throw new \Exception("Template file isn't found in path".$path);	
		}

		$this->viewPath = $path;
	}

	public function render($filename, array $data = []){

		$this->viewPath .= DIRECTORY_SEPARATOR . $filename;

		$data = $data;

		ob_start();

		include($this->viewPath);
		$content = ob_get_clean();
		//echo $content;

		ob_clean();

		return $content;
	}
}
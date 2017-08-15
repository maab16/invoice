<?php

require_once '../../App/Config/init.php';
define("VIEWS_PATH", ROOT.DS."App".DS."views");

$sub = str_replace('\\', '/', trim(SUB_DIR));

use Blab\Invoice\Libs\Capture\Capture;

$capture = new Capture([
				'envPath'=>ROOT.'\Blab\Invoice\bin', // Set Global Path for phantomjs.exe
				// 'rootPath'=>'http://localhost/Blab/Invoice/views',
				'viewPath'=>ROOT.DS.'Blab'.DS.'Invoice'.DS.'views',
				'tempDir'=>ROOT.'/Blab/Invoice/storage',
				'captureJS'=>ROOT.'/Blab/Invoice/capture.js',// Capture javascript file path
				'capturePath'=>"http://localhost/{$sub}/Blab/Invoice/storage/",//must be use http:// or https://
			]);

$date = date('Y-m-d');

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
	$invoice = $db->query()
			->from('invoices')
			->where(['id'=>$id])
			->firstResult();

	$results = $db->query()
			->from('carts')
			->where(['invoice_id'=>$id])
			->results();

}


$capture->load("invoice.php",[
		'invoice'=>$invoice,
		'results'=>$results,
		'id'=>23596,
		'date'=>$date,
		'supplierName'=>'BITM',
		'supplierRegNo'=>29643,
		'suppilerVatNo'=>589423,
		'supplierDetails'=>'32/9, Kawran Bazar, Dhaka-1200',
		'customerName'=>'Md. Abu Ahsan Basir',
		'customerRegNo'=>167473,
		'customerVatNo'=>458234,
		'customerDetails'=>'47/19, New Chashara,Jamtola,Narayanganj',

	]);

$capture->response('invoice');
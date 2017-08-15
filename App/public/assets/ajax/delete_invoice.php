<?php

require_once '../../../Config/init.php';

$json_data['exists'] = false;


if (isset($_POST['id'])) {
	
	$json_data['exists'] = true;
	
	$id = (int)($_POST['id']);
	

	$invoice = $db->query()
			->from('invoices')
			->where(['id'=>$id])
			->delete();

	$results = $db->query()
			->from('carts')
			->where(['invoice_id'=>$id])
			->delete();
	
	$json_data['url'] = SUB_DIR.DS.'index.php';
}

echo json_encode($json_data);
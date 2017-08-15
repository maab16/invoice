<?php

	require_once '../../../Config/init.php';

	$json_data['exists'] = false;


	if (isset($_POST['item_id'])) {
		
		$json_data['exists'] = true;
		
		$id = (int)($_POST['item_id']);
		

		$item = $db->query()
				->from('items')
				->where(['id'=>$id])
				->firstResult();
		$json_data['id'] = $item->id;
		$json_data['item_name'] = $item->item_name;
		$json_data['price'] = $item->price;

	}

	echo json_encode($json_data);
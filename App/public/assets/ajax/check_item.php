<?php

	require_once '../../../Config/init.php';

	$json_data['exists'] = false;

	$json_data['html'] = "";

	if (isset($_GET['name']) && isset($_GET['value'])) {
		
		$json_data['exists'] = true;
		
		$name = strtolower(trim($_GET['name']));
		$parent = $_GET['parent'];
		$value = trim($_GET['value']);
		
		if(!empty($value))
		{
			$pattern = "%".$value."%";

			$results = $db->query()
					->from('items')
					->like('WHERE item_name LIKE', $pattern)
					->results();

			if(!empty($results))
			{
				$json_data['html'] = "<ul>";
				foreach ($results as $result) {
					$json_data['html'] .= "<li>";
					$json_data['html'] .= "<a href='#' id=\"check_item_{$result->id}\" onclick='return setItem({$result->id},\"check_item_{$result->id}\",\"{$parent}\");'>".$result->item_name."</a>";
					$json_data['html'] .= "</li>";
				}
				$json_data['html'] .= "</ul>";
				
			}else{
				$json_data['html'] = " ";
			}
		}else{
			$json_data['html'] = " ";
		}
		

		//$json_data = ['users'=>$result];

		//$json_data = ['users'=>'user data'];
		

	}

	echo json_encode($json_data);
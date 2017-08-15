<?php

	require_once '../../../Config/init.php';

	$json_data['exists'] = false;

	$json_data['html'] = "";

	if (isset($_GET['name']) && isset($_GET['value'])) {
		
		$json_data['exists'] = true;
		
		$name = strtolower(trim($_GET['name']));
		$value = trim($_GET['value']);
		
		if(!empty($value))
		{
			$pattern = "%".$value."%";

			$results = $db->query()
					->from('companies')
					->like('WHERE name LIKE', $pattern)
					->results();

			if(!empty($results))
			{
				$json_data['html'] = "<ul>";
				foreach ($results as $result) {
					$json_data['html'] .= "<li>";
					$json_data['html'] .= "<a href='#' onclick='return setAddress({$result->id});'>".$result->name."</a>";
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
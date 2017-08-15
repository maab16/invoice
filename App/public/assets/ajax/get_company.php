<?php

	require_once '../../../Config/init.php';

	$json_data['exists'] = false;


	if (isset($_POST['company_id'])) {
		
		$json_data['exists'] = true;
		
		$id = (int)($_POST['company_id']);
		

		$company = $db->query()
				->from('companies')
				->where(['id'=>$id])
				->firstResult();
		$json_data['id'] = $company->id;
		$json_data['company_name'] = $company->name;
		$json_data['company_address'] = $company->address;

	}

	echo json_encode($json_data);
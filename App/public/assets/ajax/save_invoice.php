<?php

	require_once '../../../Config/init.php';
	use Blab\Libs\ArrayMethods;

	$json_data['exists'] = false;
	$error = "";


	if (isset($_POST['items']) && isset($_POST['company_name'])) {

		$json_data['exists'] = true;

		$items = $_POST['items'];
		$company_name = $_POST['company_name'];
		$company_address = $_POST['company_address'];
		$sub_total = $_POST['sub_total'];
		$tax = $_POST['tax'];
		$tax_amount = $_POST['tax_amount'];
		$total = $_POST['total'];
		$notes = $_POST['notes'];

		$companies = $db->query()
					->from('companies',['companies.name'=>'company_name'])
					->results();

		$companies = ArrayMethods::flatten($companies);


		foreach ($companies as $company) {
			
			if($company == $company_name){
				$json_data['exists'] = true;
				break;
			}else{
				$json_data['exists'] = false;
				$error = "Please Enter valid Company AND Item ";
			}

			
		}

		foreach ($items as $item) {
			
			$company_items = $db->query()
							->from('items',[
								'items.id'=>'item_num',
								'items.item_name'=>'item_name',
								'items.price'=>'price'
							])
							->where(['id'=>$item[0]])
							->firstResult();
			$company_items = ArrayMethods::flatten($company_items);

			$check_items = [$item[0],$item[1],$item[2]];

			$diff = array_diff($check_items, $company_items);

			$json_data['diffs'] = $diff;

			if(count($diff) > 0)
			{
				$json_data['exists'] = false;
				$error = "Please Enter valid Company AND Item ";
			}
		}

		if($json_data['exists'] == true)
		{

			$insertInvoice = $db->query()
						->into('invoices')
						->insert([
							'company_name'=>$company_name,
							'company_address'=>$company_address,
							'sub_total' => $sub_total,
							'tax' => $tax,
							'tax_amount' => $tax_amount,
							'total' => $total,
							'notes' => $notes,
							'created_at'=>date("Y-m-d H:i:s"),
							'updated_at'=>date("Y-m-d H:i:s")
						]);
			


			foreach ($items as $item) {

				$item_num = $item[0];
				$item_name = $item[1];
				$price = $item[2];
				$qty = $item[3];
				$total = $item[4];

			
				$insert = $db->query()
						->into('carts')
						->insert(array(
							'invoice_id'=> $insertInvoice,
							'item_num'=> $item_num,
							'item_name' => $item_name,
							'price'=> $price,
							'qty'=> $qty,
							'total'=> $total,
							'created_at'=>date("Y-m-d h:i:s"),
							'updated_at'=>date("Y-m-d h:i:s")
						));

			
				
			}

			$json_data['url'] = SUB_DIR.DS.'index.php';
			
		}else{
			$html = '<ul>';
			$html .= "<li>{$error}</li>";
			$html .= "</ul>";

			$json_data['errors'] = $html;
		}
		

	}

	echo json_encode($json_data);
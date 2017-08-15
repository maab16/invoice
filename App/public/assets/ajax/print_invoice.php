<?php

	require_once '../../../Config/init.php';

	$json_data['exists'] = false;


	if (isset($_POST['invoice_id'])) {
		
		$json_data['exists'] = true;
		
		$id = (int)($_POST['invoice_id']);
		
		$invoice = $db->query()
				->from('invoices')
				->where(['id'=>$id])
				->firstResult();

		$items = $db->query()
				->from('carts')
				->where(['invoice_id'=>$id])
				->results();


$html = "<main class='main'>";
	$html .= "<section class='add_invoice'>";
		$html .= "<div class=\"container\">";
			$html .= "<div id=\"save_errors\"></div>";
			$html .= "<form class=\"add\" method=\"post\" action=\"\">";
				$html .= "<div class=\row\">";
					$html .= "<div class=\"col-xs-6 from\">";
						$html .= "<h2 class=\"title\">From,</h2>";
						$html .= "<div class=\"company_info\">";
							
							$html .= "<p>Company Name</p>";
							$html .= "<p>Address</p>";
							$html .= "<p>Contact</p>";
							$html .= "<p>Email</p>";
						$html .= "</div>";
					$html .= "</div>";
					$html .= "<div class=\"col-xs-6 to\">";
						$html .= "<h2>To,</h2>";
						$html .= "<div class=\"form-group\">";
							$html .= "{$invoice->company_name}";
						$html .= "</div>";
						$html .= "<div class=\"form-group\">";
							$html .= "{$invoice->company_address}";
						$html .= "</div>";
					$html .= "</div>";
				$html .= "</div>";
				$html .= "<div class=\"row\">";
					$html .= "<div class=\"col-sm-12\" id=\"item_container\">";
						$html .= "<table class=\"add_item table table-striped table-bordered table-list\">";
							$html .= "<thead>";
								$html .= "<th>Item No</th>";
								$html .= "<th>Item Name</th>";
								$html .= "<th>Price</th>";
								$html .= "<th>Quantity</th>";
								$html .= "<th>Total</th>";
							$html .= "</thead>";
							$html .= "<tbody>";

								$subtotal = 0;
								foreach($items as $item):
									$subtotal += $item->total;

								$html .= "<tr>";
									$html .= "<td>{$item->item_num}</td>";
									$html .= "<td>{$item->item_name}</td>";
									$html .= "<td>{$item->price}</td>";
									$html .= "<td>{$item->qty}</td>";
									$html .= "<td>{$item->total}</td>";
								$html .= "</tr>";
 								endforeach;
							$html .= "</tbody>";
						$html .= "</table>";
					$html .= "</div>";
				$html .= "</div>";
				$html .= "<div class=\"row\">";
					$html .= "<div class=\"col-xs-7\">";
						$html .= "<div class=\"form-group\">";
							$html .= "<label for=\"notes\">Notes:</label>";
							$html .="{$invoice->notes}";
						$html .= "</div>";
					$html .= "</div>";
					$html .= "<div class=\"col-xs-5\">";
						$html .= "<div class=\"form-group text-right\">";
							$html .= "<label>Subtotal:</label>";
							$html .= "{$invoice->sub_total}";
						$html .= "</div>";
						$html .= "<div class=\"form-group text-right\">";
							$html .= "<label>Tax:</label>";
							$html .= "{$invoice->tax}";
						$html .= "</div>";
						$html .= "<div class=\"form-group text-right\">";
							$html .= "<label>Tax Amount:</label>";
							$html .= "{$invoice->tax_amount}";
						$html .= "</div>";
						$html .= "<div class=\"form-group text-right\">";
							$html .= "<label>Total:</label>";
							$html .= "{$invoice->total}";
						$html .= "</div>";
					$html .= "</div>";
					
				$html .= "</div>";
			$html .= "</form>";
		$html .= "</div>";
	$html .= "</section>";
$html .= "</main>";

}
$json_data['html'] = $html;
echo json_encode($json_data);
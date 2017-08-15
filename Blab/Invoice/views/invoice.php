<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
	<style type="text/css">
		*{
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			outline: 0;
		}

		.container{
			width: 1024px;
			margin: 0px auto;
			position: relative;
		}

		.container::after{
			content: '';
			display: block;
			clear: both;
		}
		.invoice-title{
			padding: 80px 15px 0px 15px;
		}
		.invoice-id{
			color: #363636;
			padding-bottom: 30px;
			border-bottom: 2px solid #e3e3e3;
		}

		.invoice-item{
			padding: 0px 15px;
			width: 50%;
			float: left;
			margin-top: 30px;
		}
		.invoice-content{
			padding: 15px;
		}
		.payment-info,
		.instructor-info{
			border: 1px solid #e3e3e3;
			height: 80px;
		}
		.supplier-info,
		.customer-info{
			background-color: #ECECEC;
			border : 1px solid #ECECEC;
		}
		.invoice-content-title{
			color: #226622 !important;
			padding-bottom: 15px;
		}
		.invoice-content-item{
			font-size: 17px;
    		margin-bottom: 8px;
    		font-family: 'Roboto', sans-serif;
    		font-weight: 400;
    		color: #363636;
		}
		.invoice-content-item span{
			display: inline-block;
			width: 120px;
		}

		.invoice-list{
			width: 100%;
			display: block;
			padding-top: 30px;
			clear: both;
			box-sizing: border-box;
			position: relative;
		}
		.invoice-list::before{
			content: "";
			display: block;
			clear: both;
		}
		.table{
			width: 100%;
			border: 1px solid #e3e3e3;
		}
		.table tr th,
		.table tr td{
			padding: 10px;
			vertical-align: middle;
			border-bottom: 1px solid #e3e3e3;
			text-align: left;
		}
		.table tr:last-child td{
			border-bottom: 0px;
		}
		.total h2{
			margin-top: 30px;
			text-align: right;
			color: #363636;
		}
	</style>
</head>
<body>

<main class="main">
	<section class="add_invoice">
		<div class="container">
			<div id="save_errors"></div>
			<form class="add" method="post" action="">
				<div class="row">
					<div class="col-xs-6 from">
						<h2 class="title">From,</h2>
						<div class="company_info">
							
							<p>Company Name</p>
							<p>Address</p>
							<p>Contact</p>
							<p>Email</p>
						</div>
					</div>
					<div class="col-xs-6 to">
						<h2>To,</h2>
						<div class="form-group">
							<?=$data['invoice']->company_name;?>
						</div>
						<div class="form-group">
							<?=$data['invoice']->company_address;?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" id="item_container">
						<table class="add_item table table-striped table-bordered table-list">
							<thead>
								<th>Item No</th>
								<th>Item Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</thead>
							<tbody>
								<?php 
									$subtotal = 0;
									foreach($data['results'] as $result):
										$subtotal += $result->total;
								?>
								<tr>
									<td><?=$result->item_num;?></td>
									<td><?=$result->item_name;?></td>
									<td><?=$result->price;?></td>
									<td><?=$result->qty;?></td>
									<td><?=$result->total;?></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-7">
						<div class="form-group">
							<label for="notes">Notes:</label>
							<?=$data['invoice']->notes;?>
						</div>
					</div>
					<div class="col-xs-5">
						<div class="form-group text-right">
							<label>Subtotal:</label>
							<?=$data['invoice']->sub_total;?>
						</div>
						<div class="form-group text-right">
							<label>Tax:</label>
							<?=$data['invoice']->tax;?>
						</div>
						<div class="form-group text-right">
							<label>Tax Amount:</label>
							<?=$data['invoice']->tax_amount;?>
						</div>
						<div class="form-group text-right">
							<label>Total:</label>
							<?=$data['invoice']->total;?>
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</section>
</main>
</body>
</html>
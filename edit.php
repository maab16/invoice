<?php
include 'header.php';
require_once 'App/Config/init.php';


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
?>
<main class="main">
	<section class="add_invoice">
		<div class="container">
			<div id="save_errors"></div>
			<form class="add" method="post" action="">
				<div class="row">
					<div class="col-sm-6 from">
						<h2 class="title">From,</h2>
						<div class="company_info">
							<p>Logo</p>
							<p>Company Name</p>
							<p>Address</p>
							<p>Contact</p>
							<p>Email</p>
						</div>
					</div>
					<div class="col-sm-6 to">
						<h2>To,</h2>
						<div class="form-group">
							<input type="text" name="company_name" id="company_name" class="company_name field check-exists" value="<?=$invoice->company_name;?>" placeholder="Company Name" data-type="name" autocomplete="off">
							<div class="company_list_container"></div>
						</div>
						<div class="form-group">
							<textarea class="address field" id="address" placeholder="Address"><?=$invoice->company_address;?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" id="item_container">
						<?php 
							$i=1;
							$subtotal = 0;
							foreach($results as $result):
								$subtotal += $result->total;
						?>
						<table id="add_item_<?=$i;?>" class="add_item add_item_<?=$i;?> table table-striped table-bordered table-list">
							<thead>
								<th>Item No</th>
								<th>Item Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>Action</th>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" name="item_num_<?=$i;?>" data-parent="add_item_<?=$i;?>" id="item_num" class="item_num form-control" value="<?=$result->item_num;?>" readonly></td>
									<td class="item_name_container">
										<input type="text" data-parent="add_item_<?=$i;?>" name="item_name_<?=$i;?>" data-type="item_name" id="item_name" class="item_name form-control" value="<?=$result->item_name;?>">
										<div class="item_list_container"></div>
									</td>
									<td>
										<input type="text" name="price_<?=$i;?>" data-parent="add_item_<?=$i;?>" id="price" class="price form-control" value="<?=$result->price;?>" readonly>
									</td>
									<td>
										<input type="number" min="1" name="qty_<?=$i;?>" data-parent="add_item_<?=$i;?>" id="qty" class="qty form-control" value="<?=$result->qty;?>"onkeyup="return calculateTotal('add_item_<?=$i;?>');">
									</td>
									<td>
										<input type="text" name="total_<?=$i;?>" data-parent="add_item_<?=$i;?>" id="total" class="total form-control" value="<?=$result->total;?>" readonly>
									</td>
									<td class='text-center'><a href="#"" onclick="return removeItem('add_item_<?=$i;?>')" class='delete'><i class='fa fa-remove' aria-hidden='true'></i></a></td>
								</tr>
							</tbody>
						</table>
						<?php
							$i++;
							endforeach;
						?>
					</div>
					<div class="col-sm-12">
						<input type="button" value="Add Item" class="add btn btn-default" id="add" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
							<label for="notes">Notes:</label>
							<textarea class="notes form-control" id="notes" placeholder="Enter Note"><?=$invoice->notes?></textarea>
						</div>
						<div class="form-group">
							<input type="hidden" name="invoice_id" id="invoice_id" class="btn btn-success" value="<?=$invoice->id;?>">
							<input type="submit" name="update" id="update" class="btn btn-success" value="Update Invoice">
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group extra-info">
							<input type="number" name="sub_total" id="sub_total" class="sub_total form-control" value="<?=$invoice->sub_total;?>" readonly="">
							<label>Subtotal:</label>
						</div>
						<div class="form-group extra-info">
							<input type="number" name="tax" id="tax" class="tax form-control" value="<?=$invoice->tax;?>" readonly="">
							<label>Tax:</label>
						</div>
						<div class="form-group extra-info">
							<input type="number" name="tax_amount" id="tax_amount" class="tax_amount form-control" value="<?=$invoice->tax_amount;?>" readonly="">
							<label>Tax Amount:</label>
						</div>
						<div class="form-group extra-info">
							<input type="number" name="total_amount" id="total_amount" class="total_amount form-control" value="<?=$invoice->total;?>" readonly="">
							<label>Total:</label>
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</section>
</main>
<?php include 'footer.php';?>
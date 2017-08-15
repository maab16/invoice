<?php
include 'header.php';
require_once 'App/Config/init.php';

$invoices = $db->query()
		->from('invoices')
		->results();

?>
<main id="main">
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
						<div class="form-group company_name_container">
							<input type="text" name="company_name" id="company_name" class="company_name field check-exists" placeholder="Company Name" data-type="name" autocomplete="off">
							<div class="company_list_container"></div>
						</div>
						<div class="form-group">
							<textarea class="address field" id="address" placeholder="Address"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" id="item_container">
						<table id="add_item_1" class="add_item add_item_1 table table-striped table-bordered table-list">
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
									<td><input type="text" name="item_num_1" data-parent="add_item_1" id="item_num" class="item_num form-control" readonly></td>
									<td class="item_name_container">
										<input type="text" data-parent="add_item_1" name="item_name_1" data-type="item_name" id="item_name" class="item_name form-control">
										<div class="item_list_container"></div>
									</td>
									<td><input type="text" name="price_1" data-parent="add_item_1" id="price" class="price form-control" readonly></td>
									<td><input type="number" min="1" name="qty_1" data-parent="add_item_1" id="qty" class="qty form-control" value="1" onkeyup="return calculateTotal('add_item_1');"></td>
									<td><input type="text" name="total_1" data-parent="add_item_1" id="total" class="total form-control" value="0" readonly></td>
									<td class='text-center'><a href="#"" onclick="return removeItem('add_item_1')" class='delete'><i class='fa fa-remove' aria-hidden='true'></i></a></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-sm-12">
						<input type="button" value="Add Item" class="add btn btn-default" id="add" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
							<label for="notes">Notes:</label>
							<textarea class="notes form-control" id="notes" placeholder="Enter Note"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" id="submit" class="btn btn-success" value="Save Invoice">
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group extra-info">
							<input type="number" name="sub_total" id="sub_total" class="sub_total form-control" value="0" readonly="">
							<label>Subtotal:</label>
						</div>
						<div class="form-group extra-info">
							<input type="number" name="tax" id="tax" class="tax form-control" value="15" readonly="">
							<label>Tax:</label>
						</div>
						<div class="form-group extra-info">
							<input type="number" name="tax_amount" id="tax_amount" class="tax_amount form-control" value="0" readonly="">
							<label>Tax Amount:</label>
						</div>
						<div class="form-group extra-info">
							<input type="number" name="total_amount" id="total_amount" class="total_amount form-control" value="0" readonly="">
							<label>Total:</label>
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</section>
	<section class="invoice-list">
		<div class="container">
			<table class="table table-bordered">
			    <thead>
			      <tr>
			        <th>Invoice No</th>
			        <th>Customer Name</th>
			        <th>Created Date</th>
			        <th>Invoice Total</th>
			        <th>Result</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php foreach ($invoices as $invoice) : ?>
				      <tr>
				        <td><?=$invoice->id?></td>
				        <td><?=$invoice->company_name?></td>
				        <td><?=$invoice->created_at;?></td>
				        <td><?=$invoice->total?></td>
				        <td class="text-center">
					        <div class="dropdown">
							  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions
							  	<span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="edit.php?id=<?=$invoice->id;?>">Edit</a></li>
							    <li><a href="#" onclick="printInvoice(<?=$invoice->id;?>);">Print</a></li>
							    <li><a href="<?php echo SUB_DIR?>\Blab\Invoice\index.php?id=<?=$invoice->id;?>">PDF</a></li>
							    <li><a href="#" onclick="deleteInvoice(<?=$invoice->id;?>);">Delete</a></li>
							  </ul>
							</div>
						</td>
				      </tr>
			      <?php endforeach;?>
			    </tbody>
			</table>
		</div>
	</section>
	
</main>
<?php include 'footer.php';

<?php include 'header.php';?>

<main class="main">
	<section class="add_invoice">
		<div class="container">
			<div id="save_errors"></div>
			<form class="add" method="post" action="">
				<div class="row">
					<div class="col-sm-6 from">
						<h2 class="title">From,</h2>
						<div class="company_info">
							<img src="<?php asset('images/logo.png');?>" alt="Logo" class="img-responsive">
							<p>Company Name</p>
							<p>Address</p>
							<p>Contact</p>
							<p>Email</p>
						</div>
					</div>
					<div class="col-sm-6 to">
						<h2>To,</h2>
						<div class="form-group">
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
						<div class="form-group">
							<label>Subtotal:</label>
							<input type="text" name="sub_total" id="sub_total" class="sub_total" value="0">
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</section>
</main>
<?php include 'footer.php';?>
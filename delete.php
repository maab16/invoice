<?php
include 'header.php';
require_once 'App/Config/init.php';


if(isset($_GET['id']))
{
	$id = $_GET['id'];

	$invoice = $db->query()
			->from('invoices')
			->where(['id'=>$id])
			->delete();

	$results = $db->query()
			->from('carts')
			->where(['invoice_id'=>$id])
			->delete();

	if($results)
	{
		header('Location: index.php');
	}

}
?>
<?php include 'footer.php';?>
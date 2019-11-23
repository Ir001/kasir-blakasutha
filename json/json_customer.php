<?php 
require '../application/system.php';
?>
<table id="data_pelanggan" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Customer</th>
			<th>Phone</th>
			<th>Instagram</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$list_customer = $system->list_customer();
		foreach ($list_customer as $list) {

			?>
			<tr>
				<td><?=$list['nama_lengkap'];?> <span class="badge badge-sm badge-info"><?=ucwords($list['role']);?></span></td>
				<td><?=$list['phone'];?></td>
			<td><?=$list['instagram'];?></td>
			<td class="text-center">
				<form class="set_user">
					<input type="hidden" name="set_user" value="1"> 
					<input type="hidden" name="id" value="<?=$list['id_customer'];?>"> 
					<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i></button>
				</form>
			</td>
		</tr>
	<?php } ?>
	
</tbody>
</table>
<script>$("#data_pelanggan").DataTable();</script>
<script>
    var load_barang = "json/json_barang.php";
    var loadUrl1 = "json/json_cart.php";
	$('.set_user').submit(function(e){
		e.preventDefault();
		$.ajax({
			type : 'POST',
			url : 'application/event.php',
			data : $(this).serialize(),
			dataType : 'json',
			success : function (data){
				if (data.success) {
   					window.$('#load-barang').load(load_barang);

   					window.$('#load-cart').load(loadUrl1);
				}
			}
		})
	})
</script>
<script>$("#data_pelanggan").DataTable();</script>

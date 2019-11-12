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
				<td><?=$list['phone'];?>
			</td>
			<td><?=$list['instagram'];?></td>
			<td class="text-center"><button class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i></button></td>
		</tr>
	<?php } ?>
	
</tbody>
</table>
<script>$("#data_pelanggan").DataTable();</script>
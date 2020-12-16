<div class = 'itemlist'>
	<h3 align="center"> Manage </h3>
	<table border = '1px' align="center">
		<tr>
			<td> ID </td>
			<td> Thumb </td>
			<td> Title </td>
			<td> Status </td>
			<td> Action </td>
		</tr>
		<?php
		foreach ($page_item as $value){
		?>

		<tr>
			<td> <?= $value['id'] ?> </td>
			<td> <img src="<?= $value['image'] ?>" width = '50' height = '50' alt = 'image'></td>
			<td><?= $value['title'] ?></td>
			<td><?= $value['status'] ? 'Enabled' : 'Disabled' ?></td>
			<td>
				<a href="index.php?controller=admin&action=detail&id=<?= $value['id']; ?>"> Show </a>
				<a href="index.php?controller=admin&action=edit&id=<?= $value['id']; ?>"> Edit </a>
				<a href="index.php?controller=admin&action=delete&id=<?= $value['id']; ?>"> Delete </a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	<div align="center">
		<?php require_once "./mvc/views/admin/pagination.php";?>
	</div>

	<div align="center">
		<a href="index.php?controller=admin&action=add"> New </a>
	</div>
</div>
<div class = 'eddititem'>
	<a class = 'list' href="index.php?controller=admin&action=show"> Back </a>
	<h3> Edit </h3>
	<form action ='' method="POST" enctype= 'multipart/form-data'>
		<table>
			<tr>
				<td> Title </td>
				<td> <input type="text" name="itemtitle" value="<?= $dataID[0]['title'] ?>"></td>
			</tr>
			<tr>
				<td> Description </td>
				<td> <input type="text" name="itemdescription" value="<?= $dataID[0]['description']?>"></td>
			</tr>
			<tr>
				<td rowspan="2"> Image </td>
				<td>
					<input type="file" name="itemthumb" value="<?= $dataID[4]['image']?>">
				</td>
				<tr>
				</tr>
				<tr>
					<td> Status </td>
					<?php
					$arr1 = array('<option value = 1>Enabled</option>', '<option value = 0>Disabled</option>');
					$arr2 = array('<option value = 0> Disabled </option>', '<option value = 1> Enabled </option>');
					$item_status = $dataID[0]['status'] ? $arr1 : $arr2;
					?>
					<td>
						<select name = 'itemstatus'> <?php print_r($item_status);?></select>
					</td>
				</tr>
				<tr>
					<td> &nbsp; </td>
					<td><input type="submit" name="update_item" value="Update"></td>
				</tr>
			</tr>
		</table>
	</form>
	<?php
	if ($edit_success){
		echo "<p style= 'color: black; text-align: center'> Edit successfully </p>";
	}
	?>
</div>
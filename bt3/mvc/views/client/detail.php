<div class= 'itemdetail'>
	<a class= 'list' href="index.php?controller=admin&action=show"> Back </a>
	<h3> <?= $dataID[0]['title'];?> </h3>
	<table>
		<tr>
			<td>
				<image src= "<?= $dataID[0]['image']?>" alt = 'image'>
			</td>
			<td>
				<input type="text" name="itemtitle" value="<?= $dataID[0]['description']?>">
			</td>
		</tr>
	</table>
</div>
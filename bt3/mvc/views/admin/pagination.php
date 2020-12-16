<?php
if ($current_page > 2){
	$first_page = 1;
?>

<a href="index.php?controller=admin&action=show&per_page= <?=$item_per_page?>&page=<?=$first_page?>"> First </a>

<?php
}
if ($current_page > 1) {
	$prev_page = $current_page - 1;
?>

<a href="index.php?controller=admin&action=show&per_page=<?=$item_per_page?> &page=<?=$prev_page?>"> Prev </a>

<?php
}
?>

<?php for ($i = 1; $i <= $total_pages; $i++) {
?>

<a href="index.php?controller=admin&action=show&per_page=<?=$item_per_page?>&page=<?=$i?>"><strong><?=$i?></strong></a>

<?php
}
?>

<?php
if ($current_page < $total_pages - 1){
	$next_page = $current_page + 1;
	?>

<a href="index.php?controller=admin&action=show&per_page= <?=$item_per_page?> &page=<?=$next_page?>"> Next </a>
<?php
}
if ($current_page < $total_pages - 2){
	$end_page = $total_pages;
?>
<a href="index.php?controller=admin&action=show&per_page=<?=$item_per_page?>&page=<?=$end_page?>"> Last </a>
<?php
}
?>
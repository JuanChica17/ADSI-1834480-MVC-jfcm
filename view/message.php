<?php
if(isset($_REQUEST['m'])){
$msg = Database::encryptor('decrypt', $_REQUEST['m']);
$err = Database::encryptor('decrypt', $_REQUEST['e']);
if($err == 0) {
	$alert = 'alert-success';
}else if($err == 1){
	$alert = 'alert-info';
}else{
	$alert = 'alert-danger';
}
?> 
<div class="alert <?=$alert?>" role="alert">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<?= $msg ?>
</div>
<?php
}
?>
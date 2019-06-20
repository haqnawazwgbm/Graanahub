
	<?php 

	$danger = $this->session->flashdata('danger');
	$warning = $this->session->flashdata('warning');
	$success = $this->session->flashdata('success');

	if ($danger) {
?>
    
    <div class="alert alert-danger alert-dismissible">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>Warning!</strong> <?= $danger['message']; ?>
	</div>
 <?php } ?>

 <?php if ($warning) { ?>
     <div class="alert alert-warning alert-dismissible">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>Warning!</strong> <?= $warning['message']; ?>
	</div>

 <?php } ?>

 <?php if ($success) { ?>
      <div class="alert alert-success alert-dismissible">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>Success!</strong> <?= $success['message']; ?>
	</div>
 <?php } ?>

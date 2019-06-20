<?php include_once("includes/header.php"); ?>
<?php include_once("includes/menu.php"); ?>
<?php include_once("includes/sidebar.php"); ?>

	     	<?php include_once('includes/alerts.php'); ?>
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h4 class="page-title">Change Password</h4>
							<form method="POST" action="<?= base_url(); ?>Change_Password/update">
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											<label>Old password</label>
											<?php echo '<span class="text-danger">'.form_error('current_password').'</span>'; ?>
											<input type="password" required name="current_password" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											<label>New password</label>
											<?php echo '<span class="text-danger">'.form_error('password').'</span>'; ?>
											<input type="password" required name="password" class="form-control">
										</div>
									</div>
									<div class="col-xs-12  col-sm-12">
										<div class="form-group">
											<label>Confirm password</label>
											<?php echo '<span class="text-danger">'.form_error('confirm_password').'</span>'; ?>
											<input type="password" required name="confirm_password" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 text-center m-t-20">
										<button type="submit" name="submitChangePassword" value="true" class="btn btn-primary">Update Password</button>
									</div>
								</div>
							</form>
						</div>
					</div>
		
					</div>
				</div>			
			</div>
<?php include_once("includes/footer.php"); ?>
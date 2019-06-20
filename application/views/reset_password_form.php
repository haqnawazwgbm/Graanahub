


<?php include_once('includes/header.php'); ?>
<div class="account-page">
				<div class="container">
					<?php include_once("includes/alerts.php"); ?>
					<h3 class="account-title">Change password</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/img/logo.svg" alt="Focus Technologies"></a>
							</div>
							<form method="POST" action="<?= base_url(); ?>Password_Resets/change_pass">
								<div class="form-group form-focus">
									<label class="control-label">New Password</label>
									<input type="password" name="password" class="form-control" placeholder="New password">
									<?php echo form_error('password','<span class="text-danger">','</span>'); ?>
								</div>
								<div class="form-group form-focus">
									<label class="control-label">Confirm Password</label>
									<input type="password" name="confirm_password" class="form-control" placeholder="New password">
									<?php echo form_error('confirm_password','<span class="text-danger">','</span>'); ?>
								</div>
								<input type="hidden" name="token" value="<?= $token; ?>">
								<div class="form-group text-center">
									<button class="btn btn-primary btn-block account-btn" name="changePassword" value="true" type="submit">Send</button>
								</div>
					
							</form>
						</div>
					</div>
				</div>
			</div>
<?php include_once('includes/footer.php'); ?>
<?php include_once('includes/header.php'); ?>
<div class="account-page">
				<div class="container">
					<?php include_once("includes/alerts.php"); ?>
					<div class="account-logo">
								<a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/img/logo.svg" alt="Focus Technologies"></a>
							</div>
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Forget Password</h3>
							<form method="POST" action="<?= base_url(); ?>Password_Resets/send_mail">
								<div class="form-group">
									<input class="form-control floating" placeholder="Email" name="email" type="text">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary btn-block account-btn" name="sendMail" value="true" type="submit">Reset Password</button>
								</div>
								<div class="text-center">
									<a href="<?= base_url(); ?>Login/login_form">Back to Login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<?php include_once('includes/footer.php'); ?>
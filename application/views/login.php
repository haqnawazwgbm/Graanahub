<?php include_once("includes/header.php"); ?>

<div class="account-page">

				<a href="<?= base_url(); ?>Site_Jobs/list_jobs" class="btn btn-primary apply-btn">Apply Job</a>
						
				<div class="container">
					<?php include_once("includes/alerts.php"); ?>
					<div class="account-logo">
								<a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/img/logo.svg" alt="Focus Technologies"></a>
							</div>
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>

							<form action="<?= base_url(); ?>Login/login" method="POST">
								<div class="form-group">
									<input class="form-control floating" placeholder="Email" name="email" required type="text">
								</div>
								<div class="form-group">
									<input class="form-control floating" placeholder="Password" name="password" required type="password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary btn-block account-btn" name="login" value="true" type="submit">Login</button>
								</div>
								<div class="text-center">
									<a href="<?= base_url(); ?>Password_Resets">Forgot your password?</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include_once("includes/footer.php"); ?>
<?php include_once('includes/header.php'); ?>
<section class="sec-sell-main">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
				<div class="row">
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6"></div>
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-in-head">
							<h3><?= $this->lang->line('Create Account'); ?></h3>
						</div>
					</div>
				</div>
				<form action="<?= base_url(); ?>Site_Login/register" method="POST" >
				<div class="row">
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-in-left">
							<label for=""><?= $this->lang->line('Email Address'); ?><span>*</span></label>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-input-sell">
							<input type="text" value="<?=set_value('email')?>"  name="email" class="form-control" placeholder="<?= $this->lang->line('Email Address'); ?>">
							<?php echo form_error('email','<span class="text-danger">','</span>'); ?>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-in-left">
							<label for=""><?= $this->lang->line('User Name'); ?> <span>*</span></label>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-input-sell">
							<input name="full_name" value="<?=set_value('full_name')?>" type="text" class="form-control" placeholder="<?= $this->lang->line('User Name'); ?>">
							<?php echo form_error('full_name', '<span class="text-danger">', '</span'); ?>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-in-left">
							<label for="password"><?= $this->lang->line('Password'); ?> <span>*</span></label>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-input-sell">
							<input type="password" name="password" id="password" class="form-control" placeholder="<?= $this->lang->line('Password'); ?>">
							<?php echo form_error('password', '<span class="text-danger">', '</span'); ?>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-in-left">
							<label for="confirm_password"><?= $this->lang->line('Confirm Password'); ?> <span>*</span></label>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-input-sell">
							<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="<?= $this->lang->line('Confirm Password'); ?>">
							<?php echo form_error('confirm_password', '<span class="text-danger">', '</span'); ?>
						</div>				
					</div>
				</div>
				<!-- <div class="row">
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="main-in-left">
							<label for="">Select a User Type <span>*</span></label>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="radio-pd-pkj">
							<div class="main-input-sell">
								<input type="radio" id="r1" name="rr">
								<label for="r1"><span></span></label>
								Seller
								<input type="radio" id="r2" name="rr">
								<label for="r2"><span></span></label>
								Dealer
							</div>	
						</div>	
						<div class="radio-pd-pkj">
							
						</div>		
					</div>
				</div> -->
				<div class="row">
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						
					</div>
					<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
						<div class="sell-btn">
							<button name="submitRegistration" class="btn btn-block" value="true"><?= $this->lang->line('Create Account'); ?></button>
							<a href="<?= base_url(); ?>Site_Login/login_form"><?= $this->lang->line('Already Have Account'); ?>?</a>
						</div>		
					</div>
				</div>
			</form>
			</div>
			<div class="col-lg-4">
				
			</div>
		</div>
	</div>
</section>
<?php include_once('includes/footer/car_brand.php'); ?>
<?php include_once('includes/footer/user_quote.php'); ?>
<?php include_once('includes/footer/upcoming_cars.php'); ?>
<?php include_once('includes/footer.php'); ?>
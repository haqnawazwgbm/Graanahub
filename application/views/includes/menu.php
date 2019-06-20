  <?php 
  $user = $this->session->userdata('user');
  ?>
  <div class="header">
                <div class="header-left">
                    <a href="<?= base_url(); ?>" class="logo logo-big">
						<img src="<?= base_url(); ?>assets/img/logo.svg" width="120" height="40" alt="">
					</a>
					<a href="<?= base_url(); ?>" class="logo logo-small">
						<img src="<?= base_url(); ?>assets/img/logo.svg" width="120" height="30" alt="">
					</a>
                </div>
				<a id="toggle_btn" href="javascript:void(0);"><i class="la la-bars"></i></a>
                <div class="page-title-box pull-left">
					<h3></h3>
                </div>
				<a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul class="nav navbar-nav navbar-right user-menu pull-right">
					<?php if ($user['role_id'] == 4) : ?>
						<li><a href="#"  data-toggle="modal" data-target="#request_form">Send request</a></li>
					<?php endif; ?>
					<?php include_once("code_conducts.php"); ?>
					<?php include_once("policies.php"); ?>
					 <?php if ($user['role_id'] == 4)  {
						include_once("employee_notifications.php");
						} elseif ($user['role_id'] == 2) {
							include_once("manager_notifications.php");
						} else { 
						include_once("notifications.php");
						} ?>
					<?php //include_once("messages.php"); ?>
					
					<li class="dropdown">
						<a href="profile.html" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
							<span class="user-img"><img class="img-circle" src="<?= base_url().'uploads/'.$user['photo']; ?>" width="40" alt="Admin">
							<span class="status online"></span></span>
							<span><?= ucfirst($user['name']); ?></span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url(); ?>Profile">My Profile</a></li>
							<li><a href="<?= base_url(); ?>Profile/edit">Edit Profile</a></li>
							<li><a href="<?= base_url(); ?>Change_Password/">Change Password</a></li>
							<li><a href="<?= base_url(); ?>Login/logout">Logout</a></li>
						</ul>
					</li>
				</ul>
				<div class="dropdown mobile-user-menu pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="<?= base_url(); ?>Profile">My Profile</a></li>
						<li><a href="<?= base_url(); ?>Profile/edit">Edit Profile</a></li>
						<li><a href="settings.html">Settings</a></li>
						<li><a href="login.html">Logout</a></li>
					</ul>
				</div>
            </div>
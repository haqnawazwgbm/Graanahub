<!DOCTYPE html>
<html>
    
<!-- Mirrored from dreamguys.co.in/smarthr/light/job-view.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jan 2019 13:26:25 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <title>Jobs - HRMS</title>
		<?php $this->load->view("includes/css.php"); ?>
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index-2.html" class="logo">
						<img src="<?= base_url(); ?>assets/img/logo.svg" width="120" alt="">
					</a>
                </div>
                <div class="page-title-box pull-left">
                </div>
				<ul class="nav navbar-nav navbar-right user-menu pull-right">
					<li>
						<a href="<?= base_url(); ?>">Login</a>
					</li>
				</ul>
		
            </div>
            <div class="page-wrapper job-wrapper">
                <div class="content container">
					<div class="row">
						<div class="col-md-8">
							<div class="job-info job-widget">
								<h3 class="job-title"><?= ucfirst($job['title']); ?></h3>
								<span class="job-dept"><?= ucfirst($job['department']); ?></span>
								<ul class="job-post-det">
									<li><i class="fa fa-calendar"></i> Post Date: <span class="text-blue"><?= date('F d, Y', strtotime($job['start_date'])); ?></span></li>
									<li><i class="fa fa-calendar"></i> Last Date: <span class="text-blue"><?= date('F d, Y', strtotime($job['expire_date'])); ?></span></li>
									<!-- <li><i class="fa fa-user-o"></i> Applications: <span class="text-blue">4</span></li>
									<li><i class="fa fa-eye"></i> Views: <span class="text-blue">3806</span></li> -->
								</ul>
							</div>
							<div class="job-content job-widget">
								<div class="job-desc-title"><h4>Job Description</h4></div>
								<div class="job-description">
									<?= $job['description']; ?>
								</div>
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="job-det-info job-widget">
								<a class="btn job-btn" href="#"  data-toggle="modal" data-target="#add_form">Apply For This Job</a>
								<div class="info-list">
									<span><i class="fa fa-bar-chart"></i></span>
									<h5>Job Type</h5>
									<p> <?= ucfirst($job['job_type']); ?></p>
								</div>
								<div class="info-list">
									<span><i class="fa fa-money"></i></span>
									<h5>Salary</h5>
									<p><?= $job['salary_from'].' - '.$job['salary_to']; ?></p>
								</div>
								<div class="info-list">
									<span><i class="fa fa-suitcase"></i></span>
									<h5>Experience</h5>
									<p><?= $job['experience']; ?> </p>
								</div>
								<div class="info-list">
									<span><i class="fa fa-ticket"></i></span>
									<h5>Vacancy</h5>
									<p><?= $job['vacancies']; ?></p>
								</div>
								<div class="info-list">
									<span><i class="fa fa-map-signs"></i></span>
									<h5>Location</h5>
									<p> <?= ucfirst($job['location']); ?></p>
								</div>
								<div class="info-list">
									<p> 818-978-7102
									<br> danielporter@example.com
									<br> https://www.example.com
									</p>
								</div>
								<div class="info-list text-center">
									<a class="app-ends" href="#">Application ends in <?php $days = $job['expire_date'] - $job['start_date'];  echo date('d', strtotime($days)).' days'; ?></a>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <?php require_once('apply_form.php'); ?>
       <?php $this->load->view("includes/footer"); ?>
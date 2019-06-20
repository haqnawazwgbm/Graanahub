<!DOCTYPE html>
<html>
<?php $CI =& get_instance(); ?>
<!-- Mirrored from dreamguys.co.in/smarthr/light/job-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jan 2019 13:26:22 GMT -->
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
						<img src="<?= base_url(); ?>assets/img/logo.svg" width="120"  alt="">
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
                		<?php $this->load->view('includes/alerts.php'); ?>
					<div class="row">
						<div class="col-xs-12">
							<h4 class="page-title">Jobs</h4>
						</div>
					</div>
					<div class="row">
					<?php foreach ($jobs as $job) : ?>
					
						<div class="col-md-6">
							<a class="job-list" href="<?= base_url().'Site_Jobs/details/'.$job['id']; ?>">
								<div class="job-list-det">
									<div class="job-list-desc">
										<h3 class="job-list-title"><?= ucfirst($job['title']); ?></h3>
										<h4 class="job-department"><?= ucfirst($job['department']); ?></h4>
									</div>
									<div class="job-type-info">
										<span class="job-types"><?= ucfirst($job['job_type']); ?></span>
									</div>
								</div>
								<div class="job-list-footer">
									<ul>
										<li><i class="fa fa-map-signs"></i> <?= ucfirst($job['location']); ?></li>
										<li><i class="fa fa-money"></i> <?= $job['salary_from'].'-'.$job['salary_to']; ?></li>
										<li><i class="fa fa-clock-o"></i> <?= $CI->time2str($job['created']); ?></li>
									</ul>
								</div>
							</a>
						</div>
					
					
				<?php endforeach; ?>
				</div>
                </div>
            </div>
        <script type="text/javascript">
        	$(document).ready(function() {
        		$(".description").jqte();
        		// Datatable
				if($('.datatable').length > 0 ){
					$('.datatable').DataTable({});
					$("#DataTables_Table_0_filter").find('label').append('<a href="#" class="btn btn-bg-white btn-primary add-form-btn" data-toggle="modal" data-target="#add_form"><i class="fa fa-plus"></i> Add Job</a>');
				}
        		$('.edit_record').on('click', function() {
        			var href = $(this).attr('href');
        			$.ajax( {
        				url: href,
        				type: 'GET',
        				success: function(data) {
        					$('.edit-form-container').html(data);
        					$('.edit-form-container').find('#edit_form').modal('show');
        					$('.select').select2({
								minimumResultsForSearch: -1,
								width: '100%'
							});
							$(".description").jqte();
        				}
        			})
        		})
        	})
        </script>
        
        <?php $this->load->view("includes/footer"); ?>
<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); 
	$CI =& get_instance();
	
?>

	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Jobs</h4>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Job Title</th>
											<th>Department</th>
											<th>Start Date</th>
											<th>Expire Date</th>
											<th class="text-center">Job Type</th>
											<th class="text-center">Status</th>
											<th>Applicants</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; foreach ($jobs as $job) : ?>
										<tr>
											<td><?= $i; ?></td>
											<td><a href="<?= base_url().'Site_Jobs/details/'.$job['id']; ?>"><?= ucfirst($job['title']); ?></a></td>
											<td><?= ucfirst($job['department']); ?></td>
											<td><?= date('d F Y', strtotime($job['start_date'])); ?></td>
											<td><?= date('d F Y', strtotime($job['expire_date'])); ?></td>
											<td class="text-center">
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
														<?php
															$job_type = '';
														 if ($job['job_type'] == 'full time')
																$job_type = 'info';
														elseif ($job['job_type'] == 'part time')
															$job_type = 'success';
														elseif ($job['job_type'] == 'internship') 
															$job_type = 'danger';
														elseif ($job['job_type'] == 'temporary' || $job['job_type'] == 'other')
															$job_type = 'warning';
														?>
														<i class="fa fa-dot-circle-o text-<?= $job_type; ?>"></i> <?= ucfirst($job['job_type']); ?> 
													</a>
												
												</div>
											</td>
											<td class="text-center">
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
														<?php
															$job_status = '';
															if ($job['job_status'] == 'open')
																$job_status = 'info';
															elseif ($job['job_status'] == 'closed')
																$job_status = 'success';
														?>
														<i class="fa fa-dot-circle-o text-<?= $job_status; ?>"></i> <?= ucfirst($job['job_status']); ?>
													</a>
													
												</div>
											</td>
											<td><a href="<?= base_url().'Jobs/list_candidates/'.$job['id'].'/'.'new'; ?>" class="btn btn-xs btn-primary"><?php
												$con['conditions'] = array(
									                'status' => 1,
									                'job_id' => $job['id']
									            );
									            $con['returnType'] = 'count';
											 	echo $CI->count_applications($con); ?> Candidates</a></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li class="edit_record" href="<?= base_url().'Jobs/edit_form/'.$job['id']; ?>"><a href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" path="<?= base_url().'Jobs/delete'; ?>" data-toggle="modal" data-target="#delete_asset" class="delete_record" id="<?= $job['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php $i++; endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
        <script type="text/javascript">
        	$(document).ready(function() {
        		$("#description").jqte();

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
							$("#edit_description").jqte();
        				}
        			})
        		})
        	})
        </script>
        
        <?php include_once('job_form.php'); ?>
        <?php $this->load->view("includes/footer"); ?>
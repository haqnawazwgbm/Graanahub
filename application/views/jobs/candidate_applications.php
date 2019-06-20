<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); 
	$CI =& get_instance();
	$uri = $this->uri->segment_array();
?>

	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Applications</h4>
						</div>
						
					</div>
		<ul class="nav nav-tabs">
						    <li class="<?= @$uri[4] == 'new' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Jobs/list_candidates/0/new">New</a></li>
						    <li class="<?= @$uri[4] == 'hired' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Jobs/list_candidates/0/hired">Hired</a></li>
						    <li class="<?= @$uri[4] == 'interviewed' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Jobs/list_candidates/0/interviewed">Interviewed</a></li>
						    <li class="<?= @$uri[4] == 'rejected' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Jobs/list_candidates/0/rejected">Rejected</a></li>
						    <li class="<?= @$uri[2] == 'not_eligible' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Jobs/not_eligible">Not eligible</a></li>
					</ul>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Job</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Domicile</th>
											<th>Education</th>
											<th>Experience</th>
											<th>Apply Date</th>
											<th class="text-center">Status</th>
											<th>Resume</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($applications) : $i = 1; foreach ($applications as $application) : ?>
										<tr>
											<td><?= $i; ?></td>
											<td><a href="<?= base_url().'Site_Jobs/details/'.$application['id']; ?>"><?= ucfirst($application['title']); ?></a></td>
											<td><?= ucfirst($application['name']); ?></td>
											<td><?= $application['email']; ?></td>
											<td><?= $application['phone_no']; ?></td>
											<td><?= @ucfirst($application['domicile']); ?></td>
											<td><?= $application['education'] == '0' ? '' : @ucfirst($application['education']); ?></td>
											<td><?= @ucfirst($application['experience']); ?></td>
											<td><?= date('d F Y', strtotime($application['apply_date'])); ?></td>
											<td class="text-center">
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
														<?php
															$application_status = '';
														 if ($application['application_status'] == 'new')
																$application_status = 'info';
														elseif ($application['application_status'] == 'hired')
															$application_status = 'success';
														elseif ($application['application_status'] == 'rejected' || $application['application_status'] == 'interviewed') 
															$application_status = 'danger';
														
														?>
														<i class="fa fa-dot-circle-o text-<?= $application_status; ?>"></i> <?= ucfirst($application['application_status']); ?> <i class="caret"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li><a class="update_apply_status" href="<?= base_url().'Jobs/update_apply_status/'.$application['job_id'].'/'.$application['application_id'].'/'.'new'; ?>"><i class="fa fa-dot-circle-o text-info"></i> New</a></li>
														<li><a class="update_apply_status" href="<?= base_url().'Jobs/update_apply_status/'.$application['job_id'].'/'.$application['application_id'].'/'.'hired'; ?>"><i class="fa fa-dot-circle-o text-success"></i> Hired</a></li>
														<li><a class="update_apply_status" href="<?= base_url().'Jobs/update_apply_status/'.$application['job_id'].'/'.$application['application_id'].'/'.'rejected'; ?>"><i class="fa fa-dot-circle-o text-danger"></i> Rejected</a></li>
														<li><a class="update_apply_status" href="<?= base_url().'Jobs/update_apply_status/'.$application['job_id'].'/'.$application['application_id'].'/'.'interviewed'; ?>"><i class="fa fa-dot-circle-o text-danger"></i> Interviewed</a></li>
													</ul>
												
												</div>
											</td>
											
											<td><a href="<?= base_url().'uploads/'.$application['file']; ?>" download="<?= base_url().'uploads/'.$application['file']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-download"></i> Download</a></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" mail="<?= $application['email']; ?>"  data-toggle="modal" data-target="#mail_form" class="email" ><i class="fa fa-envelope m-r-5"></i> Mail</a></li>
														<li><a href="#" path="<?= base_url().'Jobs/delete_application'; ?>" data-toggle="modal" data-target="#delete_asset" class="delete_record" id="<?= $application['application_id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php $i++; endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
        <script type="text/javascript">
        	$(document).ready(function() {
        		$('.update_apply_status').on('click', function() {
        			if (confirm('Are you sure to update status')) {
        				return true;
        			} else {
        				return false;
        			}
        		});
        		$("#description").jqte();
        		$("#mail_description").jqte();

        		// Datatable
				if($('.datatable').length > 0 ){
					$('.datatable').DataTable({});
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
        <?php include_once('mail_form.php'); ?>
        <?php $this->load->view("includes/footer"); ?>
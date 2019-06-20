<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>
<?php $uri = $this->uri->segment_array(); ?>
	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title"><?= $heading; ?></h4>
						</div>
						
					</div>
					<ul class="nav nav-tabs">
						    <li class="<?= $uri[2] == 'list_users' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Users/list_users">Employees</a></li>
						    <li class="<?= $uri[2] == 'list_managers' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>Users/list_managers">Managers</a></li>
					</ul>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Employee Code</th>
											<th style="width:30%;">Name</th>
											<th>Email</th>
											<th>Mobile #</th>
											<th>Joining Date</th>
											<th>Designation</th>
											<th>More+</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($users as $user) : ?>
										<tr>
											<td><?= $user['code']; ?></td>
											<td>
												<a href="<?= base_url().'Profile/view/'.$user['id']; ?>" class="avatar"><img src="<?= base_url().'uploads/'.$user['photo']; ?>"></a>
												<h2><a href="<?= base_url().'Profile/view/'.$user['id']; ?>"><?= ucfirst($user['name']); ?> <span><?= ucfirst($user['role']); ?></span></a></h2>
											</td>
											<td><?= $user['email']; ?></td>
											<td><?= $user['mobile_no']; ?></td>
											<td><?= date('d F Y', strtotime($user['joining_date'])); ?></td>
											<td><?= ucfirst($user['designation']); ?></td>
											
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="<?= base_url(); ?>assets/img/plus.png" width="20"></a>
													<ul class="dropdown-menu pull-right">
														<table class="table table-striped">
															<tr><th>ICE #</th><td><?= $user['ice_no']; ?></td></tr>
															<tr><th>NTN #</th><td><?= $user['ntn_no']; ?></td></tr>
															<tr><th>Department</th><td><?= ucfirst($user['department']); ?></td></tr>
															<tr><th>Role</th><td>
																<?php $label = '';
																		if ($user['role_id'] == 1) 
																			$label = 'danger';
																		elseif ($user['role_id'] == 2)
																			$label = 'warning';
																		elseif ($user['role_id'] == 3)
																			$label = 'info';
																		else
																			$label = 'success';

																?>
																<span class="label label-<?= $label; ?>-border"><?= ucfirst($user['role']); ?></span>	
															</td></tr>
															<tr><th>Payslip</th><td><span class="generate_payslip" href="<?= base_url().'Salaries/payslip/'.$user['user_id']; ?>"><a class="btn btn-xs btn-bg-white btn-primary" href="#">Generate Slip</a></span></td></tr>
														</table>

														
													</ul>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="<?= base_url().'Users/resend_credentials/'.$user['user_id']; ?>"><i class="fa fa-send m-r-5"></i> Resend Credentials</a></li>
														<?php if ($user['role_id'] == 2) : ?>
														<li><a href="<?= base_url().'Users/list_team/'.$user['department_id']; ?>"><i class="fa fa-eye m-r-5"></i> View Team</a></li>
														<?php endif; ?>

														<li class="edit_record" href="<?= base_url().'Users/edit_form/'.$user['user_id']; ?>"><a href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" path="<?= base_url().'Users/delete'; ?>" data-toggle="modal" data-target="#delete_asset" class="delete_record" id="<?= $user['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
        <script type="text/javascript">
        	$(document).ready(function() {
        		// Datatable
				if($('.datatable').length > 0 ){
					$('.datatable').DataTable({});
					$("#DataTables_Table_0_filter").find('label').append('<a href="#" class="btn btn-primary btn-bg-white add-form-btn" data-toggle="modal" data-target="#add_form"><i class="fa fa-plus"></i> Add Employee</a>');
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
        				}
        			})
        		})

        		$('.generate_payslip').on('click', function() {
        			var href = $(this).attr('href');
        			$.ajax( {
        				url: href,
        				type: 'GET',
        				success: function(data) {
        					$('.edit-form-container').html(data);
        					$('.edit-form-container').find('#payslip').modal('show');
        					return false;
        				}
        			})
        		})
        	})
        </script>
        
        <?php include_once('user_form.php'); ?>

        <?php $this->load->view("includes/footer"); ?>
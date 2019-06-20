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
						<div class="col-xs-8 text-right m-b-30">
						</div>
					</div>
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
											<th>Department</th>
											<th>Designation</th>
											<th>Role</th>
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
											<td><?= ucfirst($user['department']); ?></td>
											<td><?= ucfirst($user['designation']); ?></td>
											<td>
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
				}

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
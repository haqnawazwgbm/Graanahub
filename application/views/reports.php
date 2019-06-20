<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>

	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Payrolls</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							<?php if ($current_month_payroll) : ?>
							<a href="#" id="generate_payroll" class="btn btn-primary rounded"><i class="fa fa-plus"></i> Generate Payroll</a>
						<?php else : ?>
							<a href="#" disabled class="btn btn-primary rounded"><i class="fa fa-plus"></i> Generate Payroll</a>
						<?php endif; ?>
						</div>
					</div>
		
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Month</th>
											
											<th>Basic Salaries</th>
											<th>House Rent Allowances</th>
											<th>Medical Allowances</th>
											<th>Provident Funds</th>
											<th>Tax Deductions</th>
											<th>Travelling Allowances</th>
											<th>Dearness Allowances</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($payrolls as $payroll) : 

										?>
										<tr>
											<td><?= date('F Y', strtotime($payroll['date'])); ?></td>
											
											<td><?= $payroll['basic_salary']; ?></td>
											<td><?= $payroll['house_rent_allowance']; ?></td>
											<td><?= $payroll['medical_allowance']; ?></td>
											<td><?= $payroll['provident_fund']; ?></td>
											<td><?= $payroll['tax_deduction']; ?></td>
											<td><?= $payroll['travelling_allowance']; ?></td>
											<td><?= $payroll['dearness_allowance']; ?></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														
														<li><a href="<?= base_url().'Payrolls/payroll_detail/'.date('Y-m', strtotime($payroll['date'])); ?>"><i class="fa fa-eye m-r-5"></i> View Details</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
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
        		$('#generate_payroll').on('click', function() {
        			$.ajax( {
        				url: "<?= base_url().'Payrolls/generate_payroll'; ?>",
        				type: 'GET',
        				success: function(data) {
        					$('.edit-form-container').html(data);
        					$('.edit-form-container').find('#payroll').modal('show');
        					return false;
        				}
        			})
        		})
        	})
        </script>
        
        <?php $this->load->view("includes/footer"); ?>
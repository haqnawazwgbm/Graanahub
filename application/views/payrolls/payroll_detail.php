<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>
<?php $CI =& get_instance(); ?>
	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Payroll month of <?= date('F Y', strtotime($date)); ?></h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							<a href="<?= base_url().'Payrolls/slips/'.date('Y-m', strtotime($date)); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Generate slips</a>
						</div>
					</div>
		
					<div class="row">
						<div class="col-md-12">
									<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>code</th>
											<th>Employee</th>
											
											<th>Basic Salaries</th>
											<th>House Rent Allowances</th>
											<th>Food Allowances</th>
											<th>Medical Allowances</th>
											<th>Provident Funds</th>
											<th>Tax Deductions</th>
											<th>Leave Deductions</th>
											<th>Travelling Allowances</th>
											<th>Dearness Allowances</th>
										</tr>
									</thead>
							<tbody>
								<?php
									$total_basic_salary = 0;
									$total_house_rent_allowance = 0;
									$total_food_allowance = 0;
									$total_medical_allowance = 0;
									$total_provident_fund = 0;
									$total_tax_deduction = 0;
									$total_leave_deduction = 0;
									$total_travelling_allowance = 0;
									$total_dearness_allowance = 0;

								 foreach ($users as $user) : 

								 	$taken_leaves = $CI->get_taken_leaves($user['user_id'], $user['date']);
								 	$allowed_leaves = $user['casual_leave'] + $user['medical_leave'];
								 	if ($allowed_leaves < $taken_leaves) {
								 		$exceed_leaves = $taken_leaves - $allowed_leaves;
								 	} else {
								 		$exceed_leaves = 0;
								 	}
								 	
								 	?>
							<tr>
								<td>
									<?= $user['code']; ?>
								</td>
								<td>
												<a href="profile.html" class="avatar"><img src="<?= base_url().'uploads/'.$user['photo']; ?>"></a>
												<h2><a href="profile.html"><?= ucfirst($user['name']); ?> <span><?= ucfirst($user['role']); ?></span></a></h2>
											</td>
											
								<td><?php $total_basic_salary = $total_basic_salary + $user['basic_salary']; echo $user['basic_salary']; ?></td>
								<td><?php $total_house_rent_allowance = $total_house_rent_allowance + $user['house_rent_allowance']; echo $user['house_rent_allowance'] ?></td>
								<td><?php $total_food_allowance = $total_food_allowance + $user['food_allowance']; echo $user['food_allowance'] ?></td>
								<td><?php $total_medical_allowance = $total_medical_allowance + $user['medical_allowance']; echo $user['medical_allowance']; ?></td>
								<td><?php $total_provident_fund = $total_provident_fund + $user['provident_fund']; echo $user['provident_fund']; ?></td>
								<td><?php $total_tax_deduction = $total_tax_deduction + $user['tax_deduction']; echo $user['tax_deduction']; ?></td>
								<td><?php $leave_deduction = $user['basic_salary'] / 30 * $exceed_leaves; $total_leave_deduction = $total_leave_deduction + $leave_deduction; echo $leave_deduction; ?></td>
								<td><?php $total_travelling_allowance = $total_travelling_allowance + $user['travelling_allowance']; echo $user['travelling_allowance']; ?></td>
								<td><?php $total_dearness_allowance = $total_dearness_allowance + $user['dearness_allowance']; $user['dearness_allowance']; ?></td>
								
							</tr>
						<?php endforeach; ?>
						<tr>
							<td></td>
							<td></td>
							<td><b><?= number_format($total_basic_salary); ?></b></td>
							<td><b><?= number_format($total_house_rent_allowance); ?></b></td>
							<td><b><?= number_format($total_food_allowance); ?></b></td>
							<td><b><?= number_format($total_medical_allowance); ?></b></td>
							<td><b><?= number_format($total_provident_fund); ?></b></td>
							<td><b><?= number_format($total_tax_deduction); ?></b></td>
							<td><b><?= number_format($total_leave_deduction); ?></b></td>
							<td><b><?= number_format($total_travelling_allowance); ?></b></td>
							<td><b><?= number_format($total_dearness_allowance); ?></b></td>
						</tr>
						<tr>
							<td colspan="7"></td>
							<td><b>Total Gross Salaries: </b><?php $gross_salary = $total_basic_salary + $total_house_rent_allowance + $total_food_allowance + $total_medical_allowance + $total_travelling_allowance + $total_dearness_allowance; echo number_format($gross_salary); ?></td>
							<td><b>Total Allowances: </b><?php $total_allowance = $total_house_rent_allowance + $total_food_allowance + $total_medical_allowance + $total_travelling_allowance + $total_dearness_allowance; echo number_format($total_allowance); ?></td>
							<td><b>Total Deductions: </b><?php $total_deducation = $total_provident_fund + $total_tax_deduction; echo number_format($total_deducation); ?></td>
							<td><b>Total Net salaries: </b><?php $net_salary = $total_basic_salary + $total_house_rent_allowance + $total_food_allowance + $total_medical_allowance + $total_provident_fund - $total_tax_deduction + $total_travelling_allowance + $total_dearness_allowance; echo number_format($net_salary); ?></td>
						</tr>
						
						</tbody>
					</table>
							
						</div>
						</div>
					</div>
                </div>
        
        <?php $this->load->view("includes/footer"); ?>
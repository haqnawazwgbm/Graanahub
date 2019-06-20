<?php $CI =& get_instance(); ?>
<div id="payslip" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<div class="row">
								<div class="col-xs-8">
									<h4 class="page-title">Payslip</h4>
								</div>
								<div class="col-sm-4 text-right m-b-30">
									<div class="btn-group btn-group-sm">
										<button class="btn btn-default">CSV</button>
										<button class="btn btn-default">PDF</button>
										<button class="btn btn-default"><i class="fa fa-print fa-lg"></i> Print</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="card-box payslip_content">
										<h4 class="payslip-title">Payslip for the month of <?= date('F Y'); ?></h4>
										<div class="row">
											<div class="col-md-6 m-b-20">
												<img src="<?= base_url(); ?>assets/img/logo2.png" class="m-b-20" alt="" style="width: 100px;">
												<ul class="list-unstyled m-b-0">
													<li>Graana</li>
													<li>Level 5, 44 East Plaza,</li>
													<li>Fazl ul Haq Road, Blue Area, Islamabad</li>
												</ul>
											</div>
											<div class="col-md-6 m-b-20">
												<div class="invoice-details">
													<h3 class="text-uppercase">Payslip #49029</h3>
													<ul class="list-unstyled">
														<li>Salary Month: <span><?= date('F, Y'); ?></span></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 m-b-20">
												<ul class="list-unstyled">
													<li><h5 class="m-b-0"><strong><?= ucfirst($user['name']); ?></strong></h5></li>
													<li><span><?= ucfirst($user['designation']); ?></span></li>
													<li>Employee ID: <?= $user['code']; ?></li>
													<li>Joining Date: <?= date('d F Y', strtotime($user['joining_date'])); ?></li>
												</ul>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div>
													<?php
														$taken_leaves = $CI->get_taken_leaves($user['user_id'], date('Y-m-d'));
													 	$allowed_leaves = $user['casual_leave'] + $user['medical_leave'];
													 	if ($allowed_leaves < $taken_leaves) {
													 		$exceed_leaves = $taken_leaves - $allowed_leaves;
													 	} else {
													 		$exceed_leaves = 0;
													 	}
													 ?>
													<h4 class="m-b-10"><strong>Earnings</strong></h4>
													<table class="table table-bordered">
														<tbody>
															<tr>
																<td><strong>Basic Salary</strong> <span class="pull-right"><?= number_format($user['basic_salary']); ?></span></td>
															</tr>
															<tr>
																<td><strong>House Rent Allowance (H.R.A.)</strong> <span class="pull-right"><?= number_format($user['house_rent_allowance']); ?></span></td>
															</tr>
															<tr>
																<td><strong>Medical Allowance</strong> <span class="pull-right"><?= number_format($user['medical_allowance']); ?></span></td>
															</tr>
															<tr>
																<td><strong>Travelling Allowance</strong> <span class="pull-right"><?= number_format($user['travelling_allowance']); ?></span></td>
															</tr>
															<tr>
																<td><strong>Dearness Allowance</strong> <span class="pull-right"><?= number_format($user['dearness_allowance']); ?></span></td>
															</tr>
															<tr>
																<td><strong>Total Earnings</strong> <span class="pull-right"><strong><?php $total_allowance = $user['basic_salary'] + $user['house_rent_allowance'] + $user['medical_allowance'] + $user['travelling_allowance'] + $user['dearness_allowance']; echo number_format($total_allowance); ?></strong></span></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-sm-6">
												<div>
													<h4 class="m-b-10"><strong>Deductions</strong></h4>
													<table class="table table-bordered">
														<tbody>
															<tr>
																<td><strong>Tax Deducted at Source (T.D.S.)</strong> <span class="pull-right"><?= number_format($user['tax_deduction']); ?></span></td>
															</tr>
															<tr>
																<td><strong>Provident Fund</strong> <span class="pull-right"><?= number_format($user['provident_fund']); ?></span></td>
															</tr>
															<tr>
																<td><strong>Leave Deduction</strong> <span class="pull-right"><?php $leave_deduction = $user['basic_salary'] / 30 * $exceed_leaves; echo number_format($leave_deduction); ?></span></td>
															</tr>
															
															<tr>
																<td><strong>Total Deductions</strong> <span class="pull-right"><strong><?php $total_deductions = $user['tax_deduction'] + $user['provident_fund']; echo number_format($total_deductions); ?></strong></span></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-md-12">
												<p><strong>Net Salary: <?php $net_salary = $total_allowance - $total_deductions; echo number_format($net_salary); ?></strong> (<?= $CI->convert_number($net_salary); ?>.)</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fa-print").click(function () {
		    $(".payslip_content").printThis();
		});
	})
</script>
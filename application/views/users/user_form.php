<?php
	$CI =& get_instance();
	$con['conditions'] = array(
		'role_id' => 2,
		'status' => 1
	);
	$managers = $CI->get_users($con);
	$departments = $CI->get_departments();
	$designations = $CI->get_designations();
	$roles = $CI->get_roles();
	$cities = $CI->get_cities();
?>
<div id="add_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Employee</h4>
						</div>
						 <ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#personal">Personal Details</a></li>
						    <li><a data-toggle="tab" href="#education">Educations</a></li>
						    <li><a data-toggle="tab" href="#backup">Dependants</a></li>
						    <li><a data-toggle="tab" id="salary-tab" href="#salary">Salary</a></li>
						    <li><a data-toggle="tab" href="#leaves">Leaves</a></li>
						    <li><a data-toggle="tab" href="#docs">Employee Docs</a></li>
						 </ul>
						 
						 
							<div class="modal-body">
							<form class="m-b-30" method="POST" action="<?= base_url(); ?>Users/store" enctype="multipart/form-data">
								<div class="tab-content">
								<div id="personal" class="tab-pane fade in active">
								<div class="row">
									<div class="col-md-12">
										<h3 class="card-title">Personals Details</h3>
										<hr class="task-line">
									</div>
										<div class="col-md-12">
											<div class="box col-md-offset-5" style="display: block; width: 100%; height: 150px;">
												<div class="profile-img-wrap">
													<img class="inline-block" id="user-img" src="<?= base_url(); ?>uploads/user.jpg" alt="user">
													<div class="fileupload btn btn-default">
														<span class="btn-text">edit</span>
														<input class="upload" id="userpicture" type="file" name="userpicture">
													</div>
												</div>
											</div>

										</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Employee Code <span class="text-danger">*</span></label>
											<input class="form-control" required name="code" required type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Name <span class="text-danger">*</span></label>
											<input class="form-control" name="name" required type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Father Name <span class="text-danger">*</span></label>
											<input class="form-control" name="father_name" required type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" required name="email" type="email">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Gender <span class="text-danger">*</span></label>
											<select class="select" name="gender" required>
												<option value="">Select Gender</option>
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Password <span class="text-danger">*</span></label>
											<input class="form-control" name="password" required type="password">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Mobile Number </label>
											<input class="form-control" name="mobile_no" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Date Of Birth </label>
											<input type="text" name="dob"  class="form-control floating datetimepicker" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Bank Account Number </label>
											<input class="form-control" name="bank_account_no" type="text">
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Address </label>
											<input class="form-control" name="address" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">City </label>
											<select class="select" name="city">
												<option value="">Select City</option>
												<?php foreach ($cities as $city) : ?>
												<option value="<?= ucfirst($city['name']); ?>"><?= ucfirst($city['name']); ?></option>
											<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">CNIC </label>
											<input class="form-control" name="cnic" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Martial Status <span class="text-danger">*</span></label>
											<select class="select" required name="martial_status">
												<option value="">Select Martial Status</option>
												<option value="single">Single</option>
												<option value="married">Married</option>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<h3 class="card-title">Official Details</h3>
										<hr class="task-line">
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Department <span class="text-danger">*</span></label>
											<select class="select" required name="department_id">
												<option value="">Select Department</option>
												<?php foreach ($departments as $department) : ?>
													<option value="<?= $department['id']; ?>"><?= ucfirst($department['name']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Designation <span class="text-danger">*</span></label>
											<select class="select" required name="designation_id">
												<option value="">Select Designation</option>
												<?php foreach ($designations as $designation) : ?>
													<option value="<?= $designation['id']; ?>"><?= ucfirst($designation['name']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<input type="text" required name="joining_date"  class="form-control floating datetimepicker" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ICE Number </label>
											<input class="form-control" name="ice_no" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">NTN Number </label>
											<input class="form-control" name="ntn_no" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">User Role <span class="text-danger">*</span></label>
											<select class="select" required name="role_id">
												<option value="">Select User Role</option>
												<?php foreach ($roles as $role) : ?>
													<option value="<?= $role['id']; ?>"><?= ucfirst($role['name']); ?></option>
												<?php endforeach; ?>
												
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="checkbox">
												<label class="control-label"><input id="in_probation" name="in_probation" type="checkbox" value="1" checked=""><strong>In Probation</strong> 
												</label>
											</div>
										</div>
									</div>
								
								</div>
								</div>
								<div id="education" class="tab-pane fade">
										<h3 class="card-title">Education Information</h3>
													<div class="row education">
													<div class="col-md-12"><hr class="task-line"></div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">University</label>
															<input type="text" name="university_name[]"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Degree</label>
															<input type="text" name="degree_title[]"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Subject</label>
															<input type="text" name="major_subjects[]"  class="form-control floating " />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Start Date</label>
															<input type="text" name="start_date[]"  class="form-control floating datetimepicker" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">End Date</label>
															<input type="text" name="end_date[]"  class="form-control floating datetimepicker" />
														</div>
													</div>
							

												</div>
						
												<div class="row more-education"></div>
												
												<div class="add-more-education">
													<a href="#" class="btn btn-bg-white btn-primary"><i class="fa fa-plus"></i> Add More Education</a>
												</div>
								</div>
								<div id="backup" class="tab-pane fade">
										<h3 class="card-title">Dependant Information</h3>
													<div class="row dependant">
													<div class="col-md-12"><hr class="task-line"></div>
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Name</label>
															<input type="text" name="dependant_name[]"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Date of birth</label>
															<input type="text" name="dependant_dob[]"  class="form-control floating datetimepicker" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Relationship </label>
															<select class="select" name="dependant_relationship[]">
																<option value="">Select Relationship</option>
																<option value="Wife">Wife</option>
																<option value="Husband">Husband</option>
																<option value="Mother">Mother</option>
																<option value="Father">Father</option>
																<option value="Daughter">Daughter</option>
																<option value="Son">Son</option>
																<option value="Brother">Brother</option>
																<option value="Sister">Sister</option>
															</select>
														</div>
													</div>
									
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Mobile Number</label>
															<input type="text" name="dependant_mobile_no[]"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Address</label>
															
															<textarea name="dependant_address[]" class="form-control floating"></textarea>
														</div>
													</div>

												</div>
						
												<div class="row more-dependant"></div>
												
												<div class="add-more-dependant">
													<a href="#" class="btn btn-bg-white btn-primary"><i class="fa fa-plus"></i> Add More Dependant</a>
												</div>
								</div>
								<div id="salary" class="tab-pane fade">
									<div class="row">
										<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Basic Salary</label>
															<input type="number" name="basic_salary"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">House Rent Allowance</label>
															<input type="number" id="house_rent_allowance" name="house_rent_allowance"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Food Allowance</label>
															<input type="number" id="food_allowance" name="food_allowance"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Medical Allowance</label>
															<input type="number" id="medical_allowance" name="medical_allowance"  class="form-control floating" />
														</div>
													</div>
											<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Provident Fund</label>
															<input type="number" id="provident_fund" name="provident_fund"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Tax Deduction</label>
															<input type="number" id="tax_deduction" name="tax_deduction"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Travelling Allowance</label>
															<input type="number" id="travelling_allowance" name="travelling_allowance"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Dearness Allowance</label>
															<input type="number" id="dearness_allowance" name="dearness_allowance"  class="form-control floating" />
														</div>
													</div>
				
												
						
									</div>
								</div>
								<div id="leaves" class="tab-pane fade">
									<div class="row">
										<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Casual Leave</label>
															<input type="number" name="casual_leave"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Medical Leave</label>
															<input type="number" name="medical_leave"  class="form-control floating" />
														</div>
													</div>
									</div>
								</div>
								<div id="docs" class="tab-pane fade">
									<div class="row">
										<div class="form-group col-lg-12">
                                          <label for="input-25">Images</label>
                                          <div class="file-loading">
                                              <input id="userfile" name="userfile[]" type="file" multiple>
                                          </div>
                                        </div>
									</div>
								</div>
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitUser" value="true">Create Employee</button>
								</div>
								</div>
							</form>
							
						
						
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$('.add-more-education').on('click', function() {
            			var content = $('.education').html();
    				   $('.more-education').append(content);
    				   $('.datetimepicker').datetimepicker({
							format: 'YYYY-MM-DD'
						});
    				   return false;
            		})

					$('#salary-tab').click(function() {
						if ($('#in_probation').is(':checked')) {
							$('#house_rent_allowance, #food_allowance, #medical_allowance, #provident_fund, #tax_deduction, #travelling_allowance, #dearness_allowance').attr('disabled', true);
						} else {
							$('#house_rent_allowance, #food_allowance, #medical_allowance, #provident_fund, #tax_deduction, #travelling_allowance, #dearness_allowance').attr('disabled', false);
						}
					});

            		$('.add-more-dependant').on('click', function() {
            			var content = $('.dependant').html();
    				   $('.more-dependant').append(content).find('.select2-container').remove();
    				   $('.datetimepicker').datetimepicker({
							format: 'YYYY-MM-DD'
						});
    				   if($('.select').length > 0 ){
							$('.select').select2({
								minimumResultsForSearch: -1,
								width: '100%'
							});
						}
    				   return false;
            		})

					$("#userfile").fileinput({
		                initialPreviewAsData: true,
		                deleteUrl: "/site/file-delete",
		                overwriteInitial: true,
		                maxFileSize: 5000,
		                allowedFileExtensions: ["jpg", "png", "jpeg", "pdf"],
		                initialPreviewShowDelete: false,
		                showRemove: false,
		                showUpload: false,
		                initialCaption: "Docs images"
	          		});
				})
			</script>
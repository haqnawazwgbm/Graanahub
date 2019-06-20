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
<div id="edit_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Employee</h4>
						</div>
						 <ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#edit-personal">Personal Details</a></li>
						    <li><a data-toggle="tab" href="#edit-education">Educations</a></li>
						    <li><a data-toggle="tab" href="#edit-backup">Dependants</a></li>
						    <li><a data-toggle="tab" id="edit-salary-tab" href="#edit-salary">Salary</a></li>
						    <li><a data-toggle="tab" href="#edit-leaves">Leaves</a></li>
						    <li><a data-toggle="tab" href="#edit-docs">Employee Docs</a></li>
						 </ul>
						 

						 
						 
							<div class="modal-body">
							<form class="m-b-30" method="POST" action="<?= base_url(); ?>Users/edit" enctype="multipart/form-data">
							<div class="tab-content">
								<div id="edit-personal" class="tab-pane fade in active">
									<input type="hidden" name="id" value="<?= $user['user_id']; ?>">
								<div class="row">
									<div class="col-md-12">
										<h3 class="card-title">Personal Details</h3>
										<hr class="task-line">
									</div>
									<div class="col-md-12">
											<div class="box col-md-offset-5" style="display: block; width: 100%; height: 150px;">
												<div class="profile-img-wrap">
													<img class="inline-block" id="edit-user-img" src="<?= base_url().'uploads/'.$user['photo']; ?>" alt="user">
													<div class="fileupload btn btn-default">
														<span class="btn-text">edit</span>
														<input class="upload" id="editUserPicture" type="file" name="userpicture">
													</div>
												</div>
											</div>

									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Employee Code <span class="text-danger">*</span></label>
											<input class="form-control" value="<?= $user['code']; ?>" required name="code" required type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Name <span class="text-danger">*</span></label>
											<input class="form-control" value="<?= $user['name']; ?>" name="name" required type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Father Name <span class="text-danger">*</span></label>
											<input class="form-control" value="<?= $user['father_name']; ?>" name="father_name" required type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" value="<?= $user['email']; ?>" required name="email" type="email">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Gender <span class="text-danger">*</span></label>
											<select class="select" name="gender" required>
												<option value="">Select Gender</option>
												<option <?= $user['gender'] == 'male' ? 'selected' : ''; ?> value="male">Male</option>
												<option <?= $user['gender'] == 'female' ? 'selected' : ''; ?> value="female">Female</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Mobile Number </label>
											<input class="form-control" value="<?= $user['mobile_no']; ?>" name="mobile_no" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Date Of Birth </label>
											<input type="text" name="dob" value="<?= $user['dob']; ?>" class="form-control floating datetimepicker" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Bank Account Number </label>
											<input class="form-control" value="<?= $user['bank_account_no']; ?>" name="bank_account_no" type="text">
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Address </label>
											<input class="form-control" value="<?= $user['address']; ?>" name="address" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">City </label>
											<select class="select" name="city">
												<option value="">Select City</option>
												<?php foreach ($cities as $city) : 
													 	if ($city['name'] == $user['city']) :
												?>
												<option selected value="<?= ucfirst($city['name']); ?>"><?= ucfirst($city['name']); ?></option>
											<?php else: ?>
												<option value="<?= ucfirst($city['name']); ?>"><?= ucfirst($city['name']); ?></option>

											<?php
												endif;
											 endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">CNIC </label>
											<input class="form-control" value="<?= $user['cnic']; ?>" name="cnic" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Martial Status <span class="text-danger">*</span></label>
											<select class="select" required name="martial_status">
												<option value="">Select Martial Status</option>
												<option <?= $user['martial_status'] == 'single' ? 'selected' : ''; ?> value="single">Single</option>
												<option <?= $user['martial_status'] == 'married' ? 'selected' : ''; ?> value="married">Married</option>
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
												<?php foreach ($departments as $department) :
														if ($department['id'] == $user['department_id']) :
												 ?>
													<option selected value="<?= $department['id']; ?>"><?= ucfirst($department['name']); ?></option>
												<?php else: ?>
													<option value="<?= $department['id']; ?>"><?= ucfirst($department['name']); ?></option>
												<?php endif;  endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Designation <span class="text-danger">*</span></label>
											<select class="select" required name="designation_id">
												<option value="">Select Designation</option>
												<?php foreach ($designations as $designation) :
														if ($designation['id'] == $user['designation_id']) :
												 ?>
													<option selected value="<?= $designation['id']; ?>"><?= ucfirst($designation['name']); ?></option>
												<?php else: ?>
													<option value="<?= $designation['id']; ?>"><?= ucfirst($designation['name']); ?></option>
												<?php endif;  endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<input type="text" required value="<?= $user['joining_date']; ?>" name="joining_date"  class="form-control floating datetimepicker" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ICE Number </label>
											<input class="form-control" value="<?= $user['ice_no']; ?>" name="ice_no" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">NTN Number </label>
											<input class="form-control" value="<?= $user['ntn_no']; ?>" name="ntn_no" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">User Role <span class="text-danger">*</span></label>
											<select class="select" required name="role_id">
												<option value="">Select User Role</option>
												<?php foreach ($roles as $role) : 
														if ($role['id'] == $user['role_id']) :
												?>
													<option selected value="<?= $role['id']; ?>"><?= ucfirst($role['name']); ?></option>
												<?php else: ?>
													<option value="<?= $role['id']; ?>"><?= ucfirst($role['name']); ?></option>
												<?php endif; endforeach; ?>
												
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="checkbox">
												<label class="control-label"><input <?= $user['in_probation'] ? 'checked' : ''; ?> type="checkbox" id="edit_in_probation" name="in_probation" value="1" ><strong>In Probation</strong> 
												</label>
											</div>
										</div>
									</div>
								
								</div>
								</div>
									<div id="edit-education" class="tab-pane fade">
										<h3 class="card-title">Education Information</h3>
										<?php if (empty($educations)): ?>
											<div class="row edit-education-content">
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
																<input type="text"  name="start_date[]"  class="form-control floating datetimepicker" />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">End Date</label>
																<input type="text" name="end_date[]"  class="form-control floating datetimepicker" />
															</div>
														</div>
							

												</div>
											<?php endif; ?>
										<?php foreach ($educations as $education) : ?>
													<div class="row edit-education-content">
														<div class="col-md-12"><hr class="task-line"></div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">University</label>
																<input type="text" value="<?= $education['university_name']; ?>" name="university_name[]"  class="form-control floating" />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Degree</label>
																<input type="text" value="<?= $education['degree_title']; ?>" name="degree_title[]"  class="form-control floating" />
															</div>
														</div>
					
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Subject</label>
																<input type="text" value="<?= $education['major_subjects']; ?>" name="major_subjects[]"  class="form-control floating " />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Start Date</label>
																<input type="text" value="<?= $education['start_date']; ?>" name="start_date[]"  class="form-control floating datetimepicker" />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">End Date</label>
																<input type="text" value="<?= $education['end_date']; ?>" name="end_date[]"  class="form-control floating datetimepicker" />
															</div>
														</div>
							

												</div>
										<?php endforeach; ?>
												<div class="row more-edit-education"></div>
												
												<div class="add-more-edit-education">
													<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add More Education</a>
												</div>
								</div>
								<div id="edit-backup" class="tab-pane fade">
										<h3 class="card-title">Dependant Information</h3>
										<?php foreach ($dependants as $dependant) : ?>
													<div class="row edit-dependant-content">
														<div class="col-md-12"><hr class="task-line"></div>
														
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Name</label>
																<input type="text" value="<?= $dependant['name']; ?>" name="dependant_name[]"  class="form-control floating" />
															</div>
														</div>
					
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Date of birth</label>
																<input type="text" value="<?= $dependant['dob']; ?>" name="dependant_dob[]"  class="form-control floating datetimepicker" />
															</div>
														</div>
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Relationship </label>
																<select class="select" name="dependant_relationship[]">
																	<option value="">Select Relationship</option>
																	<option <?= $dependant['relationship'] == 'Wife' ? 'selected' : ''; ?> value="Wife">Wife</option>
																	<option <?= $dependant['relationship'] == 'Husband' ? 'selected' : ''; ?> value="Husband">Husband</option>
																	<option <?= $dependant['relationship'] == 'Mother' ? 'selected' : ''; ?> value="Mother">Mother</option>
																	<option <?= $dependant['relationship'] == 'Father' ? 'selected' : ''; ?> value="Father">Father</option>
																	<option <?= $dependant['relationship'] == 'Daughter' ? 'selected' : ''; ?> value="Daughter">Daughter</option>
																	<option <?= $dependant['relationship'] == 'Son' ? 'selected' : ''; ?> value="Son">Son</option>
																	<option <?= $dependant['relationship'] == 'Brother' ? 'selected' : ''; ?> value="Brother">Brother</option>
																	<option <?= $dependant['relationship'] == 'Sister' ? 'selected' : ''; ?> value="Sister">Sister</option>
																</select>
															</div>
														</div>
													
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Mobile Number</label>
															<input type="text" value="<?= $dependant['mobile_no']; ?>" name="dependant_mobile_no[]"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Address</label>
															
															<textarea name="dependant_address[]" class="form-control floating"><?= $dependant['address']; ?></textarea>
														</div>
													</div>
							

												</div>
											<?php endforeach; ?>
						
												<div class="row more-edit-dependant"></div>
												
												<div class="add-more-edit-dependant">
													<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add More Dependant</a>
												</div>
								</div>
								<div id="edit-salary" class="tab-pane fade">
									<div class="row">
										<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Basic Salary</label>
															<input type="number" value="<?= $salary['basic_salary']; ?>" name="basic_salary"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">House Rent Allowance</label>
															<input type="number" id="edit_house_rent_allowance" value="<?= $salary['house_rent_allowance']; ?>" name="house_rent_allowance"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Food Allowance</label>
															<input type="number" id="edit_house_food_allowance" value="<?= $salary['food_allowance']; ?>" name="food_allowance"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Medical Allowance</label>
															<input type="number" id="edit_medical_allowance" value="<?= $salary['medical_allowance']; ?>" name="medical_allowance"  class="form-control floating" />
														</div>
													</div>
											<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Provident Fund</label>
															<input type="number" id="edit_provident_fund" value="<?= $salary['provident_fund']; ?>" name="provident_fund"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Tax Deduction</label>
															<input type="number" id="edit_tax_deduction" value="<?= $salary['tax_deduction']; ?>" name="tax_deduction"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Travelling Allowance</label>
															<input type="number" id="edit_travelling_allowance" value="<?= $salary['travelling_allowance']; ?>" name="travelling_allowance"  class="form-control floating" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Dearness Allowance</label>
															<input type="number" id="edit_dearness_allowance" value="<?= $salary['dearness_allowance']; ?>" name="dearness_allowance"  class="form-control floating" />
														</div>
													</div>
				
													
						
									</div>
								</div>
								<div id="edit-leaves" class="tab-pane fade">
									<div class="row">
										<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Casual Leave</label>
															<input type="number" value="<?= $leave['casual_leave']; ?>" name="casual_leave"  class="form-control floating" />
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Medical Leave</label>
															<input type="number" value="<?= $leave['medical_leave']; ?>" name="medical_leave"  class="form-control floating" />
														</div>
													</div>
									</div>
								</div>
								<div id="edit-docs" class="tab-pane fade">
									<div class="row">
										<div class="form-group col-lg-12">
                                          <label for="input-25">Images</label>
                                          <div class="file-loading">
                                              <input id="editUserfile" name="userfile[]" type="file" multiple>
                                          </div>
                                        </div>
									</div>
								</div>
								
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitEditUser" value="true">Update Employee</button>
								</div>
							</form>
							
						</div>
						
						</div>
					</div>
				</div>
			</div>
		<script type="text/javascript">
				$(document).ready(function() {
					$('.datetimepicker').datetimepicker({
							format: 'YYYY-MM-DD'
						});

					$('.add-more-edit-education').on('click', function() {
            			var content = $('.edit-education-content').html();
    				   $('.more-edit-education').append(content);
    				   $('.datetimepicker').datetimepicker({
							format: 'YYYY-MM-DD'
						});
    				   return false;
            		})

					$('#edit-salary-tab').click(function() {
						if ($('#edit_in_probation').is(':checked')) {
							$('#edit_house_rent_allowance, #edit_food_allowance, #edit_medical_allowance, #edit_provident_fund, #edit_tax_deduction, #edit_travelling_allowance, #edit_dearness_allowance').attr('disabled', true);
						} else {
							$('#edit_house_rent_allowance, #edit_food_allowance, #edit_medical_allowance, #edit_provident_fund, #edit_tax_deduction, #edit_travelling_allowance, #edit_dearness_allowance').attr('disabled', false);
						}
					});

            		$('.add-more-edit-dependant').on('click', function() {
            			var content = $('.edit-dependant-content').html();
    				   $('.more-edit-dependant').append(content).find('.select2-container').remove();
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


            		 var paths = [];
			           <?php 
			            if (! empty($pictures)) {
			              foreach ($pictures as $key => $value) : ?>
			           paths.push(['<?php echo base_url() . 'uploads/' . $value['photo']?>']);
			           <?php endforeach; 
			            }
			           ?>
					$("#editUserfile").fileinput({
						<?php if (! empty($pictures)) { ?>
		                initialPreview: paths,
		                <?php } ?>
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

				function editReadURL(input) {
			        if (input.files && input.files[0]) {
			            var reader = new FileReader();
			            
			            reader.onload = function (e) {
			                $('#edit-user-img').attr('src', e.target.result);
			            }
			            reader.readAsDataURL(input.files[0]);
			        }
			    }
			    $('#editUserPicture').change(function() {
			    	editReadURL(this);
			    })
			</script>
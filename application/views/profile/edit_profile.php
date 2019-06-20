<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>
<?php $CI =& get_instance();
	  $cities = $CI->get_cities();
?>

	     	<?php $this->load->view('includes/alerts.php'); ?>
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Edit Profile</h4>
						</div>
					</div>
					<form method="POST" action="<?= base_url(); ?>Profile/update" enctype="multipart/form-data">
						<div class="card-box">
							<h3 class="card-title">Basic Informations</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="profile-img-wrap">
										<img class="inline-block" id="user-img" src="<?= base_url().'uploads/'.$profile['photo']; ?>" alt="user">
										<div class="fileupload btn btn-default">
											<span class="btn-text">edit</span>
											<input class="upload" id="userpicture" type="file" name="userpicture">
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">Name</label>
													<input type="text" name="name" required value="<?= $profile['name']; ?>" class="form-control floating" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">Email</label>
													<input type="text" required name="email" value="<?= $profile['email']; ?>" class="form-control floating" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">Birth Date</label>
													<div class="cal-icon"><input class="form-control floating datetimepicker" type="text" name="dob" required value="<?= $profile['dob']; ?>"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus select-focus">
													<label class="control-label">Gendar</label>
													<select required name="gender" class="select form-control floating">
														<option value="">Select Gendar</option>
														<option value="male" <?= $profile['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
														<option value="femal"<?= $profile['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-box">
							<h3 class="card-title">Contact Informations</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-focus">
										<label class="control-label">Address</label>
										<input type="text" name="address" value="<?= $profile['address']; ?>" class="form-control floating" />
									</div>
								</div>
	
								<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">City</label>
												<select class="select" name="city">
													<option value="">Select City</option>
													<?php foreach ($cities as $city) : 
															if ($city['name'] == $profile['city']) : 
													?>

													<option selected value="<?= $city['name']; ?>"><?= ucfirst($city['name']); ?></option>
												<?php else : ?>
													<option value="<?= $city['name']; ?>"><?= ucfirst($city['name']); ?></option>
												<?php endif; ?>

												<?php endforeach; ?>
												</select>
											
											</div>
										</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Mobile Number</label>
										<input type="text" name="mobile_no" value="<?= $profile['mobile_no']; ?>" class="form-control floating" />
									</div>
								</div>
						
							</div>
						</div>
						<div class="card-box">
							<ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" href="#education">Educations</a></li>
							    <li><a data-toggle="tab" href="#backup">Dependants</a></li>
							    <li><a data-toggle="tab" href="#docs">Docs</a></li>
							 </ul>
							 <div class="tab-content">
								<div id="education" class="tab-pane fade in active">
									<h3 class="card-title">Education Informations</h3>
									<?php if (empty($educations)) : ?>
										<div class="row education">
										<div class="col-md-12"><hr class="task-line"></div>
										
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">University</label>
												<input type="text" name="university_name[]"  class="form-control floating" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Degree</label>
												<input type="text" name="degree_title[]"  class="form-control floating" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Subject</label>
												<input type="text" name="major_subjects[]"  class="form-control floating" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Starting Date</label>
												<input type="text" name="start_date[]"  class="form-control floating datetimepicker" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Complete Date</label>
												<input type="text" name="end_date[]"  class="form-control floating datetimepicker" />
											</div>
										</div>

									</div>
								
								
							
						<?php endif; ?>
							<?php foreach ($educations as $education) : ?>
							<div class="row education">
								<div class="col-md-12"><hr class="task-line"></div>
								
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">University</label>
										<input type="text" name="university_name[]" value="<?= $education['university_name']; ?>" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Degree</label>
										<input type="text" name="degree_title[]" value="<?= $education['degree_title']; ?>" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Subject</label>
										<input type="text" name="major_subjects[]" value="<?= $education['major_subjects']; ?>" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Starting Date</label>
										<input type="text" name="start_date[]" value="<?= $education['start_date']; ?>" class="form-control floating datetimepicker" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Complete Date</label>
										<input type="text" name="end_date[]" value="<?= $education['end_date']; ?>" class="form-control floating datetimepicker" />
									</div>
								</div>

							</div>
						<?php endforeach; ?>
							<div class="row more-education"></div>
							
							<div class="add-more">
								<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add More Education</a>
							</div>
						</div>

						<div id="backup" class="tab-pane fade">
							<h3 class="card-title">Dependant Informations</h3>
									<?php if (empty($dependants)) : ?>
										<div class="row dependant">
										<div class="col-md-12"><hr class="task-line"></div>
										
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Name</label>
												<input type="text" name="dependant_name[]"  class="form-control floating" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Date of birth</label>
												<input type="text" name="dependant_dob[]"  class="form-control floating datetimepicker" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Relationship</label>
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
											<div class="form-group form-focus">
												<label class="control-label">Mobile Number</label>
												<input type="text" name="dependant_mobile_no[]"  class="form-control floating" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-focus">
												<label class="control-label">Address</label>
												<textarea name="dependant_address[]"  class="form-control floating"></textarea>
											</div>
										</div>

									</div>
								
								
							
						<?php endif; ?>
							<?php foreach ($dependants as $dependant) : ?>
							<div class="row dependant">
								<div class="col-md-12"><hr class="task-line"></div>
								
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Name</label>
										<input type="text" name="dependant_name[]" value="<?= $dependant['name']; ?>" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Date of birth</label>
										<input type="text" name="dependant_dob[]" value="<?= $dependant['dob']; ?>" class="form-control floating datetimepicker" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Relationship</label>
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
									<div class="form-group form-focus">
										<label class="control-label">Mobile Number</label>
										<input type="text" name="dependant_mobile_no[]" value="<?= $dependant['mobile_no']; ?>" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Address</label>
										<textarea name="dependant_address[]" class="form-control floating"><?= $dependant['address']; ?></textarea>
									</div>
								</div>
								

							</div>
						<?php endforeach; ?>
							<div class="row more-dependant"></div>
							
							<div class="add-more-dependant">
								<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add More Dependent</a>
							</div>
						</div>
						<div id="docs" class="tab-pane fade">
							<h3 class="card-title">Doc Informations</h3>
							<div class="row">
										<div class="form-group col-lg-12">
                                          <label for="input-25">Images</label>
                                          <div class="file-loading">
                                              <input id="editUserfile" name="userfile[]" type="file" multiple>
                                          </div>
                                        </div>
							</div>		
						</div>
					</div>
				</div>
						<div class="text-center m-t-20">
							<button class="btn btn-primary btn-lg" type="submit" name="submitProfile" value="true">Save &amp; update</button>
						</div>
					</form>
				</div>

            <script type="text/javascript">
            	$(document).ready(function() {
            		$('.add-more').on('click', function() {
            			var content = $('.education').html();
    				   $('.more-education').append(content);
    				   $('.datetimepicker').datetimepicker({
							format: 'YYYY-MM-DD'
						});
    				   return false;
            		})

            		$('.add-more-dependant').on('click', function() {
            			var content = $('.dependant').html();
    				   $('.more-dependant').append(content).find('.select2-container').remove();
    				   if($('.select').length > 0 ){
							$('.select').select2({
								minimumResultsForSearch: -1,
								width: '100%'
							});
						}
    				   $('.datetimepicker').datetimepicker({
							format: 'YYYY-MM-DD'
						});
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
            	
            </script>
        <?php $this->load->view("includes/footer.php"); ?>
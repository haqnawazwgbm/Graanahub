<?php $CI =& get_instance();
$departments = $CI->get_departments();
$domiciles = $CI->get_domiciles();
$experiences = $CI->get_experiences();
?>
<div id="edit_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Job</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Jobs/edit">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Title <span class="text-danger">*</span></label>
											<input class="form-control" value="<?= $job['title']; ?>" required name="title" type="text">
										</div>
									</div>
									<input type="hidden" value="<?= $job['job_id']; ?>" name="id">
									<div class="col-md-6">
										<div class="form-group">
											<label>Department <span class="text-danger">*</span></label>
											<select class="select" required name="department_id">
												<option value="">Select Department</option>
												<?php foreach ($departments as $department) : 
														if ($department['id'] == $job['department_id']) : ?>
													<option selected value="<?= $department['id']; ?>"><?= ucfirst($department['name']); ?></option>
												<?php else : ?>
												<option value="<?= $department['id']; ?>"><?= ucfirst($department['name']); ?></option>
												<?php endif; endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Location <span class="text-danger">*</span></label>
											<input  value="<?= $job['location']; ?>" class="form-control" required name="location" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>No of Vacancies <span class="text-danger">*</span></label>
											<input  value="<?= $job['vacancies']; ?>" class="form-control" required name="vacancies" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Education</label>
											<select class="select" name="education">
												<option value="0">Select Education</option>
												<option <?= $job['education'] == 'bachelor' ? 'selected' : ''; ?> value="bachelor">Bachelor</option>
												<option <?= $job['education'] == 'master' ? 'selected' : ''; ?> value="master">Master</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Experience</label>
											<select class="select" name="experience_id">
												<option value="0">Select Experience</option>
											<?php foreach ($experiences as $experience) : 
													if ($experience['id'] == $job['experience_id']) : 

											?>
											<option selected value="<?= $experience['id']; ?>"><?= ucfirst($experience['name']); ?></option>
										<?php else: ?>
												<option value="<?= $experience['id']; ?>"><?= ucfirst($experience['name']); ?></option>
											<?php endif; endforeach; ?>
												
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Domicile</label>
											<select class="select" name="domicile_id">
												<option value="0">Select Domicile</option>
											<?php foreach ($domiciles as $domicile) : 
													if ($domicile['id'] == $job['domicile_id']) : 
											?>
											<option selected value="<?= $domicile['id']; ?>"><?= ucfirst($domicile['name']); ?></option>
										<?php else: ?>
												<option value="<?= $domicile['id']; ?>"><?= ucfirst($domicile['name']); ?></option>
												<?php endif;  endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Age <span class="text-danger">*</span></label>
											<input  value="<?= $job['age']; ?>" class="form-control" required name="age" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Salary From</label>
											<input type="text"  value="<?= $job['salary_from']; ?>" name="salary_from" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Salary To</label>
											<input type="text"  value="<?= $job['salary_to']; ?>" name="salary_to" class="form-control">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Type <span class="text-danger">*</span></label>
											<select class="select" required name="job_type">
												<option value="full time" <?= $job['job_type'] == 'full time' ? 'selected' : ''; ?>>Full Time</option>
												<option value="part time" <?= $job['job_type'] == 'part time' ? 'selected' : ''; ?>>Part Time</option>
												<option value="internship" <?= $job['job_type'] == 'inernship' ? 'selected' : ''; ?>>Internship</option>
												<option value="temporary" <?= $job['job_type'] == 'temporary' ? 'selected' : ''; ?>>Temporary</option>
												<option value="others" <?= $job['job_type'] == 'others' ? 'selected' : ''; ?>>Others</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status <span class="text-danger">*</span></label>
											<select class="select" required name="job_status">
												<option value="open" <?= $job['job_status'] == 'open' ? 'selected' : ''; ?>>Open</option>
												<option value="closed" <?= $job['job_status'] == 'closed' ? 'selected' : ''; ?>>Closed</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Start Date <span class="text-danger">*</span></label>
											<input type="text" value="<?= $job['start_date']; ?>" name="start_date" required class="form-control datetimepicker">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Expired Date <span class="text-danger">*</span></label>
											<input type="text" value="<?= $job['expire_date']; ?>" name="expire_date" required class="form-control datetimepicker">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Description <span class="text-danger">*</span></label>
											<textarea class="form-control" id="edit_description" required name="description"><?= $job['description']; ?></textarea>
										</div>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitEditUser" value="true">Update Job</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		
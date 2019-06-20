<?php $CI =& get_instance();
$departments = $CI->get_departments();
$domiciles = $CI->get_domiciles();
$experiences = $CI->get_experiences();
?>
<div id="add_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Job</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Jobs/store">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Title <span class="text-danger">*</span></label>
											<input class="form-control" required name="title" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Department <span class="text-danger">*</span></label>
											<select class="select" required name="department_id">
												<?php foreach ($departments as $department) : ?>
												<option value="<?= $department['id']; ?>"><?= ucfirst($department['name']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Location <span class="text-danger">*</span></label>
											<input class="form-control" required name="location" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>No of Vacancies <span class="text-danger">*</span></label>
											<input class="form-control" required name="vacancies" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Education</label>
											<select class="select" name="education">
												<option value="0">Select Education</option>
												<option value="bachelor">Bachelor</option>
												<option value="master">Master</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Experience</label>
											<select class="select" name="experience_id">
												<option value="0">Select Experience</option>
											<?php foreach ($experiences as $experience) : ?>
												<option value="<?= $experience['id']; ?>"><?= ucfirst($experience['name']); ?></option>
											<?php endforeach; ?>
												
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
											<?php foreach ($domiciles as $domicile) : ?>
												<option value="<?= $domicile['id']; ?>"><?= ucfirst($domicile['name']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Age <span class="text-danger">*</span></label>
											<input class="form-control" required name="age" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Salary From</label>
											<input type="text" name="salary_from" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Salary To</label>
											<input type="text" name="salary_to" class="form-control">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Type <span class="text-danger">*</span></label>
											<select class="select" required name="job_type">
												<option value="full time">Full Time</option>
												<option value="part time">Part Time</option>
												<option value="internship">Internship</option>
												<option value="temporary">Temporary</option>
												<option value="others">Others</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status <span class="text-danger">*</span></label>
											<select class="select" required name="job_status">
												<option value="open">Open</option>
												<option value="closed">Closed</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Start Date <span class="text-danger">*</span></label>
											<input type="text" name="start_date" required class="form-control datetimepicker">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Expired Date <span class="text-danger">*</span></label>
											<input type="text" name="expire_date" required class="form-control datetimepicker">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Description <span class="text-danger">*</span></label>
											<textarea class="form-control" id="description" required name="description"></textarea>
										</div>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitUser" value="true">Create Job</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		
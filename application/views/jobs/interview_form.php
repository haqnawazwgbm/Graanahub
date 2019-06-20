<?php $CI =& get_instance();
$jobs = $CI->get_jobs();
$user_con['string_or_conditions'] = array(
	"role_id = 2 and status = 1 or role_id = 5 and status = 1"
);

$users = $CI->get_users($user_con);
?>
<div id="add_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Interview</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Jobs/store_interview">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Job Title <span class="text-danger">*</span></label>
											<select class="select job" required name="job_id">
												<option value="-1">Select Job</option>
												<?php foreach ($jobs as $job) : ?>
												<option value="<?= $job['id']; ?>"><?= ucfirst($job['title']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Interview Date <span class="text-danger">*</span></label>
											<input type="text" name="date" required class="form-control datetimepicker">
										</div>
									</div>
								
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Interviewees (Selected Candidates) <span class="text-danger">*</span></label>
											<select class="select" multiple required name="application_id[]" id="application_id">
												
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Interview Place <span class="text-danger">*</span></label>
											<input class="form-control" required name="place" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Interview Time <span class="text-danger">*</span></label>
											<input type="text" name="time" required class="form-control timepicker">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Interviewers (Employees) <span class="text-danger">*</span></label>
											<select class="select" multiple required name="user_id[]">
												<?php foreach ($users as $user) : ?>
												<option value="<?= $user['id']; ?>"><?= ucfirst($user['name']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Job Interview Description <span class="text-danger">*</span></label>
											<textarea class="form-control" id="description" required name="description"></textarea>
										</div>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitUser" value="true">Create Interview</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.timepicker').datetimepicker({
			format: 'HH:mm:ss'
		});

		$('.job').on('change', function() {
			var id = $(this).val();
			$.ajax( {
        		url: "<?= base_url().'Jobs/list_applications/'; ?>"+id,
        		type: 'GET',
        		success: function(data) {
        			$('#application_id').html(data);
        		}
        	})
		})
	})
</script>
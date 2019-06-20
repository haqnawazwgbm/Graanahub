<div id="edit_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Designation</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Requests/update">
								<input type="hidden" name="id" value="<?= $request['request_id']; ?>" />
								<div class="col-md-6">
								<div class="form-group">
									<label>Employee Code </label>
									<input class="form-control" readonly name="code" value="<?= $request['code']; ?>" required="" type="text">
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>Employee Name </label>
									<input class="form-control" readonly name="name" value="<?= $request['name']; ?>" required="" type="text">
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>Request Type </label>
									<input class="form-control" readonly name="request_type_id" value="<?= $request['request_type']; ?>" required="" type="text">
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>Start Date </label>
									<input class="form-control datetimepicker" name="start_date" value="<?= $request['start_date']; ?>" required="" type="text">
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>End Date </label>
									<input class="form-control datetimepicker" name="end_date" value="<?= $request['end_date']; ?>" required="" type="text">
								</div>
								</div>
								<div class="col-md-12">
								<div class="form-group">
									<label>Description </label>
									<textarea name="description" readonly class="form-control"><?= $request['description']; ?></textarea>
								</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Status <span class="text-danger">*</span></label>
											<select class="select" name="status" required>
												<option <?= $request['approved_by_manager'] == 0 && $request['status'] == 1 ? 'selected' : ''; ?> value="0">Pending</option>
												<option <?= $request['approved_by_manager'] != 0 && $request['status'] == 1 ? 'selected' : ''; ?> value="1">Approve</option>
												<option <?= $request['status'] == 0 ? 'selected' : ''; ?> value="-1">Reject</option>
											</select>
										</div>
									</div>
									<div class="col-md-12">
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitEditUser" value="true">Update Request</button>
								</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<div id="edit_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Edit Designation</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Designations/edit">
								<input type="hidden" name="id" value="<?= $designation['id']; ?>" />
								<div class="form-group">
									<label>Designation Name <span class="text-danger">*</span></label>
									<input class="form-control" name="name" value="<?= $designation['name']; ?>" required="" type="text">
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitEditUser" value="true">Update Designation</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
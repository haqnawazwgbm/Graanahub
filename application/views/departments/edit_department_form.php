<div id="edit_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Department</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Departments/edit">
								<input type="hidden" name="id" value="<?= $department['id']; ?>" />
								<div class="form-group">
									<label>Department Name <span class="text-danger">*</span></label>
									<input class="form-control" name="name" value="<?= $department['name']; ?>" required="" type="text">
								</div>
								<div class="form-group">
									<label>Department Description <span class="text-danger"></span></label>
									<textarea name="description" class="form-control"><?= $department['description']; ?></textarea>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitEditUser" value="true">Create Department</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
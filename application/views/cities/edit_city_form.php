<div id="edit_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Edit City</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Cities/edit">
								<input type="hidden" name="id" value="<?= $city['id']; ?>" />
								<div class="form-group">
									<label>City Name <span class="text-danger">*</span></label>
									<input class="form-control" name="name" value="<?= $city['name']; ?>" required="" type="text">
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitEditUser" value="true">Update City</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
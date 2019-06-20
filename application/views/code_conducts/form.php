<div id="add_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Code of Conduct</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Code_Conducts/store" enctype="multipart/form-data">
								<div class="form-group">
									<label>Name <span class="text-danger">*</span></label>
									<input class="form-control" name="name" required="" type="text">
								</div>
								<div class="form-group">
									<label>Description <span class="text-danger">*</span></label>
									<textarea required name="description" class="form-control description"></textarea>
								</div>
								<div class="form-group">
                                          <label for="input-25">Attachments</label>
                                          <div class="file-loading">
                                              <input id="userfile" name="userfile[]" type="file" multiple>
                                          </div>
                                </div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitUser" value="true">Create</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#userfile").fileinput({
		                initialPreviewAsData: true,
		                deleteUrl: "/site/file-delete",
		                overwriteInitial: true,
		                maxFileSize: 5000,
		                allowedFileExtensions: ["jpg", "png", "jpeg", "pdf"],
		                initialPreviewShowDelete: false,
		                showRemove: false,
		                showUpload: false,
		                initialCaption: "Attachments"
	          		});
				})
			</script>
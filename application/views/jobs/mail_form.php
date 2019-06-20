
<div id="mail_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Send Mail</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Jobs/send_mail">
								
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Subject <span class="text-danger">*</span></label>
											<input type="text" class="form-control"  required name="subject">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Description <span class="text-danger">*</span></label>
											<input type="hidden" name="mail" id="mail">
											<textarea class="form-control" id="mail_description" required name="description"></textarea>
										</div>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitUser" value="true">Send Mail</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.email').click(function() {
			var mail = $(this).attr('mail');
			$('#mail').val(mail);
		})
		
	})
</script>
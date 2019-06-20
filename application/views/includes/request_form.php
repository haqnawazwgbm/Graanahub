<?php
	$CI =& get_instance();
	$request_types = $CI->get_request_types();

?>
<div id="request_form" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Send Request</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?= base_url(); ?>Requests/store" enctype="multipart/form-data">
								<div class="form-group">
											<label class="control-label">Request Type <span class="text-danger">*</span></label>
											<select class="select" required id="request_type" name="request_type_id">
												<option value="">Select Request Type</option>
												<?php foreach ($request_types as $request_type) : ?>
													<option value="<?= $request_type['id']; ?>"><?= ucfirst($request_type['name']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									<div class="dates">
									</div>
								<div class="form-group">
									<label>Request Description <span class="text-danger">*</span></label>
									<textarea required name="description" class="form-control description"></textarea>
								</div>
								<div class="form-group">
                                          <label for="input-25">Attachments</label>
                                          <div class="file-loading">
                                              <input id="userfile" name="userfile[]" type="file" multiple>
                                          </div>
                                </div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="submitUser" value="true">Create Request</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
	$(document).ready(function() {
        $(".description").jqte();
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
        $('#request_type').change(function() {
        	var id = $(this).val();
        	if (id == 1) {
        		$('.dates').append('<div class="form-group">'+
											'<label class="control-label">Start Date <span class="text-danger">*</span></label>'+
											'<input type="text" name="start_date" id="start_date" value="2019-01-01" class="form-control '+'floating datetimepicker"></div>'+'<div class="form-group">'+
											'<label class="control-label">End Date <span class="text-danger">*</span></label>'+
											'<input type="text" name="end_date" id="end_date" value="2019-01-01" class="form-control floating '+'datetimepicker"></div>'+'<div class="form-group"><label class="control-label">Days</label>'+'<input type="number" id="days" readonly value="" class="form-control floating"></div>');
        		$('.datetimepicker').datetimepicker({
							format: 'YYYY-MM-DD'
						});
        	} else {
				$('.dates').children().remove(); 
        		
        	}
        })

        $( "#request_form" ).delegate( "#start_date, #end_date", "blur", function() {
		  var start_date = new Date($("#start_date").val());
		  var end_date = new Date($("#end_date").val());
		  var timeDiff = Math.abs(end_date.getTime() - start_date.getTime());
		  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
		  $('#days').val(diffDays);
		});
    });
</script>
<div id="delete_asset" class="modal custom-modal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Record</h4>
						</div>
						<form id="delete_form" action="" method="POST">
							<div class="modal-body card-box">
								<p>Are you sure want to delete this record?</p>
								<input type="hidden" name="id" id="delete_id">
								<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<button type="submit" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.delete_record').click(function() {
			var id = $(this).attr('id');
			var path = $(this).attr('path');
			$('#delete_form').attr('action', path);
			$('#delete_id').val(id);
		})

	})
</script>
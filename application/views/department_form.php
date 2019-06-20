<div class="modal fade" id="add-dep" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="<?= base_url(); ?>Departments/store" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title">
                        Add New Department
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                        	<input type="hidden" name="id" id="id">
                            <div class="active-input">
                                <input class="form-control" id="name" name="name" placeholder="Title Name" type="text">
                                <?php echo form_error('name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="active-input">
                                <select class="form-control" name="status" id="status">
                                    <option value="1">
                                        Active
                                    </option>
                                    <option value="0">
                                        Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sucee marg" name="submitDepartment" value="true" type="submit">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
	$(document).ready(function() {
		$('#department').find('.fa-pencil').on('click', function() {
			var path = $(this).attr('href');
			$.ajax({
				url: path,
				type: "POST",
				success: function(data) {
					$('#add-dep').find('.modal-title').html('Edit Department');
					$('#add-dep').find('form').attr('action', '<?= base_url(); ?>Departments/edit');
					$('#add-dep').find('#id').val(data.id);
					$('#add-dep').find('#name').val(data.name);
					$('#add-dep').find('#status').val(data.status);
					$('#add-dep').find('.btn-sucee').attr('name', 'submitEditDepartment');
					$('#add-dep').modal('show');
				}
			})
		})

		$('.department-btn').on('click', function() {
			$('#add-dep').find('form').attr('action', "<?= base_url(); ?>Departments/store");
			$('#add-dep').find('button').attr('name', 'submitDepartment');
			$('#add-dep').find('.modal-title').html('Add New Department');
		})

		<?php if (isset($show_department_model)) : ?>
			$('#add-dep').modal('show');
		<?php endif; ?>
	})
	
</script>
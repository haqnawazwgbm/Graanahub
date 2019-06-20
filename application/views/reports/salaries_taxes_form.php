<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>

 <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<form  class="form-inline" id="report_form">
								<div class="form-group">
									<select id="departments" class="form-control" name="department_id">
										<option value="-1">Select Department</option>
										<?php foreach ($departments as $department) : ?>
											<option value="<?= $department['id']; ?>"><?= ucfirst($department['name']); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							<div class="form-group">
								<div id="users"></div>
							</div>
							<div class="form-group">
								<input type="text" name="from_date" placeholder="From date" class="form-control floating datetimepicker">
							</div>
							<div class="form-group">
								<input type="text" name="to_date" placeholder="To date" class="form-control floating datetimepicker">
							</div>
							<input type="hidden" name="submitSalariesTaxes" value="true">
							<button type="submit" class="btn btn-primary">Filter</button>
						</form>
						</div>
				
					</div>
					<br>
		
					<div class="row" id="report">
					
					</div>
                </div>
        <script type="text/javascript">
        	$(document).ready(function() {
        		$('#generate_payroll').on('click', function() {
        			$.ajax( {
        				url: "<?= base_url().'Payrolls/generate_payroll'; ?>",
        				type: 'GET',
        				success: function(data) {
        					$('.edit-form-container').html(data);
        					$('.edit-form-container').find('#payroll').modal('show');
        					return false;
        				}
        			})
        		})

        		$('#departments').on('change', function() {
        			var id = $(this).val();
        			$.ajax( {
        				url: "<?= base_url().'Reports/user_list/'; ?>"+id,
        				type: 'GET',
        				success: function(data) {
        					$('#users').html(data);
        					return false;
        				}
        			})
        		})

        		$('#report_form').submit(function(e) {

        			 $.ajax({
				           type: "POST",
				           url: "<?= base_url(); ?>Reports/salaries_taxes",
				           data: $(this).serialize(), 
				           success: function(data)
				           {
				               $('#report').html(data);
				           }
			         });
			         e.preventDefault();
        		})
        	})
        </script>
        
        <?php $this->load->view("includes/footer"); ?>
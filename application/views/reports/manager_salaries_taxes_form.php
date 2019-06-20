<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>

 <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-8">
							<form  class="form-inline" id="report_form">
								<div class="form-group">
									<select id="users" class="form-control" name="user_id">
										<option value="-1">Select Employee</option>
										<?php foreach ($users as $user) : ?>
											<option value="<?= $user['id']; ?>"><?= ucfirst($user['name']); ?></option>
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
        	
        		$('#report_form').submit(function(e) {

        			 $.ajax({
				           type: "POST",
				           url: "<?= base_url(); ?>Reports/manager_salaries_taxes",
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
<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>

	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Code of Conducts</h4>
						</div>
						
					</div>
		
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>#</th>
											<th style="width:30%;">Name</th>
								
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; foreach ($code_conducts as $code_conduct) : ?>
										<tr>
											<td><?= $i; ?></td>
											<td><?= ucfirst($code_conduct['name']); ?></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li class="edit_record" href="<?= base_url().'Code_Conducts/edit_form/'.$code_conduct['id']; ?>"><a href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" path="<?= base_url().'Code_Conducts/delete'; ?>" data-toggle="modal" data-target="#delete_asset" class="delete_record" id="<?= $code_conduct['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php $i++; endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
        <script type="text/javascript">
        	$(document).ready(function() {
        		$("#description").jqte();

        		$('.edit_record').on('click', function() {
        			var href = $(this).attr('href');
        			$.ajax( {
        				url: href,
        				type: 'GET',
        				success: function(data) {
        					$('.edit-form-container').html(data);
        					$('.edit-form-container').find('#edit_form').modal('show');
							$("#edit_description").jqte();
        				}
        			})
        		})
        	})
        </script>
        
        <?php include_once('form.php'); ?>
        <script type="text/javascript">
        	$(document).ready(function() {
        		// Datatable
				if($('.datatable').length > 0 ){
					$('.datatable').DataTable({});
					$("#DataTables_Table_0_filter").find('label').append('<a href="#" class="btn btn-bg-white btn-primary add-form-btn" data-toggle="modal" data-target="#add_form"><i class="fa fa-plus"></i> Add Code of Conduct</a>');
				}
        	})
        </script>
        <?php $this->load->view("includes/footer"); ?>
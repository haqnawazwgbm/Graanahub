<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); 
	$CI =& get_instance();
?>

	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Jobs</h4>
						</div>
						
					</div>
		
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Job Title</th>
											<th>Department</th>
											<th>Selected Candidates</th>
											<th>Interview Place</th>
											<th>Interview Date & Time</th>
											<th>Interviewers</th>
											<th>Added By</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; foreach ($interviews as $interview) : 
												$con['conditions'] = array(
									                'interview_id' => $interview['interview_id']
									            );
									            $candidates = $CI->get_candidates($con);
											 	$interviewers = $CI->get_interviewers($con);
										?>
										<tr>
											<td><?= $i; ?></td>
											<td><a href="<?= base_url().'Site_Jobs/details/'.$interview['id']; ?>"><?= ucfirst($interview['title']); ?></a></td>
											<td><?= ucfirst($interview['department']); ?></td>
											<td><ol>
												<?php foreach ($candidates as $candidate) : 
													echo '<li>'.$candidate['name'].'</li>';
												   endforeach; ?>
											</ol></td>
											<td><?= $interview['place']; ?></td>
											<td><?= date('d-F-Y', strtotime($interview['date'])).' '.date('H:m:s', strtotime($interview['time'])); ?></td>
											<td><ol>
												<?php foreach ($interviewers as $interview) : 
													echo '<li>'.$interview['name'].'</li>';
												   endforeach; ?>
											</ol></td>
											<td><?= ucfirst($interview['name']); ?></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" path="<?= base_url().'Jobs/delete_interview'; ?>" data-toggle="modal" data-target="#delete_asset" class="delete_record" id="<?= $interview['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
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

        		// Datatable
				if($('.datatable').length > 0 ){
					$('.datatable').DataTable({});
					$("#DataTables_Table_0_filter").find('label').append('<a href="#" class="btn btn-bg-white btn-primary add-form-btn" data-toggle="modal" data-target="#add_form"><i class="fa fa-plus"></i> Add Interview</a>');
				}
        		$('.edit_record').on('click', function() {
        			var href = $(this).attr('href');
        			$.ajax( {
        				url: href,
        				type: 'GET',
        				success: function(data) {
        					$('.edit-form-container').html(data);
        					$('.edit-form-container').find('#edit_form').modal('show');
        					$('.select').select2({
								minimumResultsForSearch: -1,
								width: '100%'
							});
							$("#edit_description").jqte();
        				}
        			})
        		})
        	})
        </script>
        
        <?php include_once('interview_form.php'); ?>
        <?php $this->load->view("includes/footer"); ?>
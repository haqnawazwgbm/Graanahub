<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>
<?php
	$CI =& get_instance();

?>
	     	<?php $this->load->view('includes/alerts.php'); ?>
  <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Employee Requests</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
						</div>
					</div>
		
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Employee Code</th>
											<th style="width:30%;">Name</th>
											<th>Request Type</th>
											<th>Description</th>
											<th>Time</th>
											<th>View</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($requests as $request) : ?>
										<tr>
											<td><?= $request['code']; ?></td>
											<td>
												<a href="<?= base_url().'Profile/view/'.$request['user_id']; ?>" class="avatar"><img src="<?= base_url().'uploads/'.$request['photo']; ?>"></a>
												<h2><a href="<?= base_url().'Profile/view/'.$request['user_id']; ?>"><?= ucfirst($request['user_name']); ?> <span><?= ucfirst($request['role']); ?></span></a></h2>
											</td>
											<td><?= $request['request_name']; ?></td>
											<td><?= $request['description']; ?><br><?= $request['request_type_id'] == 1 ? '<b>Date:</b> '.$request['start_date'].' <b>To</b> '.$request['end_date'] : '';?></td>
											<td><?= $CI->time2str($request['created']); ?></td>
											<td><div class="dropdown action-label">
												
													<a class="btn btn-white btn-sm rounded view_details" href="#" path="<?= base_url().'Requests/to_admin_request_details/'.$request['request_id']; ?>" aria-expanded="false"><i class="fa fa-eye text-success"></i> View Details 
													</a>
												</div></td>
											<td><div class="dropdown action-label">
												<?php if ($request['approved_by_admin'] == 0) : ?>
													<a class="btn btn-white btn-sm rounded dropdown-toggle request_status" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-warning"></i> Pending <i class="caret"></i>
													</a>
												<?php elseif ($request['approved_by_admin'] != 0) : ?>
													<a class="btn btn-white btn-sm rounded request_status" href="#" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Approved 
													</a>
												<?php elseif ($request['status'] == 0) : ?>
													<a class="btn btn-white btn-sm rounded request_status" href="#" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i> Rejected 
													</a>
												<?php endif; ?>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" class="approve_request" request-type-id="<?= $request['request_type_id']; ?>" id="<?= $request['request_id']; ?>"><i class="fa fa-dot-circle-o text-success"></i> Approve</a></li>
														<li><a href="#" class="reject_request" id="<?= $request['request_id']; ?>"><i class="fa fa-dot-circle-o text-danger"></i> Reject</a></li>
													</ul>
													
												</div>
													
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.approve_request').click(function() {
			var $this = $(this);
			var id = $(this).attr('id');
			var request_type_id = $(this).attr('request-type-id');
			$.ajax({
				url: "<?= base_url(); ?>Requests/approved",
				type: "POST",
				data: {request_id: id, request_type_id: request_type_id},
				success: function(res) {
					$this.parents('.dropdown').find('.request_status').html(res);
				}
			})
		})
			$('.reject_request').click(function() {
				var $this = $(this);
				var id = $(this).attr('id');
				$.ajax({
					url: "<?= base_url(); ?>Requests/rejected",
					type: "POST",
					data: {request_id: id},
					success: function(res) {
						$this.parents('.dropdown').find('.request_status').html(res);
					}
				})
		})

			$('.view_details').on('click', function() {
        			var href = $(this).attr('path');
        			$.ajax( {
        				url: href,
        				type: 'GET',
        				success: function(data) {
        					$('.edit-form-container').html(data);
        					$('.edit-form-container').find('#request_details').modal('show');
        					return false;
        				}
        			})
        		})
	})
</script>
<?php $this->load->view("includes/footer"); ?>
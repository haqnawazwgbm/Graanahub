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
							<h4 class="page-title">My Requests</h4>
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
											<th>Request Type</th>
											<th>Description</th>
											<th>Time</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($requests) : foreach ($requests as $request) : ?>
										<tr>
											
											<td><?= $request['request_name']; ?></td>
											<td><?= $request['description']; ?><?php echo 'From: '.$request['start_date'].' To: '.$request['end_date'];?></td>
											<td><?= $CI->time2str($request['created']); ?></td>
											<td>
												<?php if ($request['status'] == 1 && $request['approved'] == 1) : ?>
													<a class="btn btn-white btn-sm rounded request_status" href="#" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> accepted 
													</a>
												<?php elseif ($request['status'] == 1 && $request['approved'] == 0) : ?>
													<a class="btn btn-white btn-sm rounded request_status" href="#" aria-expanded="false"><i class="fa fa-dot-circle-o text-warning"></i> Pending 
													</a>
												<?php elseif ($request['status'] == 0 && $request['approved'] == 0) : ?>
													<a class="btn btn-white btn-sm rounded request_status" href="#" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i> Rejected 
													</a>
												<?php endif; ?>
											</td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														
														<li><a href="#" path="<?= base_url().'Requests/delete'; ?>" data-toggle="modal" data-target="#delete_asset" class="delete_record" id="<?= $request['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>

<?php $this->load->view("includes/footer"); ?>
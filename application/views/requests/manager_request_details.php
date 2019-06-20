<?php $CI =& get_instance(); ?>
<div id="request_details" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<div class="row">
								<div class="col-xs-8">
									<h4 class="page-title">Request Details</h4>
								</div>
								
							</div>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="card-box">
										
										<div class="row">
											<div class="col-lg-12 m-b-20">
												<ul class="list-unstyled">
													<li><h5 class="m-b-0"><strong><?= ucfirst($request['name']); ?></strong></h5></li>
													<li><span><?= ucfirst($request['designation']); ?></span></li>
													<li>Employee ID: <?= $request['code']; ?></li>
													<li>Joining Date: <?= date('d F Y', strtotime($request['joining_date'])); ?></li>
												</ul>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div>
													<table class="table table-bordered">
														<tbody>
															<tr>
																<td><strong>Request Type: </strong><br><?= $request['request_type']; ?></td>
															</tr>
															<tr>
																<td><strong>Description: </strong> <br><?= $request['description']; ?></td>
															</tr>
															<tr>
																<td><strong>From Date: </strong> <br><?= $request['start_date']; ?></td>
															</tr>
															<tr>
																<td><strong>End Date: </strong> <br><?= $request['end_date']; ?></td>
															</tr>
															<tr>
																<td><strong>Leave Days: </strong> <br><?= $request['leave_days']; ?></td>
															</tr>
															<tr>
																<td><strong>Time: </strong> <br><?= $CI->time2str($request['created']); ?></td>
															</tr>
															<tr>
																<td><strong>Status: </strong> <br><?php if ($request['approved_by_manager'] == 0 && $request['status'] == 1) :
																	echo 'Pending';
																elseif ($request['approved_by_manager'] != 0 && $request['status'] == 1) :
																	echo 'Approved';
																elseif ($request['status'] == 0) : 
																	echo 'Rejected';
																endif;
																 ?></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-sm-12">
												<?php if (! empty($pictures)) : ?>
													<div class="mail-attachments">
													<p><i class="fa fa-paperclip"></i> <?= count($pictures); ?> Attachments</p>
													<ul class="attachments clearfix">
														<?php foreach ($pictures as $picture) : 
																$file_ext = pathinfo($picture['photo'], PATHINFO_EXTENSION);
																if ($file_ext == 'pdf') : 
														?>
														<li>
															
															<div class="attach-file"><i class="fa fa-file-pdf-o"></i></div>
															<div class="attach-info"> <a href="<?= base_url().'uploads/'.$picture['photo']; ?>" download class="attach-filename">Download</a> <div class="attach-fileize"> <?= filesize(FCPATH.'uploads/'.$picture['photo']); ?> KB</div></div>
														</li>
													<?php else : ?>
														<li>
															<div class="attach-file"><img src="<?= base_url().'uploads/'.$picture['photo']; ?>" alt="Attachment"></div>
															<div class="attach-info"> <a href="<?= base_url().'uploads/'.$picture['photo']; ?>" download class="attach-filename">Download</a> <div class="attach-fileize"> <?= filesize(FCPATH.'uploads/'.$picture['photo']); ?> KB</div></div>
														</li>
													<?php endif; ?>
														<?php endforeach;  ?>
													</ul>
												</div>
											<?php endif; ?>
											</div>
											
										
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
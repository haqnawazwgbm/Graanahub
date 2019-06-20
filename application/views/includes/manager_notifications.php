<?php
	$CI =& get_instance();
	$requests = $CI->get_notifications();

?>
<li class="dropdown hidden-xs">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge bg-purple pull-right"><?= count($requests); ?></span></a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span>Notifications</span>
							</div>
							<div class="drop-scroll">
								<ul class="media-list">
									<?php foreach ($requests as $request) : ?>
									<li class="media notification-message">
										<a href="<?= base_url(); ?>Requests/list_requests">
											<div class="media-left">
												<span class="avatar">
													<img alt="<?= ucfirst($request['user_name']); ?>" src="<?= base_url().'uploads/'.$request['photo']; ?>" class="img-responsive img-circle">
												</span>
											</div>
											<div class="media-body">
												<p class="m-0 noti-details"><span class="noti-title"><?= ucfirst($request['user_name']); ?></span> created new <span class="noti-title"><?= ucfirst($request['request_name']); ?> request</span></p>
												<p class="m-0"><span class="notification-time"><?= $CI->time2str($request['created']); ?></span></p>
											</div>
										</a>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="<?= base_url(); ?>Requests/list_requests">View all Notifications</a>
							</div>
						</div>
					</li>
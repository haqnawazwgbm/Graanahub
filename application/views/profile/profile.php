<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>

	     	<?php $this->load->view('includes/alerts.php'); ?>
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">My Profile</h4>
						</div>
						
						<div class="col-sm-4 text-right m-b-30">
							<a href="<?= base_url(); ?>Profile/edit" class="btn btn-primary rounded"><i class="fa fa-plus"></i> Edit Profile</a>
						</div>
					</div>
					<div class="card-box">
						<div class="row">
							<div class="col-md-12">
								<div class="profile-view">
									<div class="profile-img-wrap">
										<div class="profile-img">
											<a href="#"><img class="avatar" src="<?= base_url().'uploads/'.$profile['photo']; ?>" alt=""></a>
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-5">
												<div class="profile-info-left">
													<h3 class="user-name m-t-0 m-b-0"><?= ucfirst($profile['name']); ?></h3>
													<small class="text-muted"><?= ucfirst($profile['designation']); ?></small>
													<div class="staff-id">Employee ID : <?= $profile['code']; ?></div>
												</div>
											</div>
											<div class="col-md-7">
												<ul class="personal-info">
													<li>
														<span class="title">Phone:</span>
														<span class="text"><a href="#"><?= $profile['mobile_no']; ?></a></span>
													</li>
													<li>
														<span class="title">Email:</span>
														<span class="text"><a href="#"><?= $profile['email']; ?></a></span>
													</li>
													<li>
														<span class="title">Birthday:</span>
														<span class="text"><?= date('d,F', strtotime($profile['dob'])); ?></span>
													</li>
													<li>
														<span class="title">Address:</span>
														<span class="text"><?= $profile['address']; ?></span>
													</li>
													<li>
														<span class="title">Gender:</span>
														<span class="text"><?= ucfirst($profile['gender']); ?></span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					
						<div class="col-md-12">
						<ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#official-details">Official Details</a></li>
						    <li><a data-toggle="tab" href="#education">Educations</a></li>
						    <li><a data-toggle="tab" href="#backup">Dependants</a></li>
						    <li><a data-toggle="tab" id="salary-tab" href="#salary">Salary</a></li>
						    <li><a data-toggle="tab" href="#leaves">Leaves</a></li>
						    <li><a data-toggle="tab" href="#docs">Docs</a></li>
						 </ul>
							<div class="card-box">
								<div class="tab-content">
									<div id="official-details" class="tab-pane fade in active">
										<h3 class="card-title">Official Informations</h3>
										<div class="experience-box">
												<ul class="personal-info">
													<li>
														<span class="title">Department:</span>
														<span class="text"><a href="#"><?= ucfirst($profile['department']); ?></a></span>
													</li>
													<li>
														<span class="title">Designation:</span>
														<span class="text"><a href="#"><?= ucfirst($profile['designation']); ?></a></span>
													</li>
													<li>
														<span class="title">Joining Date:</span>
														<span class="text"><?= date('d, F, Y', strtotime($profile['joining_date'])); ?></span>
													</li>
													<li>
														<span class="title">ICE Number:</span>
														<span class="text"><?= $profile['ice_no']; ?> </span>
													</li>
													<li>
														<span class="title">NTN Number:</span>
														<span class="text"><?= ucfirst($profile['ntn_no']); ?> </span>
													</li>
													<li>
														<span class="title">Bank Account Number:</span>
														<span class="text"><?= ucfirst($profile['bank_account_no']); ?> </span>
													</li>
												</ul>
										</div>
									</div>
									<div id="education" class="tab-pane fade">
										<h3 class="card-title">Education Informations</h3>
										<div class="experience-box">
											<ul class="experience-list">
												<?php foreach ($educations as $education) : ?>
												<li>
													<div class="experience-user">
														<div class="before-circle"></div>
													</div>
													<div class="experience-content">
														<div class="timeline-content">
															<a href="#/" class="name"><?= ucfirst($education['degree_title']).' from '.$education['university_name'].' university'; ?></a>
															<div><?= ucfirst($education['major_subjects']); ?></div>
															<span class="time"><?= date('Y', strtotime($education['start_date'])).'-'.date('Y', strtotime($education['end_date'])); ?></span>
														</div>
													</div>
												</li>
											<?php endforeach; ?>
										
											</ul>
										</div>
									</div>
									<div id="backup" class="tab-pane fad">
										<h3 class="card-title">Dependant Informations</h3>
										<div class="experience-box">
											<ul class="experience-list">
												<?php foreach ($dependants as $dependant) : ?>
												<li>
													<div class="experience-user">
														<div class="before-circle"></div>
													</div>
													<div class="experience-content">
														<div class="timeline-content">
															<a href="#/" class="name"><span class="title">Name:</span>
														<span class="text"><?= ucfirst($dependant['name']); ?></span></a>
															<div>Relationship: <?= ucfirst($dependant['name']); ?></div>
															<div>Mobile Number: <?= $dependant['mobile_no']; ?></div>
															<div>Address: <?= ucfirst($dependant['address']); ?></div>
															<span class="time">Date of birth: <?= date('F, d, Y', strtotime($dependant['address'])); ?></span>
														</div>
													</div>
												</li>
											<?php endforeach; ?>
										
											</ul>
										</div>
									</div>
									<div id="salary" class="tab-pane fade">
										<h3 class="card-title">Salary Informations</h3>
										<div class="experience-box">
											<ul class="personal-info">
													<li>
														<span class="title">Basic Salary:</span>
														<span class="text"><a href="#"><?= $profile['basic_salary']; ?></a></span>
													</li>
													<li>
														<span class="title">House Rent Allowance:</span>
														<span class="text"><a href="#"><?= $profile['house_rent_allowance']; ?></a></span>
													</li>
													<li>
														<span class="title">Food Allowance:</span>
														<span class="text"><a href="#"><?= $profile['food_allowance']; ?></a></span>
													</li>
													<li>
														<span class="title">Medical Allowance:</span>
														<span class="text"><a href="#"><?= $profile['medical_allowance']; ?></a></span>
													</li>
													<li>
														<span class="title">Provident Fund:</span>
														<span class="text"><a href="#"><?= $profile['provident_fund']; ?></a></span>
													</li>
													<li>
														<span class="title">Tax Deduction:</span>
														<span class="text"><a href="#"><?= $profile['tax_deduction']; ?></a></span>
													</li>
													<li>
														<span class="title">Travelling Allowance:</span>
														<span class="text"><a href="#"><?= $profile['travelling_allowance']; ?></a></span>
													</li>
													<li>
														<span class="title">Dearness Allowance:</span>
														<span class="text"><a href="#"><?= $profile['dearness_allowance']; ?></a></span>
													</li>
													
												</ul>
										</div>
									</div>
									<div id="leaves" class="tab-pane fade">
										<h3 class="card-title">Leave Informations</h3>
										<div class="experience-box">
											<ul class="personal-info">
													<li>
														<span class="title">Casual Leave:</span>
														<span class="text"><a href="#"><?= $profile['casual_leave']; ?></a></span>
													</li>
													<li>
														<span class="title">Medical Leave:</span>
														<span class="text"><a href="#"><?= $profile['medical_leave']; ?></a></span>
													</li>
													
												</ul>
										</div>
									</div>
									<div id="docs" class="tab-pane fade">
										<h3 class="card-title">Docs</h3>
										<div class="experience-box">
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
														<div class="attach-info"> <a href="<?= base_url().'uploads/'.$picture['photo']; ?>" download class="attach-filename">Download</a> <div class="attach-fileize"> 842 KB</div></div>
													</li>
												<?php else : ?>
													<li>
														<div class="attach-file"><img src="<?= base_url().'uploads/'.$picture['photo']; ?>" alt="Attachment"></div>
														<div class="attach-info"> <a href="<?= base_url().'uploads/'.$picture['photo']; ?>" download class="attach-filename">Download</a> <div class="attach-fileize"> 1.42 MB</div></div>
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
				<div class="notification-box">
					<div class="msg-sidebar notifications msg-noti">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="drop-scroll msg-list-scroll">
							<ul class="list-box">
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item new-message">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">John Doe</span>
												<span class="message-time">1 Aug</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Tarah Shropshire </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Mike Litorus</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Catherine Manseau </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">D</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Domenic Houston </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">B</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Buster Wigton </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Rolland Webber </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Claire Mapes </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Melita Faucher</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">Jeffery Lalor</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">L</span>
											</div>
											<div class="list-body">
												<span class="message-author">Loren Gatlin</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author">Tarah Shropshire</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="chat.html">See all messages</a>
						</div>
					</div>
				</div>
            </div>
            <?php $this->load->view("includes/footer.php"); ?>
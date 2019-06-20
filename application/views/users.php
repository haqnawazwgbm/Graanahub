<?php
	$CI =& get_instance();
	$user = $this->session->userdata('user');
	$user_con['selection'] = 'pms_users.*,pms_users.name as user_name, pms_departments.name as department_name, pms_roles.role';
    $user_con['conditions'] = array(
        'pms_users.status' => 1,
        'pms_users.id !=' => $user['id']
    );
    $user_con['innerJoin'] = array(array(
                'table' => 'pms_departments',
                'condition' =>'pms_users.department_id = pms_departments.id',
                'joinType' => 'inner'
        ),array(
            'table' => 'pms_roles',
            'condition' => 'pms_users.role_id = pms_roles.id',
            'joinType' => 'inner'
    ));
	$all_users = $CI->get_users($user_con);
?>
<div id="addUser" class="tab-pane fade in active">
							<button class="btn user-btn" data-target="#addusers" data-toggle="modal"><img src="<?= base_url(); ?>assets/img/plus.png" alt=""></button>
							<div class="main-activity">
								<div class="row">
									<div class="col-lg-4">
										<div class="heading-all">
											<h2>Users:</h2>
										</div>
									</div>
									<div class="col-lg-4">
										<?php include_once('includes/messages.php'); ?>
									</div>
									<div class="col-lg-4">
										<div class="active-input my-add">
											<input type="text" class="form-control" placeholder="Search Employee">
											<span class="fa fa-search"></span>
										</div>
									</div>
									
								</div>
								<?php foreach ($all_users as $user) : ?>
								<div class="main-add-user-pr">
									<div class="right-color">
										<span class="fa fa-pencil bg-green" id="<?= $user['id']; ?>"></span>
										<span class="fa fa-trash bg-red" href="<?= base_url() . 'Users/delete/' . $user['id']; ?>"></span>
									</div>
									<div class="img-ad-u">
										<img src="<?= base_url() . 'uploads/' . $user['photo_path']; ?>" alt="">
									</div>
									<div class="con-ad-u">
										<div class="row">
											<div class="col-lg-3">
												<div class="con-user-add">
													<p>
														Department:
													</p>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="con-user-add">
													<label><?= ucfirst($user['department_name']); ?></label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3">
												<div class="con-user-add">
													<p>
														Role: 
													</p>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="con-user-add">
													<label> <?= ucfirst($user['role']); ?></label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3">
												<div class="con-user-add">
													<p>
														User Name:
													</p>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="con-user-add">
													<label><?= ucfirst($user['user_name']); ?> </label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3">
												<div class="con-user-add">
													<p>
														Phone: 
													</p>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="con-user-add">
													<label><?= $user['mobile_no']; ?></label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3">
												<div class="con-user-add">
													<p>
														Email:
													</p>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="con-user-add">
													<label><?= $user['email']; ?></label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3">
												<div class="con-user-add">
													<p>
														Address: 
													</p>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="con-user-add">
													<label><?= $user['address']; ?></label>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
							
							

							</div>
						</div>

				<?php include_once('user_form.php'); ?>

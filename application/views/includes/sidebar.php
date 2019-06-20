<?php 
	$uri = $this->uri->segment_array();
	$user = $this->session->userdata('user');

?>
   <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<?php if ($user['role_id'] == 1 || $user['role_id'] == 3 || $user['role_id'] == 5) : ?>
							<li class="<?= @$uri[1] == 'Dashboard' ? 'active' : '';?>"> 
								<a href="<?= base_url(); ?>Dashboard"><img src="<?= base_url(); ?>assets/img/dashboard.svg"> <span>Dashboard</span></a>
							</li>
						<?php elseif ($user['role_id'] == 2) : ?>
							<li class="<?= @$uri[1] == 'Dashboard' ? 'active' : '';?>"> 
								<a href="<?= base_url(); ?>Dashboard/manager"><img src="<?= base_url(); ?>assets/img/dashboard.svg"> <span>Dashboard</span></a>
							</li>
						<?php elseif ($user['role_id'] == 4) : ?>
							<li class="<?= @$uri[1] == 'Dashboard' ? 'active' : '';?>"> 
								<a href="<?= base_url(); ?>Dashboard/employee"><img src="<?= base_url(); ?>assets/img/dashboard.svg"> <span>Dashboard</span></a>
							</li>
						<?php endif; ?>
						<?php if ($user['role_id'] == 1 || $user['role_id'] == 3 || $user['role_id'] == 5) : ?>
							<li class="<?= @$uri[2] == 'list_users' ? 'active' : '';?>"><a href="<?= base_url(); ?>Users/list_users" class="noti-dot"><img src="<?= base_url(); ?>assets/img/all-employees.svg"> <span>All Employees</span></a></li>
						<?php elseif ($user['role_id'] == 2) : ?>
							<li class="<?= @$uri[2] == 'list_manager_users' ? 'active' : '';?>"><a href="<?= base_url(); ?>Users/list_manager_users" class="noti-dot"><img src="<?= base_url(); ?>assets/img/all-employees.svg"> <span>My Team</span></a></li>
							<li class="<?= @$uri[2] == 'list_users' ? 'active' : '';?>"><a href="<?= base_url(); ?>Users/list_users"><img src="<?= base_url(); ?>assets/img/all-employees.svg"> <span>All Employees</span></a></li>
						<?php endif; ?>
						<?php if ($user['role_id'] == 1 || $user['role_id'] == 3 || $user['role_id'] == 5) : ?>
							<li class="<?= @$uri[2] == 'list_payrolls' ? 'active' : '';?>"><a href="<?= base_url(); ?>payrolls/list_payrolls"><img src="<?= base_url(); ?>assets/img/payroll.svg"> <span>Payrolls</span></a></li>
							<li class="<?= @$uri[2] == 'list_policies' ? 'active' : '';?>"><a href="<?= base_url(); ?>Policies/list_policies"><img src="<?= base_url(); ?>assets/img/policies.svg"> <span>Policies</span></a></li>
							<li class="<?= @$uri[2] == 'list_code_conducts' ? 'active' : '';?>"><a href="<?= base_url(); ?>Code_Conducts/list_code_conducts"><img src="<?= base_url(); ?>assets/img/code-of-conduct.svg"> <span>Code of Conducts</span></a></li>
						<?php endif; ?>
						<?php if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) : ?>
						<li class="submenu">
								<a href="#" class="<?= @$uri[1] == 'Jobs'? 'active' : ''; ?>"><img src="<?= base_url(); ?>assets/img/dashboard.svg"> <span> Recruitment</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<?php if ($user['role_id'] == 1 || $user['role_id'] == 3) : ?>
									<li class="<?= @$uri[2] == 'list_jobs' ? 'active' : '';?>"><a href="<?= base_url(); ?>Jobs/list_jobs">Manage Jobs</a></li>
									<li class="<?= @$uri[1] == 'Site_Jobs' ? 'active' : '';?>"><a target="_blank" href="<?= base_url(); ?>Site_Jobs/list_jobs">Jobs Listing <small>Frontend</small></a></li>
								<?php endif; ?>
								<?php if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) : ?>
									<li class="<?= @$uri[2] == 'list_candidates' ? 'active' : '';?>"><a href="<?= base_url(); ?>Jobs/list_candidates/0">Manage Applications</a></li>
								<?php endif; ?>
								<?php if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) : ?>
									<li class="<?= @$uri[2] == 'interviews' ? 'active' : '';?>"><a href="<?= base_url(); ?>Jobs/interviews">Manage Interviews</a></li>
								<?php endif; ?>
									
									
								</ul>
							</li>
						<?php endif; ?>
						<?php if ($user['role_id'] == 4) : ?>
							<li class="<?= @$uri[2] == 'employee_requests' ? 'active' : '';?>"><a href="<?= base_url(); ?>Requests/employee_requests"><img src="<?= base_url(); ?>assets/img/policies.svg"> <span>My Requests</span></a></li>
						<?php endif; ?>
						<?php if ($user['role_id'] == 1 || $user['role_id'] == 3 || $user['role_id'] == 5) : ?>
							<li class="submenu">
								<a href="#" class="<?= @$uri[1] == 'Reports'? 'active' : ''; ?>"><img src="<?= base_url(); ?>assets/img/reports.svg"> <span> Reports</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="<?= @$uri[2] == 'salaries_taxes' ? 'active' : '';?>"><a href="<?= base_url(); ?>Reports/salaries_taxes">Salaries & Taxes</a></li>
									
									
								</ul>
							</li>
						<?php elseif ($user['role_id'] == 4) : ?>
							<li class="submenu">
								<a href="#" class="<?= @$uri[1] == 'Reports'? 'active' : ''; ?>"><img src="<?= base_url(); ?>assets/img/reports.svg"> <span> Reports</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="<?= @$uri[2] == 'salaries_taxes' ? 'active' : '';?>"><a href="<?= base_url(); ?>Reports/employee_salaries_taxes">Salaries & Taxes</a></li>
									
									
								</ul>
							</li>
						<?php elseif ($user['role_id'] == 2) : ?>
							<li class="submenu">
								<a href="#" class="<?= @$uri[1] == 'Reports'? 'active' : ''; ?>"><img src="<?= base_url(); ?>assets/img/reports.svg"> <span> Reports</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="<?= @$uri[2] == 'salaries_taxes' ? 'active' : '';?>"><a href="<?= base_url(); ?>Reports/manager_salaries_taxes">Salaries & Taxes</a></li>
									
									
								</ul>
							</li>
						<?php endif; ?>
						<?php if ($user['role_id'] == 1) : ?>
							<li class="submenu">
								<a href="#" class="<?= @$uri[1] == 'Departments' || @$uri[1] == 'Designations' || @$uri[1] == 'Cities'? 'active' : ''; ?>"><img src="<?= base_url(); ?>assets/img/organization.svg"> <span> Organization</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="<?= @$uri[2] == 'list_departments' ? 'active' : '';?>"><a href="<?= base_url(); ?>Departments/list_departments">Departments</a></li>
									<li class="<?= @$uri[2] == 'list_designations' ? 'active' : '';?>"><a href="<?= base_url(); ?>Designations/list_designations">Designations</a></li>
									<li class="<?= @$uri[2] == 'list_cities' ? 'active' : '';?>"><a href="<?= base_url(); ?>Cities/list_cities">Cities</a></li>
									
									
								</ul>
							</li>
						<?php endif; ?>
							
						</ul>
					</div>
                </div>
            </div>
           <div class="page-wrapper">

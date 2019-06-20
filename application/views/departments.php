<div class="tab-pane fade in active" id="department">
    <button class="btn department-btn" data-target="#add-dep" data-toggle="modal">
        <img alt="" src="<?= base_url(); ?>assets/img/plus.png">
        </img>
    </button>
    <div class="main-activity">
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <div class="heading-all">
                    <h2>
                        Department Log:
                    </h2>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6 pull-right">
                <div class="search-dep">
                    <input class="form-control" placeholder="Search Department" type="text">
                        <span class="fa fa-search bg-red">
                        </span>
                    </input>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 pull-left">
                <?php include_once('includes/messages.php'); ?>
            </div>
        </div>
        <div class="main-cir">
            <div class="row">
            	<?php 
            	$i = 0;
            	foreach ($admin_departments as $admin_department) : 
            		if ($admin_department['status']) {
            			$visibility = 'isable-me';
            			$color = 'green';
            			$status = 'Active';
            		} else {
            			$visibility = 'disable-me';
            			$color = 'red';
            			$status = 'Inactive';
            		}
            		if ($i == 4) {
            			echo '</div><div class="row">';
            			$i = 0;
            		}

            	?>
                <div class="col-lg-3 col-md-3 col-xs-6 col-sm-3">
                    <div class="main-department border-right-<?= $color; ?> <?= $visibility; ?>">
                        <label>
                            <?= ucfirst($admin_department['name']); ?>
                        </label>
                        <span class="active-dep">
                            <?= $status; ?>
                            <span class="fa fa-check bg-<?= $color; ?>">
                            </span>
                        </span>
                        <div class="main-dep-span">
                            <span class="fa fa-trash bg-red" href="<?= base_url() . 'Departments/delete/'. $admin_department['id']; ?>">
                            </span>
                            <span class="fa fa-pencil bg-yellow" href="<?= base_url() . 'Departments/edit_form/'. $admin_department['id']; ?>">
                            </span>
                        </div>
                    </div>
                </div>
            <?php 
	            $i++;
	            endforeach; 
	        ?>
            </div>
        </div>
    </div>
</div>
<?php include_once('department_form.php'); ?>
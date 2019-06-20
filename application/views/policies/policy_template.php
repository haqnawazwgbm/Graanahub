<?php $this->load->view("includes/header.php"); ?>
<?php $this->load->view("includes/menu.php"); ?>
<?php $this->load->view("includes/sidebar.php"); ?>
<div class="content container-fluid">
	<div class="row">
		<div class="col-sm-8">
			<h4 class="page-title">Policy</h4>
		</div>
	</div>
	<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-body">
							
						
								
									<div>
		
										<div class="invoice-info">
											<h2><?= ucfirst($policy['name']); ?></h2>
											<p class="text-muted"><?= htmlspecialchars_decode($policy['description']); ?></p>
										</div>
									</div>
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
<?php $this->load->view("includes/footer"); ?>
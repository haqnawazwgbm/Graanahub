<?php
	$CI =& get_instance();
	$policies = $CI->get_policies(); 
?>
	<li class="dropdown">
						<a href="profile.html" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
							<span>Policies</span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<?php foreach ($policies as $policy) : ?>
							<li><a href="<?= base_url().'Policies/policy/'.$policy['id']; ?>"><?= ucfirst($policy['name']); ?></a></li>
						<?php endforeach; ?>
						</ul>
					</li>
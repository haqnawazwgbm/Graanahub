<?php
	$CI =& get_instance();
	$code_conducts = $CI->get_code_conducts(); 
?>
	<li class="dropdown">
						<a href="profile.html" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
							<span>Code of Conducts</span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<?php foreach ($code_conducts as $code_conduct) : ?>
							<li><a href="<?= base_url().'Code_Conducts/code_conduct/'.$code_conduct['id']; ?>"><?= ucfirst($code_conduct['name']); ?></a></li>
						<?php endforeach; ?>
						</ul>
					</li>